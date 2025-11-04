// =================== CONFIG ===================
const SHIP_THRESHOLD = 150000;   // >= 150k freeship
const SHIP_FEE       = 30000;    // 30k nếu chưa đủ ngưỡng
const BANK_OFF       = 0.15;     // -15% khi chuyển khoản (giá trị 0.15 = 15%)

// (tuỳ chọn) Bảng coupon demo
const COUPONS = {
  SALE15KN:  { kind:'amount', value:30000, min:399000, label:'Giảm 30K đơn từ 399K' },
  SALE30KN:  { kind:'amount', value:80000, min:699000, label:'Giảm 80K đơn từ 699K' },
  GG60KN:    { kind:'amount', value:100000, min:999000, label:'Giảm 100K đơn từ 999K' },
  FREESHIP10:{ kind:'ship',   value:0,     min:150000, label:'Miễn phí vận chuyển từ 150K' }
};

// =================== RUNTIME STATE ===================
let PRODUCTS = {};     // { slug: {id,slug,name,price,compare_at,image,images[],parent_id,raw} }
let SLUGS = [];        // thứ tự hiển thị
let currentKey = null; // slug đang chọn

let CART = [];                 // [{key,id,name,variant,price,qty}]
let CURRENT_COUPON = null;     // string|null

// =================== HELPERS ===================
const VND = n => (n||0).toLocaleString('vi-VN') + '₫';
const $F  = sel => $(sel);

function fadeSwap($img, url){
  if(!$img || !url) return;
  $img.addClass('fade')
      .one('load', function(){ $(this).removeClass('fade'); })
      .attr('src', url)
      .each(function(){ if(this.complete) $(this).trigger('load'); });
}

function updateCartCount(){
  const total = CART.reduce((s,i)=> s + (i.qty||0), 0);
  $('#cartCount').text(total);
}

function syncFormState(totals=null){
  // Serialize cart & coupon & totals vào các input ẩn (để backend đọc)
  const $cartJson   = $('#cartJson');
  const $couponCode = $('#couponCode');
  const $totalsJson = $('#totalsJson');

  if($cartJson.length){ $cartJson.val(JSON.stringify(CART)); }
  if($couponCode.length){ $couponCode.val(CURRENT_COUPON || ''); }
  if($totalsJson.length){
    // nếu đã tính totals ở renderSummary thì truyền vào để tránh double-calc
    const t = totals || CartModal.totals();
    $totalsJson.val(JSON.stringify(t));
  }
}

function hydrateFromView(){
  // Nếu backend render sẵn dữ liệu
  try{
    const vCart = $('#cartJson').val();
    if(vCart){ const parsed = JSON.parse(vCart); if(Array.isArray(parsed)) CART = parsed; }
  }catch{}
  const vCoupon = ($('#couponCode').val()||'').trim().toUpperCase();
  CURRENT_COUPON = vCoupon || null;

  updateCartCount();
  syncFormState(); // đồng bộ lại (tránh backend không ghi totals)
}

// === CSRF helpers (thêm mới) ===
function getCsrf(){
  return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
}

async function callPrepare(payload){
  return await fetch('/api/orders/prepare', {
    method: 'POST',
    credentials: 'same-origin',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': getCsrf(),
    },
    body: JSON.stringify(payload)
  });
}

// === Map totals từ API sang UI (thêm mới) ===
function applyServerTotalsFromApi(apiTotals){
  if(!apiTotals) return;
  const t = {
    subtotal:       Number(apiTotals.subtotal || 0),
    ship:           Number(apiTotals.shipping_fee || 0),
    bankDiscount:   Number(apiTotals.bank_discount || 0),
    otherDiscount:  Number(apiTotals.other_discount || 0),
    total:          Number(apiTotals.total || 0),
    code:           CURRENT_COUPON || null
  };
  $('#sumSubtotal').text(VND(t.subtotal));
  $('#sumShip').text(VND(t.ship));
  $('#sumBankDiscount').text(t.bankDiscount ? ('-' + VND(t.bankDiscount)) : '0₫');
  $('#sumOtherDiscount').text(t.otherDiscount ? ('-' + VND(t.otherDiscount)) : '0₫');
  $('#sumTotal').text(VND(t.total));
  $('#totalsJson').val(JSON.stringify(t));
}

