// =================== CONSTANTS / DATA ===================
const SHIP_THRESHOLD = 300000;   // >= 300k freeship
const SHIP_FEE       = 30000;    // 30k nếu chưa đủ ngưỡng
const BANK_OFF       = 0.08;     // -8% khi chuyển khoản

// Biến thể (giả lập)
const VARIANTS = {
labubu:      { name:'Labubu',        price:249000, compare_at:299000, image:'./nonbaohiem/anhlamro/labubu.png' },
kurumihong:  { name:'Kurumi Hồng',   price:259000, compare_at:289000, image:'./nonbaohiem/anhlamro/kurumi_hong.png' },
kurumitim:   { name:'Kurumi Tím',    price:269000, compare_at:299000, image:'./nonbaohiem/anhlamro/kurumi_tim.png' },
cappypara:   { name:'Cappypara',     price:279000, compare_at:299000, image:'./nonbaohiem/anhlamro/cappypara.png' },
lupy:        { name:'Lupy',          price:239000, compare_at:269000, image:'./nonbaohiem/anhlamro/lupy.png' },
babytreecam: { name:'Baby Tree Cam', price:249000, compare_at:289000, image:'./nonbaohiem/anhlamro/babytreecam.png' },
babytreeden: { name:'Baby Tree Đen', price:259000, compare_at:299000, image:'./nonbaohiem/anhlamro/babytreeden.png' },
babytreehong:{ name:'Baby Tree Hồng',price:239000, compare_at:289000, image:'./nonbaohiem/anhlamro/babytreehong.png' },
};

// Coupon table (demo)
const COUPONS = {
SALE15KN:  { kind:'amount', value:15000, min:399000, label:'Giảm 15K đơn từ 399K' },
SALE30KN:  { kind:'amount', value:30000, min:699000, label:'Giảm 30K đơn từ 699K' },
GG60KN:    { kind:'amount', value:60000, min:999000, label:'Giảm 60K đơn từ 999K' },
FREESHIP10:{ kind:'ship',   value:0,     min:300000, label:'Miễn phí vận chuyển từ 300K' }
};

// Product meta
const PRODUCT = { id:'helmet-kids-2-6', name:'Mũ Bảo Hiểm Cho Bé 2–6 Tuổi' };

// =================== VIEW-STATE (thay cho localStorage) ===================
let CART = [];                 // [{key,id,name,variant,price,qty}]
let CURRENT_COUPON = null;     // string|null
let currentKey = 'labubu';     // variant đang chọn

// =================== HELPERS ===================
const VND = n => (n||0).toLocaleString('vi-VN') + '₫';
const $F = sel => $(sel); // alias ngắn

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
// Nếu backend render sẵn dữ liệu:
try{
    const vCart = $('#cartJson').val();
    if(vCart){ const parsed = JSON.parse(vCart); if(Array.isArray(parsed)) CART = parsed; }
}catch{}
const vCoupon = ($('#couponCode').val()||'').trim().toUpperCase();
CURRENT_COUPON = vCoupon || null;

updateCartCount();
syncFormState(); // đồng bộ lại (tránh backend không ghi totals)
}