// =================== API PRODUCTS (CALL TRƯỚC) ===================
function mapApiProducts(list){
  const out = {};
  list.forEach(p => {
    // Dùng short_name làm name hiển thị ngắn gọn, fallback name nếu thiếu
    const displayName = p.short_name || p.name || 'No name';
    const slug = p.slug?.replace(/^v_/, '') || `p_${p.id}`;
    const img = p.thumbnail || (Array.isArray(p.images) && p.images.length ? p.images[0] : '');

    out[slug] = {
      id: p.id,
      slug: slug,
      name: displayName,
      price: Number(p.price) || 0,
      compare_at: Number(p.compare_at) || 0,
      image: img,
      images: Array.isArray(p.images) ? p.images : [],
      parent_id: p.parent_id || 0,
      raw: p
    };
  });
  return out;
}

async function loadProductsFromApi(){
  const $skeleton = $('#productSkeleton');
  if($skeleton.length) $skeleton.removeClass('d-none');

  const res = await fetch('/api/products', { headers: { 'Accept':'application/json' }});
  if(!res.ok) throw new Error('Fetch /api/products failed');

  const data = await res.json();
  PRODUCTS = mapApiProducts(Array.isArray(data) ? data : []);

  // Chỉ lấy sản phẩm gốc (không phải variant con) — nếu cần hiển thị theo parent
  PRODUCTS = Object.fromEntries(
    Object.entries(PRODUCTS).filter(([slug, p]) => p.parent_id === 0)
  );

  SLUGS = Object.keys(PRODUCTS);

  if($skeleton.length) $skeleton.addClass('d-none');
  if(!SLUGS.length) throw new Error('No products returned');
}

function buildVariantRadios(){
  const $group = $('#variantGroup');
  if(!$group.length) return;
  $group.empty();
  SLUGS.forEach((slug, idx) => {
    const v = PRODUCTS[slug];
    const inputId = `v_${slug}`;
    $group.append(`
      <input type="radio" class="btn-check" name="variant"
             id="${inputId}" value="${slug}" data-variant="${slug}" ${idx===0?'checked':''}>
      <label class="btn btn-outline-brand btn-sm" for="${inputId}">${v.name}</label>
    `);
  });
}

function buildThumbnails(){
  const $wrap = $('#thumbWrap'); // nếu có
  if(!$wrap.length) return;
  $wrap.empty();
  SLUGS.forEach((slug, idx) => {
    const v = PRODUCTS[slug];
    const big = v.image || '';
    $wrap.append(`
      <img class="thumb ${idx===0?'active':''}" src="${big}" alt="${v.name}"
           data-variant="${slug}" data-big="${big}">
    `);
  });
}

// =================== VARIANT ===================
function setVariant(key, options){
  const opts = $.extend({ syncUI:true, fromThumb:false }, options||{});
  const v = PRODUCTS[key];
  if(!v) return;
  currentKey = key;

  // 1) Ảnh lớn
  fadeSwap($('#main-image'), v.image);

  // 2) Giá + badge
  $('#price,#mPrice').text(VND(v.price));
  if (v.compare_at && v.compare_at > v.price) {
    $('#compare,#mCompare').text(VND(v.compare_at)).removeClass('d-none');
    const disc = Math.round((1 - v.price / v.compare_at) * 100);
    $('#discountBadge').text(`-${disc}%`).removeClass('d-none');
  } else {
    $('#compare,#mCompare').addClass('d-none');
    $('#discountBadge').addClass('d-none');
  }

  // 3) Đồng bộ radio nếu không xuất phát từ click thumb
  if (opts.syncUI && !opts.fromThumb) {
    $(`#variantGroup input[name="variant"][data-variant="${key}"]`).prop('checked', true);
  }

  // 4) Đồng bộ thumbnail active
  const vImg = v.image;
  const $thumbs = $('.thumb');
  $thumbs.removeClass('active');
  const $active = $thumbs.filter(function(){
    const $t = $(this);
    return $t.data('variant') === key && ($t.data('big') === vImg || ($t.attr('src')||'').endsWith(vImg));
  });
  ($active.length ? $active : $thumbs.filter(`[data-variant="${key}"]`).first()).addClass('active');
}

// =================== CART CORE ===================
function posQty(){
  const q = parseInt($('#qty').val(), 10);
  return Number.isFinite(q) && q > 0 ? q : 1;
}

function withLoading($btn, fn){
  if(!$btn || !$btn.length) return;
  const old = $btn.html();
  $btn.prop('disabled', true)
      .html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Đang xử lý...');
  setTimeout(()=>{ try{ fn(); } finally { $btn.prop('disabled', false).html(old); } }, 200);
}

function addItem(toCheckout=false){
  const v = PRODUCTS[currentKey];
  if(!v) return;

  const quantity = posQty();
  const itemKey = `p:${v.id}`; // key duy nhất theo id DB

  const ex = CART.find(i=> i.key === itemKey);
  if(ex){ ex.qty += quantity; }
  else {
    CART.push({ key:itemKey, id:v.id, name:v.name, variant:v.name, price:v.price, qty:quantity });
  }

  updateCartCount();
  syncFormState();

  const toastEl = document.getElementById('actionToast');
  if(toastEl){
    toastEl.querySelector('.toast-body').textContent = toCheckout ? 'Đã thêm vào giỏ, chuyển tới trang thanh toán...' : 'Đã thêm vào giỏ hàng.';
    new bootstrap.Toast(toastEl).show();
  }
  if(toCheckout){ window.location.hash = '#checkout'; }
}