// =================== VARIANT ===================
function setVariant(key, options){
const opts = $.extend({ syncUI:true, fromThumb:false }, options||{});
const v = VARIANTS[key];
if(!v) return;
currentKey = key;

// 1) Ảnh lớn
fadeSwap($('#main-image'), v.image);

// 2) Giá + badge
$('#price').text(VND(v.price));
$('#mPrice').text(VND(v.price));

if (v.compare_at && v.compare_at > v.price) {
    $('#compare').text(VND(v.compare_at)).removeClass('d-none');
    $('#mCompare').text(VND(v.compare_at)).removeClass('d-none');
    const disc = Math.round((1 - v.price / v.compare_at) * 100);
    $('#discountBadge').text(`-${disc}%`).removeClass('d-none');
} else {
    $('#compare').addClass('d-none');
    $('#mCompare').addClass('d-none');
    $('#discountBadge').addClass('d-none');
}

// 3) Đồng bộ radio (nếu không từ thumbnail)
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
const v = VARIANTS[currentKey];
const quantity = posQty();
const itemKey = `${PRODUCT.id}:${currentKey}`;

const ex = CART.find(i=> i.key === itemKey);
if(ex){ ex.qty += quantity; }
else { CART.push({ key:itemKey, id:PRODUCT.id, name:PRODUCT.name, variant:v.name, price:v.price, qty:quantity }); }

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
    this.bs = new bootstrap.Modal(document.getElementById('cartModal'));

    // Mở modal
    $('#cartBtn').on('click', (e)=>{ e.preventDefault(); this.open(); });

    // Khi modal show: bind coupon từ view
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
    syncFormState(); // cập nhật vào input ẩn
    });

    // Huỷ mã
    $('#removeCouponBtn').on('click', (e)=>{
    e.preventDefault();
    CURRENT_COUPON = null;
    $('#couponInput').val('');
    this.renderSummary();
    syncFormState();
    });

    // Submit checkout (demo)
    $('#checkoutForm').on('submit', (e)=>{
        // Ở đây anh có thể để nguyên — form đã có cart_json, coupon_code, totals_json gửi lên backend
        // Không clear giỏ tại FE (tuỳ nghiệp vụ)
        e.preventDefault();
        // Kiêm tra đơn hàng trống
        if(CART.length===0){
            alert('Giỏ hàng trống! Vui lòng thêm sản phẩm trước khi thanh toán.');
            return;
        }

    });
},

open(){ this.renderItems(); this.renderSummary(); this.bs.show(); },

couponError(msg){
    $('#couponMessage').removeClass('d-none').text(msg);
    $('#appliedCouponBadge').addClass('d-none');
},
clearCouponError(){
    $('#couponMessage').addClass('d-none').text('');
},