// =================== CART MODAL ===================
const CartModal = {
  bs: null,

  init(){
    const el = document.getElementById('cartModal');
    if(el) this.bs = new bootstrap.Modal(el);

    // Mở modal
    $('#cartBtn').on('click', (e)=>{ e.preventDefault(); this.open(); });

    // Khi modal show: đồng bộ coupon từ view
    $('#cartModal').on('show.bs.modal', ()=>{
      $('#couponInput').val(CURRENT_COUPON || '');
    });

    // Payment -> recalc
    $('#paymentGroup').on('change', 'input[name="payment_method"]', ()=> this.renderSummary());

    // Qty +/- & remove
    $(document).on('click', '.btn-qty-minus', (e)=> this.changeQty($(e.currentTarget).data('key'), -1));
    $(document).on('click', '.btn-qty-plus',  (e)=> this.changeQty($(e.currentTarget).data('key'), +1));
    $(document).on('change', '.item-qty',      (e)=> this.setQty($(e.currentTarget).data('key'), parseInt($(e.currentTarget).val(),10)||1));
    $(document).on('click', '.btn-remove-item',(e)=> this.remove($(e.currentTarget).data('key')));

    // Áp dụng mã
    $('#applyCouponBtn').on('click', ()=>{
      const code = ($('#couponInput').val()||'').trim().toUpperCase();
      const subtotal = CART.reduce((s,i)=> s+i.price*i.qty, 0);

      if(!code) return this.couponError('Vui lòng nhập mã.');
      if(!COUPONS[code]) return this.couponError('Mã không tồn tại.');
      const c = COUPONS[code];
      if(subtotal < (c.min||0)) return this.couponError(`Chưa đạt điều kiện: ${c.label}`);

      CURRENT_COUPON = code;
      this.clearCouponError();
      this.renderSummary();
      syncFormState();
    });

    // Huỷ mã
    $('#removeCouponBtn').on('click', (e)=>{
      e.preventDefault();
      CURRENT_COUPON = null;
      $('#couponInput').val('');
      this.renderSummary();
      syncFormState();
    });

    // ===== Timer cho QR (60s) =====
    let _qrTimer = null;
    let _qrLeft = 60;

    function stopQrTimer(){
      if(_qrTimer){ clearInterval(_qrTimer); _qrTimer = null; }
    }

    function startQrTimer(seconds = 60){
      stopQrTimer();
      _qrLeft = seconds;
      $('#qrCountdown').text(_qrLeft);
      $('#qrTimerWrap').removeClass('d-none');

      _qrTimer = setInterval(()=>{
        _qrLeft -= 1;
        $('#qrCountdown').text(_qrLeft);
        if(_qrLeft <= 0){
          stopQrTimer();
          // Hết thời gian -> reload trang
          location.reload();
        }
      }, 1000);
    }

    // Dọn dẹp khi đóng modal hoặc đổi phương thức
    $('#cartModal').on('hidden.bs.modal', ()=>{
      stopQrTimer();
      $('#qrTimerWrap').addClass('d-none');
      $('#qrCodeImage').attr('src','');
    });
    $('#paymentGroup').on('change','input[name="payment_method"]', ()=>{
      // Nếu chuyển khỏi bank thì ẩn timer
      const cur = $('#paymentGroup input[name="payment_method"]:checked').val();
      if(cur !== 'bank'){ stopQrTimer(); $('#qrTimerWrap').addClass('d-none'); }
    });

    // ===== Submit: gọi backend /api/orders/prepare rồi hiển thị QR/COD =====
    $('#checkoutForm').off('submit').on('submit', async (e)=>{
      e.preventDefault();
      e.stopPropagation();
      e.stopImmediatePropagation();

      $('#paymentError').addClass('d-none').text('');
      $('#qrWrap, #codWrap').addClass('d-none');

      const paymentMethod = $('#paymentGroup input[name="payment_method"]:checked').val();

      // gom dữ liệu gửi server (KHÔNG đổi logic cart)
      const payload = (function(){
        const $f = $('#checkoutForm');
        const shipping = {
          full_name: $f.find('[name="full_name"]').val()?.trim() || '',
          phone:     $f.find('[name="phone"]').val()?.trim() || '',
          email:     $f.find('[name="email"]').val()?.trim() || '',
          address:   $f.find('[name="address"]').val()?.trim() || '',
          province:  $f.find('[name="province"]').val()?.trim() || '',
          district:  $f.find('[name="district"]').val()?.trim() || '',
          note:      $f.find('[name="note"]').val()?.trim() || ''
        };
        const cart = (()=>{ try{return JSON.parse($('#cartJson').val()||'[]')}catch{return []} })();
        const coupon = ($('#couponCode').val()||'').trim().toUpperCase() || null;
        const client_totals = CartModal.totals(); // tổng tạm phía client
        return { shipping, cart, coupon, client_totals, payment_method: paymentMethod || 'cod' };
      })();

      if(!paymentMethod){
        $('#paymentError').removeClass('d-none').text('Vui lòng chọn phương thức thanh toán.');
        return false;
      }

      // loading nút submit
      const $btn = $('#checkoutForm button[type="submit"]');
      const old = $btn.html();
      const setLoading = (on)=> on
        ? $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Đang xử lý...')
        : $btn.prop('disabled', false).html(old);

      try{
        setLoading(true);
        let res = await callPrepare(payload);
        if(res.status === 419){ location.reload(); return false; }
        if(!res.ok){
          const txt = await res.text().catch(()=> '');
          throw new Error(txt || 'Không gọi được /api/orders/prepare');
        }
        const json = await res.json();

        if(!json || json.ok !== true || !json.data){
          throw new Error(json?.message || 'Không thể xác nhận đơn hàng. Vui lòng thử lại.');
        }

        const d = json.data; // { order_id, order_code, totals:{...}, qr_code|null }
        applyServerTotalsFromApi(d.totals);

        // Lưu order_id (nếu cần confirm sau)
        $('#checkoutForm').attr('data-order-id', d.order_id || '');

        if (d.qr_code) {
          // BANK: gán trực tiếp QR server trả về
          $('#qrCodeImage').attr('src', d.qr_code);
          $('#qrAmount').text(VND(Number(d.totals?.total || 0)));
          $('#qrWrap').removeClass('d-none');

          // chạy timer 60s → hết giờ reload
          startQrTimer(60);
          return false; // giữ modal mở
        } else {
          // COD: hiển thị đã xác nhận
          const amt = Number(d.totals?.total || 0);
          $('#codAmount').text(VND(amt));
          $('#codWrap').removeClass('d-none');

          // (tuỳ chọn) hiện toast xác nhận
          const toastEl = document.getElementById('actionToast');
          if(toastEl){
            toastEl.querySelector('.toast-body').textContent = `Đơn ${d.order_code || d.order_id} đã được xác nhận.`;
            new bootstrap.Toast(toastEl).show();
            // reload trang sau vài giây
            setTimeout(()=>{ location.reload(); }, 2000);
          }
          return false;
        }

      } catch(err){
        console.error(err);
        $('#paymentError').removeClass('d-none').text(err.message || 'Có lỗi xảy ra. Vui lòng thử lại.');
        return false;
      } finally {
        setLoading(false);
      }

      return false;
    });

  },

  open(){ this.renderItems(); this.renderSummary(); this.bs?.show(); },

  couponError(msg){
    $('#couponMessage').removeClass('d-none').text(msg);
    $('#appliedCouponBadge').addClass('d-none');
  },
  clearCouponError(){
    $('#couponMessage').addClass('d-none').text('');
  },

  totals(){
    const subtotal = CART.reduce((s,i)=> s + i.price*i.qty, 0);
    let ship = parseInt(subtotal) >= SHIP_THRESHOLD || subtotal===0 ? 0 : SHIP_FEE;

    const isBank = $('#paymentGroup input[name="payment_method"]:checked').val()==='bank';
    const bankDiscount = isBank ? Math.round(subtotal*BANK_OFF) : 0;

    let otherDiscount = 0;
    const code = (CURRENT_COUPON||'').toUpperCase();
    if(code && COUPONS[code]){
      const c = COUPONS[code];
      const ok = subtotal >= (c.min||0);
      if(c.kind==='amount' && ok)      otherDiscount = Math.min(c.value, subtotal);
      else if(c.kind==='ship' && ok)   ship = 0;
    }

    const total = Math.max(0, subtotal + ship - bankDiscount - otherDiscount);
    return {subtotal, ship, bankDiscount, otherDiscount, total, code};
  },

  renderSummary(){
    const t = this.totals();
    $('#sumSubtotal').text(VND(t.subtotal));
    $('#sumShip').text(VND(t.ship));
    $('#sumBankDiscount').text(t.bankDiscount?('-'+VND(t.bankDiscount)):'0₫');
    $('#sumOtherDiscount').text(t.otherDiscount?('-'+VND(t.otherDiscount)):'0₫');
    $('#sumTotal').text(VND(t.total));

    if(t.code && COUPONS[t.code]){
      $('#appliedCouponBadge .code').text(t.code);
      $('#appliedCouponBadge').removeClass('d-none');
      this.clearCouponError();
    }else{
      $('#appliedCouponBadge').addClass('d-none');
    }

    // Ghi totals vào hidden input để backend đọc
    syncFormState(t);
  },

  renderItems(){
    const $list = $('#cartItems');
    $('#cartItemsCount').text(`${CART.reduce((s,i)=>s+(i.qty||0),0)} sản phẩm`);
    if(!CART.length){
      $list.html(`<div class="text-center text-muted py-4"><i class="bi bi-bag-dash fs-1 d-block mb-2"></i>Giỏ hàng đang trống</div>`);
      return;
    }
    const rows = CART.map(i=>{
      const prod = Object.values(PRODUCTS).find(p => p.id === i.id);
      const img = prod?.image || $('#main-image').attr('src') || '';
      return `
        <div class="cart-item" data-key="${i.key}">
          <div class="cart-thumb"><img src="${img}" alt=""></div>
          <div class="flex-grow-1">
            <div class="d-flex justify-content-between">
              <div>
                <div class="cart-title">${i.name}</div>
                <div class="cart-variant">Loại: ${i.variant || '-'}</div>
              </div>
              <div class="cart-price">${VND(i.price)}</div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2">
              <div class="qty-box">
                <button type="button" class="btn btn-light btn-qty-minus" data-key="${i.key}"><i class="bi bi-dash"></i></button>
                <input type="number" min="1" class="item-qty" data-key="${i.key}" value="${i.qty}">
                <button type="button" class="btn btn-light btn-qty-plus" data-key="${i.key}"><i class="bi bi-plus"></i></button>
              </div>
              <button type="button" class="btn btn-outline-danger btn-sm btn-remove-item" data-key="${i.key}">
                <i class="bi bi-x-lg"></i> Xoá
              </button>
            </div>
          </div>
        </div>`;
    });
    $list.html(rows.join(''));
  },

  changeQty(key, delta){
    const item = CART.find(i=> i.key===key);
    if(!item) return;
    item.qty = Math.max(1, (item.qty||1)+delta);
    updateCartCount();
    this.renderItems(); this.renderSummary();
    syncFormState();
  },

  setQty(key, value){
    const item = CART.find(i=> i.key===key);
    if(!item) return;
    item.qty = Math.max(1, value);
    updateCartCount();
    this.renderItems(); this.renderSummary();
    syncFormState();
  },

  remove(key){
    CART = CART.filter(i=> i.key!==key);
    updateCartCount();
    this.renderItems(); this.renderSummary();
    syncFormState();
  }
};