totals(){
    const subtotal = CART.reduce((s,i)=> s + i.price*i.qty, 0);
    let ship = subtotal>=SHIP_THRESHOLD || subtotal===0 ? 0 : SHIP_FEE;

    const isBank = $('#paymentGroup input[name="payment_method"]:checked').val()==='bank';
    const bankDiscount = isBank ? Math.round(subtotal*BANK_OFF) : 0;

    let otherDiscount = 0;
    const code = (CURRENT_COUPON||'').toUpperCase();
    if(code && COUPONS[code]){
    const c = COUPONS[code];
    const ok = subtotal >= (c.min||0);
    if(c.kind==='amount' && ok){
        otherDiscount = Math.min(c.value, subtotal);
    }else if(c.kind==='ship' && ok){
        ship = 0;
    }
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
    const keyVariant = (i.key.split(':')[1]) || '';
    const img = VARIANTS[keyVariant]?.image || $('#main-image').attr('src') || '';
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

// =================== INIT & UI EVENTS ===================
$(function(){
hydrateFromView(); // đọc cart/coupon từ input ẩn nếu backend đã render

// Variant init
const $checked = $('#variantGroup input[name="variant"]:checked');
setVariant($checked.data('variant') || 'labubu', { syncUI:true });

// Thumbnails
$(document).on('click', '.thumb', function(){
    const $t = $(this);
    const key = $t.data('variant');
    const big = $t.data('big');
    if (key && VARIANTS[key]) {
    setVariant(key, { syncUI:true, fromThumb:true });
    if (big) fadeSwap($('#main-image'), big);
    } else if (big) {
    fadeSwap($('#main-image'), big);
    }
    $('.thumb').removeClass('active');
    $t.addClass('active');
});

// Radio variant
$('#variantGroup').on('change', 'input[name="variant"]', function(){
    const key = $(this).data('variant');
    if (key) setVariant(key, { syncUI:false });
});

// Quantity
$('#qtyMinus').on('click', function(){
    const v = Math.max(1, (parseInt($('#qty').val(),10) || 1) - 1);
    $('#qty').val(v);
});
$('#qtyPlus').on('click', function(){
    const v = (parseInt($('#qty').val(),10) || 1) + 1;
    $('#qty').val(v);
});

// CTA
$('#addToCartBtn').on('click', function(){ withLoading($(this), ()=> addItem(false)); });

$('#buyNowBtn').on('click', function(){
    withLoading($(this), ()=> { CartModal.open(); });
});

$('#mobileBuyNowBtn').on('click', function(){
    withLoading($(this), ()=> { CartModal.open(); });
});

// Copy voucher code (nếu có block voucher)
$(document).on('click', '.voucher-code', function(){
    const code = $(this).data('code'); if(!code) return;
    if (navigator.clipboard?.writeText) { navigator.clipboard.writeText(code); }
    else { const $temp = $('<input>').appendTo('body').val(code).select(); document.execCommand('copy'); $temp.remove(); }
    const $self = $(this), old = $self.text(); $self.text('Đã sao chép!'); setTimeout(()=> $self.text(old), 2000);
});

// Cart modal
CartModal.init();
});

const REVIEWS = [
{
    id:1,
    author:"Thuỷ Tiên",
    avatar:"./nonbaohiem/avatars/thuytien.jpg",
    verified:true,
    rating:5,
    variant:"Labubu",
    date:"2025-03-02",
    title:"Đẹp & nhẹ",
    content:"Mũ lên form gọn, bé 4 tuổi đội vừa vặn. Màu in rõ nét.",
    media:[
    {type:"image",src:"./nonbaohiem/anhlamro/labubu.png"},
    {type:"image",src:"./nonbaohiem/anhlamro/babytreehong.png"}
    ]
},
{
    id:2,
    author:"Minh Quân",
    avatar:"",
    verified:true,
    rating:4,
    variant:"Kurumi Hồng",
    date:"2025-02-25",
    title:"Ổn so với giá",
    content:"Mũ chắc chắn, màu đúng như hình. Giao hàng nhanh.",
    media:[
    {type:"video",src:"./nonbaohiem/media/review1.mp4"},
    {type:"image",src:"./nonbaohiem/anhlamro/kurumi_hong.png"}
    ]
},
{
    id:3,
    author:"Hồng Nhung",
    avatar:"",
    verified:false,
    rating:5,
    variant:"Baby Tree Cam",
    date:"2025-02-18",
    title:"Bé mê luôn",
    content:"Bé đòi đội suốt, nhìn ngoài còn xinh hơn hình.",
    media:[
    {type:"image",src:"./nonbaohiem/anhlamro/babytreecam.png"}
    ]
}
];

const PAGE_SIZE_RV = 3;
let rvPage = 1;

function initials(name){
return name ? name.trim().charAt(0).toUpperCase() : "?";
}
function starStr(n){ return "★".repeat(n) + "☆".repeat(5-n); }

function renderSummary(){
const count = REVIEWS.length;
const avg = (REVIEWS.reduce((s,r)=>s+r.rating,0)/count).toFixed(1);
$("#rvAvg").text(avg);
$("#rvStars").text(starStr(Math.round(avg)));
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
            <small class="text-muted ms-1">• ${r.variant}</small>
            </div>
            <div class="small text-end">
            <span class="rv-stars">${starStr(r.rating)}</span><br>
            <span class="text-muted">${r.date}</span>
            </div>
        </div>
        </div>
    </div>
    <div class="fw-semibold">${r.title||""}</div>
    <div class="text-secondary small">${r.content}</div>
    ${gallery}
    </div>`;
}

function renderList(){
const visible = REVIEWS.slice(0, rvPage*PAGE_SIZE_RV);
$("#rvList").html(visible.map(renderReview).join(""));
if(visible.length < REVIEWS.length) $("#rvLoadMore").removeClass("d-none");
else $("#rvLoadMore").addClass("d-none");
}

$(function(){
renderSummary();
renderList();

$("#rvLoadMore").on("click", ()=>{ rvPage++; renderList(); });

const modal = new bootstrap.Modal(document.getElementById("rvMediaModal"));
$(document).on("click",".rv-thumb",function(){
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
});
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

    function start(){
    stop();
    timer = setInterval(next, INTERVAL);
    }
    function stop(){
    if(timer){ clearInterval(timer); timer = null; }
    }
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