// =================== REVIEWS (fetch từ API) ===================
const REVIEW_ENDPOINT = '/api/reviews'; // đổi theo backend nếu khác
const PAGE_SIZE_RV = 3;

let REVIEWS = [];        // sẽ được append theo trang
let rvPage = 1;          // trang hiện tại (1-based)
let rvTotal = 0;         // tổng số review (server trả về), dùng cho Load more
let rvLoading = false;

function initials(name){
  return name ? name.trim().charAt(0).toUpperCase() : "?";
}
function starStr(n){ return "★".repeat(n) + "☆".repeat(5-n); }

// Lấy product_id từ DOM nếu có (ưu tiên input ẩn), hoặc attr data, hoặc null
function getProductId(){
  const $hid = $('#product_id');
  if($hid.length && $hid.val()) return $hid.val();
  const $wrap = $('#reviewsWrap');
  if($wrap.length && $wrap.data('productId')) return $wrap.data('productId');
  // Nếu page là PDP helmet thì có thể reuse id hiện tại của sản phẩm đang select
  const cur = (PRODUCTS && currentKey && PRODUCTS[currentKey]) ? PRODUCTS[currentKey].id : null;
  return cur || null;
}

function mapApiReview(item){
  const media = Array.isArray(item.media) ? item.media.map(m => ({
    type: m.type || (/\.(mp4|mov|m4v|webm)$/i.test(m.url||m.src) ? 'video' : 'image'),
    src: m.url || m.src
  })) : [];
  const dateStr = (item.date || item.created_at || '').toString();
  return {
    id: item.id,
    author: item.author_name || item.author || 'Ẩn danh',
    avatar: item.avatar || '',
    verified: !!(item.verified || item.is_verified_purchase),
    rating: Number(item.rating) || 0,
    variant: item.variant_name || item.variant || '',
    date: dateStr ? dateStr.slice(0,10) : '',
    title: item.title || '',
    content: item.content || item.comment || '',
    media
  };
}

async function fetchReviews(page=1){
  if(rvLoading) return {data:[], total:rvTotal};
  rvLoading = true;
  try{
    const pid = getProductId();
    const qs = new URLSearchParams({
      page: String(page),
      page_size: String(PAGE_SIZE_RV),
      ...(pid ? { product_id: String(pid) } : {})
    });
    const res = await fetch(`${REVIEW_ENDPOINT}?${qs.toString()}`, { headers:{'Accept':'application/json'} });
    if(!res.ok) throw new Error('Fetch reviews failed');
    const json = await res.json();

    // Chuẩn hoá format (hỗ trợ 2 kiểu: {data,total} hoặc [] đơn thuần)
    const list = Array.isArray(json) ? json : (Array.isArray(json.data) ? json.data : []);
    const total = typeof json.total === 'number' ? json.total : (json.meta?.total ?? (Array.isArray(json) ? json.length : list.length));

    const mapped = list.map(mapApiReview);
    // Append
    REVIEWS = page === 1 ? mapped : REVIEWS.concat(mapped);
    rvTotal = total || REVIEWS.length;
    return {data:mapped, total: rvTotal};
  } catch(e){
    console.error(e);
    return {data:[], total: rvTotal};
  } finally {
    rvLoading = false;
  }
}

function renderRvSummary(){
  const count = rvTotal || REVIEWS.length;
  const avg = REVIEWS.length ? (REVIEWS.reduce((s,r)=>s+r.rating,0)/REVIEWS.length).toFixed(1) : '0.0';
  $("#rvAvg").text(avg);
  $("#rvStars").text(starStr(Math.round(Number(avg))));
  $("#rvCount").text(count);
}

function renderReview(r){
  const badge = r.verified ? `<span class="rv-badge">Đã mua hàng</span>` : "";
  const avatarHTML = r.avatar
    ? `<div class="rv-avatar"><img src="${r.avatar}" alt=""></div>`
    : `<div class="rv-avatar">${initials(r.author)}</div>`;
  const gallery = r.media && r.media.length ? `
    <div class="rv-gallery">
      ${r.media.map((m,i)=>{
        const icon = m.type==="video" ? `<div class="rv-play">🎬</div>` : "";
        return `<div class="rv-thumb" data-rid="${r.id}" data-index="${i}">
                  <img src="${m.src}" alt="">
                  ${icon}
                </div>`;
      }).join("")}
    </div>` : "";
  return `
    <div class="rv-card">
      <div class="rv-header mb-2">
        ${avatarHTML}
        <div class="rv-info">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <span class="rv-name">${r.author}</span>
              ${badge}
              <small class="text-muted ms-1">• ${r.variant || ''}</small>
            </div>
            <div class="small text-end">
              <span class="rv-stars">${starStr(r.rating)}</span><br>
              <span class="text-muted">${r.date}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="fw-semibold">${r.title||""}</div>
      <div class="text-secondary small">${r.content||""}</div>
      ${gallery}
    </div>`;
}

function renderRvList(){
  const $list = $("#rvList");
  $list.html(REVIEWS.map(renderReview).join(""));
  const hasMore = REVIEWS.length < (rvTotal || 0);
  if(hasMore) $("#rvLoadMore").removeClass('d-none');
  else $("#rvLoadMore").addClass('d-none');
}

function bindRvLightbox(){
  const modal = new bootstrap.Modal(document.getElementById("rvMediaModal"));
  $(document).off('click.rv').on("click.rv",".rv-thumb",function(){
    const rid = $(this).data("rid"), idx = +$(this).data("index");
    const rv = REVIEWS.find(r=>r.id===rid);
    if(!rv) return;
    const m = rv.media[idx];
    const stage = $("#rvMediaStage");
    if(m.type==="video"){
      stage.html(`<video src="${m.src}" controls autoplay style="width:100%;height:100%;object-fit:contain"></video>`);
    } else {
      stage.html(`<img src="${m.src}" style="width:100%;height:100%;object-fit:contain">`);
    }
    modal.show();
  });
}

async function initReviews(){
  // skeleton (tuỳ chọn)
  const $sk = $('#rvSkeleton');
  if($sk.length) $sk.removeClass('d-none');

  // Load trang đầu
  rvPage = 1; REVIEWS = []; rvTotal = 0;
  await fetchReviews(rvPage);

  if($sk.length) $sk.addClass('d-none');
  renderRvSummary();
  renderRvList();
  bindRvLightbox();

  $("#rvLoadMore").off('click').on("click", async ()=>{
    if(rvLoading) return;
    rvPage += 1;
    const before = REVIEWS.length;
    await fetchReviews(rvPage);
    // Nếu server trả rỗng, không tăng thêm trang nữa
    if(REVIEWS.length === before) rvPage -= 1;
    renderRvSummary();
    renderRvList();
  });
}

// =================== HERO SLIDER (giữ nguyên logic cũ) ===================
function initHeroSlider(){
  (function(){
    const $root   = document.getElementById('heroSlider');
    if(!$root) return;
    const $stage  = $root.querySelector('.slider-stage');
    const $imgs   = Array.from($stage.querySelectorAll('img'));
    const $prev   = $root.querySelector('.slider-prev');
    const $next   = $root.querySelector('.slider-next');
    const $dots   = $root.querySelector('.slider-dots');

    let i = 0;
    let timer = null;
    const INTERVAL = 4000; // ms

    // Build dots
    $imgs.forEach((_, idx)=>{
      const b = document.createElement('button');
      b.setAttribute('aria-label', 'Go to slide ' + (idx+1));
      b.addEventListener('click', ()=> go(idx, true));
      $dots.appendChild(b);
    });
    const $dotBtns = Array.from($dots.children);

    function render(){
      $imgs.forEach((img, idx)=> img.classList.toggle('active', idx===i));
      $dotBtns.forEach((d, idx)=> d.classList.toggle('active', idx===i));
    }
    function next(manual=false){
      i = (i + 1) % $imgs.length;
      render(); if(manual) restart();
    }
    function prev(manual=false){
      i = (i - 1 + $imgs.length) % $imgs.length;
      render(); if(manual) restart();
    }
    function go(idx, manual=false){
      i = (idx + $imgs.length) % $imgs.length;
      render(); if(manual) restart();
    }

    function start(){ stop(); timer = setInterval(next, INTERVAL); }
    function stop(){ if(timer){ clearInterval(timer); timer = null; } }
    function restart(){ start(); }

    // Controls
    $next.addEventListener('click', ()=> next(true));
    $prev.addEventListener('click', ()=> prev(true));

    // Pause on hover
    $root.addEventListener('mouseenter', stop);
    $root.addEventListener('mouseleave', start);

    // Keyboard
    $root.setAttribute('tabindex', '0'); // focusable
    $root.addEventListener('keydown', (e)=>{
      if(e.key === 'ArrowRight') next(true);
      if(e.key === 'ArrowLeft')  prev(true);
    });

    let touchX = null, touchY = null;
    $root.addEventListener('touchstart', (e)=>{
      const t = e.touches[0];
      touchX = t.clientX; touchY = t.clientY;
    }, {passive:true});
    $root.addEventListener('touchend', (e)=>{
      if(touchX===null) return;
      const t = e.changedTouches[0];
      const dx = t.clientX - touchX;
      const dy = t.clientY - touchY;
      if(Math.abs(dx) > Math.abs(dy) && Math.abs(dx) > 30){
        if(dx < 0) next(true);
        else prev(true);
      }
      touchX = touchY = null;
    }, {passive:true});

    render(); start();
  })();
}

// =================== INIT (GỌI API TRƯỚC, SAU ĐÓ GẮN UI) ===================
$(function(){
  (async function boot(){
    try{
      hydrateFromView();

      // 1) GỌI API TRƯỚC
      await loadProductsFromApi();

      // 2) RENDER UI DỰA TRÊN DATA
      buildVariantRadios();
      buildThumbnails();

      // 3) CHỌN SẢN PHẨM ĐẦU TIÊN
      currentKey = SLUGS[0];
      setVariant(currentKey, { syncUI:true });

      // 4) BIND SỰ KIỆN UI SP
      $(document).on('click', '.thumb', function(){
        const $t = $(this);
        const key = $t.data('variant');
        const big = $t.data('big');
        if (key && PRODUCTS[key]) {
          setVariant(key, { syncUI:true, fromThumb:true });
          if (big) fadeSwap($('#main-image'), big);
        } else if (big) {
          fadeSwap($('#main-image'), big);
        }
        $('.thumb').removeClass('active'); $t.addClass('active');
      });

      $('#variantGroup').on('change', 'input[name="variant"]', function(){
        const key = $(this).data('variant');
        if (key) setVariant(key, { syncUI:false });
      });

      $('#qtyMinus').on('click', function(){
        const v = Math.max(1, (parseInt($('#qty').val(),10) || 1) - 1);
        $('#qty').val(v);
      });
      $('#qtyPlus').on('click', function(){
        const v = (parseInt($('#qty').val(),10) || 1) + 1;
        $('#qty').val(v);
      });

      $('.addToCartBtn').on('click', function(){ withLoading($(this), ()=> addItem(false)); });
      $('#buyNowBtn').on('click', function(){ withLoading($(this), ()=> { CartModal.open(); }); });
      $('#mobileBuyNowBtn').on('click', function(){ withLoading($(this), ()=> { CartModal.open(); }); });

      CartModal.init();

      // 5) KHỞI TẠO REVIEW & SLIDER (không phụ thuộc API sản phẩm)
      initReviews();
      initHeroSlider();

    } catch (err){
      console.error(err);
      // fallback đơn giản
      $('#price,#mPrice,#sumTotal').text('0₫');
      $('#variantGroup').html('<div class="text-danger small">Không tải được sản phẩm.</div>');
      initReviews();
      initHeroSlider();
    }
  })();
});
