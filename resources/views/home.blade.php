<!doctype html>
<html lang="vi">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mũ Bảo Hiểm Trẻ Em | Single Product</title>
    <meta name="description" content="Mũ bảo hiểm cho bé 2–6 tuổi — ABS nguyên sinh, lót EPS thoáng khí, quai mềm, an toàn khi đi xe đạp/xe máy." />

    <!-- Fonts & Bootstrap -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
  </head>
  <body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg sticky-top">
      <div class="container py-2">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
          <span class="d-inline-block p-2 rounded-3" style="background:rgba(14,165,233,.1);color:var(--brand)">
            <i class="bi bi-shield-check"></i>
          </span>
          Nón Bảo Hiểm Bé
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div id="nav" class="collapse navbar-collapse">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="#features">Tính năng</a></li>
            <li class="nav-item"><a class="nav-link" href="#specs">Thông số</a></li>
            <li class="nav-item"><a class="nav-link" href="#reviews">Đánh giá</a></li>
          </ul>
          <div class="d-flex align-items-center gap-2 ms-lg-3">
            <a class="btn btn-sm btn-outline-brand" href="#buy">Đặt hàng</a>
            <!-- MỞ MODAL BẰNG DATA-API -->
            <a class="btn btn-sm btn-light position-relative" href="#" id="cartBtn"
               data-bs-toggle="modal" data-bs-target="#cartModal" aria-label="Giỏ hàng">
              <i class="bi bi-cart3"></i>
              <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
            </a>
          </div>
        </div>
      </div>
    </nav>



    <main class="container my-5">
      <div class="row g-4 align-items-start">
        <!-- Gallery -->
        <div class="col-lg-6">
          <div class="card-soft p-3 p-sm-4">
            <div class="ratio ratio-1x1 mb-3">
              <img id="main-image" class="w-100 h-100 object-fit-cover rounded-3" src="./nonbaohiem/anhlamro/labubu.png" alt="Ảnh sản phẩm" />
            </div>

            <div class="row g-3" id="thumbRow">
              <div class="col-3"><img class="thumb w-100 active" src="./nonbaohiem/anhlamro/labubu.png" data-big="./nonbaohiem/anhlamro/labubu.png" data-variant="labubu" alt="Labubu"></div>
              <div class="col-3"><img class="thumb w-100" src="./nonbaohiem/anhlamro/kurumi_hong.png" data-big="./nonbaohiem/anhlamro/kurumi_hong.png" data-variant="kurumihong" alt="Kurumi hồng"></div>
              <div class="col-3"><img class="thumb w-100" src="./nonbaohiem/anhlamro/kurumi_tim.png" data-big="./nonbaohiem/anhlamro/kurumi_tim.png" data-variant="kurumitim" alt="Kurumi tím"></div>
              <div class="col-3"><img class="thumb w-100" src="./nonbaohiem/anhlamro/cappypara.png" data-big="./nonbaohiem/anhlamro/cappypara.png" data-variant="cappypara" alt="Cappypara"></div>
              <div class="col-3"><img class="thumb w-100" src="./nonbaohiem/anhlamro/lupy.png" data-big="./nonbaohiem/anhlamro/lupy.png" data-variant="lupy" alt="Lupy"></div>
              <div class="col-3"><img class="thumb w-100" src="./nonbaohiem/anhlamro/babytreecam.png" data-big="./nonbaohiem/anhlamro/babytreecam.png" data-variant="babytreecam" alt="Baby Tree cam"></div>
              <div class="col-3"><img class="thumb w-100" src="./nonbaohiem/anhlamro/babytreeden.png" data-big="./nonbaohiem/anhlamro/babytreeden.png" data-variant="babytreeden" alt="Baby Tree đen"></div>
              <div class="col-3"><img class="thumb w-100" src="./nonbaohiem/anhlamro/babytreehong.png" data-big="./nonbaohiem/anhlamro/babytreehong.png" data-variant="babytreehong" alt="Baby Tree hồng"></div>
            </div>
          </div>
        </div>

        <!-- Details -->
        <div class="col-lg-6">
          <div class="card-soft p-4 p-md-5">
            <div class="d-flex align-items-center gap-2 mb-2">
              <span class="badge badge-soft rounded-pill">Freesize 2–6 tuổi</span>
              <span class="text-muted">Vòng đầu &lt; 52cm</span>
            </div>

            <h1 class="h2 fw-bold mb-2">Mũ Bảo Hiểm Cho Bé 2–6 Tuổi</h1>
            <div class="d-flex align-items-center gap-3 mb-3">
              <div class="rating small">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                <i class="bi bi-star-half"></i>
                <span class="ms-1 text-muted">4.5 (268)</span>
              </div>
              <span class="vr"></span>
              <span class="text-success fw-semibold"><i class="bi bi-shield-check me-1"></i>Đạt chuẩn an toàn</span>
            </div>

            <div class="d-flex align-items-end gap-3 mb-3">
              <div id="price" class="price">—</div>
              <div id="compare" class="strike d-none">—</div>
              <span id="discountBadge" class="badge text-bg-success d-none">—%</span>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Loại sản phẩm</label>
              <div class="d-flex gap-2 flex-wrap" id="variantGroup">
                <input type="radio" class="btn-check" name="variant" id="v_labubu" data-variant="labubu" data-image="./nonbaohiem/anhlamro/labubu.png" checked>
                <label class="btn btn-outline-brand btn-sm" for="v_labubu">Labubu</label>

                <input type="radio" class="btn-check" name="variant" id="v_kurumi_hong" data-variant="kurumihong" data-image="./nonbaohiem/anhlamro/kurumi_hong.png">
                <label class="btn btn-outline-brand btn-sm" for="v_kurumi_hong">Kurumi hồng</label>

                <input type="radio" class="btn-check" name="variant" id="v_kurumi_tim" data-variant="kurumitim" data-image="./nonbaohiem/anhlamro/kurumi_tim.png">
                <label class="btn btn-outline-brand btn-sm" for="v_kurumi_tim">Kurumi tím</label>

                <input type="radio" class="btn-check" name="variant" id="v_cappypara" data-variant="cappypara" data-image="./nonbaohiem/anhlamro/cappypara.png">
                <label class="btn btn-outline-brand btn-sm" for="v_cappypara">Cappypara</label>

                <input type="radio" class="btn-check" name="variant" id="v_lupy" data-variant="lupy" data-image="./nonbaohiem/anhlamro/lupy.png">
                <label class="btn btn-outline-brand btn-sm" for="v_lupy">Lupy</label>

                <input type="radio" class="btn-check" name="variant" id="v_babytreehong" data-variant="babytreehong" data-image="./nonbaohiem/anhlamro/babytreehong.png">
                <label class="btn btn-outline-brand btn-sm" for="v_babytreehong">Baby Tree hồng</label>

                <input type="radio" class="btn-check" name="variant" id="v_babytreecam" data-variant="babytreecam" data-image="./nonbaohiem/anhlamro/babytreecam.png">
                <label class="btn btn-outline-brand btn-sm" for="v_babytreecam">Baby Tree cam</label>

                <input type="radio" class="btn-check" name="variant" id="v_babytreeden" data-variant="babytreeden" data-image="./nonbaohiem/anhlamro/babytreeden.png">
                <label class="btn btn-outline-brand btn-sm" for="v_babytreeden">Baby Tree đen</label>
              </div>
            </div>

            <div class="row g-2 align-items-center mb-4">
              <div class="col-auto"><label class="form-label fw-semibold mb-0">Số lượng</label></div>
              <div class="col-auto">
                <div class="input-group" style="max-width:140px">
                  <button class="btn btn-outline-secondary" type="button" id="qtyMinus"><i class="bi bi-dash"></i></button>
                  <input id="qty" type="number" class="form-control text-center" min="1" value="1">
                  <button class="btn btn-outline-secondary" type="button" id="qtyPlus"><i class="bi bi-plus"></i></button>
                </div>
              </div>
            </div>

            <div class="d-grid gap-2 d-sm-flex" id="buy">
              <button id="buyNowBtn" class="btn btn-brand btn-lg px-4" type="button"><i class="bi bi-bag-check me-2"></i>Đặt hàng ngay</button>
              <button id="addToCartBtn" class="btn btn-outline-brand btn-lg px-4" type="button"><i class="bi bi-cart-plus me-2"></i>Thêm vào giỏ</button>
            </div>

            <div class="row g-3 mt-4 small text-muted">
              <div class="col-md-4 d-flex align-items-center gap-2"><i class="bi bi-truck"></i> Giao nhanh 2–4 ngày</div>
              <div class="col-md-4 d-flex align-items-center gap-2"><i class="bi bi-arrow-counterclockwise"></i> Đổi trả 7 ngày</div>
              <div class="col-md-4 d-flex align-items-center gap-2"><i class="bi bi-shield-lock"></i> Thanh toán bảo mật</div>
            </div>

            <!-- Voucher Box -->
            <div class="voucher-box">
              <h6><i class="bi bi-gift me-2"></i>ƯU ĐÃI HOT DÀNH CHO BẠN</h6>

              <div class="voucher-item">
                <div class="voucher-left">
                  <div class="voucher-icon"><i class="bi bi-percent"></i></div>
                  <div>
                    <p class="voucher-desc mb-1">Giảm <b>15K</b> cho đơn từ <b>399K</b></p>
                    <span class="voucher-code" data-code="SALE15KN">SALE15KN</span>
                  </div>
                </div>
              </div>

              <div class="voucher-item">
                <div class="voucher-left">
                  <div class="voucher-icon"><i class="bi bi-truck"></i></div>
                  <div>
                    <p class="voucher-desc mb-1">Miễn phí vận chuyển đơn từ <b>300K</b></p>
                    <span class="voucher-code" data-code="FREESHIP10">FREESHIP10</span>
                  </div>
                </div>
              </div>

              <div class="voucher-item">
                <div class="voucher-left">
                  <div class="voucher-icon"><i class="bi bi-cash-coin"></i></div>
                  <div>
                    <p class="voucher-desc mb-1">Giảm <b>8%</b> khi thanh toán chuyển khoản</p>
                    <span class="voucher-code" data-code="BANK8OFF">BANK8OFF</span>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- Features (demo) -->
      <section id="features" class="mt-5 pt-4">
        <div class="row g-4">
          <div class="col-lg-3 col-sm-6">
            <div class="card-soft p-4 h-100">
              <h5 class="fw-semibold">Vỏ ABS nguyên sinh</h5>
              <p class="text-secondary mb-0">Bền, chịu va đập tốt.</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card-soft p-4 h-100">
              <h5 class="fw-semibold">Lót EPS thoáng khí</h5>
              <p class="text-secondary mb-0">Thoát mồ hôi, êm đầu.</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card-soft p-4 h-100">
              <h5 class="fw-semibold">Quai êm</h5>
              <p class="text-secondary mb-0">Không cọ cổ, dễ chịu.</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card-soft p-4 h-100">
              <h5 class="fw-semibold">Vành che</h5>
              <p class="text-secondary mb-0">Giảm chói, cản gió nhẹ.</p>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- slide show img -->
  <div class="hero-media" id="heroSlider">
    <div class="slider-stage">
      <img src="{{ asset('public/images/nonbaohiem/anhlamro/main.jpeg') }}" alt="Hero 1" loading="lazy">
      <img src="{{ asset('public/images/nonbaohiem/anhlamro/kurumi_couple.png') }}" alt="Hero 2" loading="lazy">
    </div>

    <button class="slider-btn slider-prev text-dark" aria-label="Prev"><i class="bi bi-chevron-left"></i></button>
    <button class="slider-btn slider-next text-dark" aria-label="Next"><i class="bi bi-chevron-right"></i></button>

    <!-- Dots -->
    <div class="slider-dots" aria-label="Slide indicators"></div>
  </div>

    <!-- Reviews -->
    <section id="reviews" class="mt-5 pt-4">
      <div class="card-soft p-4 p-md-5">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h5 class="fw-bold mb-0"><i class="bi bi-chat-square-text me-2"></i>Đánh giá từ khách hàng</h5>
          <div class="text-end">
            <div class="fs-2 fw-bold" id="rvAvg">4.8</div>
            <div class="text-warning" id="rvStars">★★★★★</div>
            <small class="text-muted"><span id="rvCount">0</span> lượt đánh giá</small>
          </div>
        </div>

        <div id="rvList" class="vstack gap-3"></div>

        <div class="text-center mt-4">
          <button id="rvLoadMore" class="btn btn-outline-secondary btn-sm">Xem thêm</button>
        </div>
      </div>
    </section>

    <!-- Media Modal -->
    <div class="modal fade" id="rvMediaModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-black border-0">
          <button type="button" class="btn btn-light position-absolute top-0 end-0 m-2" data-bs-dismiss="modal">
            <i class="bi bi-x-lg"></i>
          </button>
          <div id="rvMediaStage" class="ratio ratio-16x9"></div>
        </div>
      </div>
    </div>


<!-- Media Modal -->
<div class="modal fade" id="rvMediaModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bg-black border-0">
      <button type="button" class="btn btn-light position-absolute top-0 end-0 m-2" data-bs-dismiss="modal">
        <i class="bi bi-x-lg"></i>
      </button>
      <div id="rvMediaStage" class="ratio ratio-16x9"></div>
    </div>
  </div>
</div>


<!-- Media Viewer Modal -->
<div class="modal fade" id="rvMediaModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bg-black text-white border-0">
      <div class="modal-body position-relative p-0">
        <button type="button" class="btn btn-light position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Đóng">
          <i class="bi bi-x-lg"></i>
        </button>

        <button class="btn btn-dark position-absolute top-50 start-0 translate-middle-y ms-2 rv-prev" aria-label="Prev">
          <i class="bi bi-chevron-left"></i>
        </button>
        <button class="btn btn-dark position-absolute top-50 end-0 translate-middle-y me-2 rv-next" aria-label="Next">
          <i class="bi bi-chevron-right"></i>
        </button>

        <div class="ratio ratio-16x9" id="rvMediaStage">
          <!-- JS sẽ render <img> hoặc <video> -->
        </div>

        <div class="p-3 small d-flex align-items-center justify-content-between">
          <div id="rvMediaCaption" class="text-truncate pe-2"></div>
          <div id="rvMediaPager" class="text-muted"></div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Sticky Buy (mobile) -->
    <div class="sticky-buy py-3 d-lg-none">
      <div class="container d-flex align-items-center justify-content-between gap-3">
        <div>
          <div id="mPrice" class="fw-bold">—</div>
          <small class="text-muted"><span id="mCompare" class="strike d-none">—</span></small>
        </div>
        <button id="mobileBuyNowBtn" class="btn btn-brand btn-lg px-4" type="button"><i class="bi bi-bag-check me-2"></i> Thanh Toán </button>
      </div>
    </div>

    <!-- Footer -->
    <footer class="py-5 mt-4">
      <div class="container small text-secondary d-flex justify-content-between">
        <div>© 2025 Nón Bảo Hiểm Bé</div>
        <div>Chính sách • Điều khoản • Liên hệ</div>
      </div>
    </footer>

    <!-- Toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index:1080">
      <div id="actionToast" class="toast" role="status" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <i class="bi bi-check2-circle me-2"></i>
          <strong class="me-auto">Thành công</strong>
          <small class="text-muted">Vừa xong</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">Đã thêm vào giỏ hàng.</div>
      </div>
    </div>

    <!-- Cart / Checkout Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i class="bi bi-cart3 me-2"></i>Giỏ hàng & Thanh toán</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
          </div>
          <div class="modal-body">
            <div class="row g-4">
              <div class="col-lg-7">
                <div class="border rounded-3 p-3">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <strong>Danh sách sản phẩm</strong>
                    <small class="text-muted" id="cartItemsCount">0 sản phẩm</small>
                  </div>
                  <div id="cartItems" class="vstack gap-3"></div>
                </div>
              </div>
              <div class="col-lg-5">
                <form id="checkoutForm" class="border rounded-3 p-3">
                  <strong class="d-block mb-2">Thông tin giao hàng</strong>
                  <div class="row g-2">
                    <div class="col-12"><label class="form-label mb-1">Họ tên</label><input type="text" class="form-control" name="full_name" required></div>
                    <div class="col-6"><label class="form-label mb-1">SĐT</label><input type="tel" class="form-control" name="phone" required></div>
                    <div class="col-6"><label class="form-label mb-1">Email</label><input type="email" class="form-control" name="email"></div>
                    <div class="col-12"><label class="form-label mb-1">Địa chỉ</label><input type="text" class="form-control" name="address" required></div>
                    <div class="col-6"><label class="form-label mb-1">Tỉnh/Thành</label><input type="text" class="form-control" name="province" required></div>
                    <div class="col-6"><label class="form-label mb-1">Quận/Huyện</label><input type="text" class="form-control" name="district" required></div>
                    <div class="col-12"><label class="form-label mb-1">Ghi chú</label><textarea rows="2" class="form-control" name="note"></textarea></div>
                  </div>
                  <hr class="my-3">
                  <strong class="d-block mb-2">Phương thức thanh toán</strong>
                  <div class="vstack gap-2 mb-2" id="paymentGroup">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="payment_method" id="pm_cod" value="cod" checked>
                      <label class="form-check-label" for="pm_cod">COD</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="payment_method" id="pm_bank" value="bank">
                      <label class="form-check-label" for="pm_bank">Chuyển khoản (giảm 15%)</label>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between small text-muted">
                    <span>Freeship đơn từ 150K</span>
                    <a href="#buy" class="text-decoration-none">Thêm sản phẩm</a>
                  </div>
                  <hr class="my-3">

                  <strong class="d-block mb-2">Mã giảm giá</strong>
                  <div class="input-group mb-2" id="couponRow">
                    <input type="text" class="form-control" id="couponInput" placeholder="Nhập mã (ví dụ: SALE15KN)">
                    <button class="btn btn-outline-primary" type="button" id="applyCouponBtn">Áp dụng</button>
                  </div>
                  <div class="small">
                    <span id="appliedCouponBadge" class="badge text-bg-success d-none">
                      <i class="bi bi-ticket-perforated me-1"></i>
                      <span class="code">—</span>
                      <button type="button" class="btn btn-sm btn-link text-white text-decoration-none ms-1 p-0" id="removeCouponBtn">Huỷ</button>
                    </span>
                    <span id="couponMessage" class="text-danger d-none ms-2"></span>
                  </div>

                  <hr class="my-3">
                  <div class="vstack gap-1">
                    <div class="d-flex justify-content-between"><span>Tạm tính</span><strong id="sumSubtotal">0₫</strong></div>
                    <div class="d-flex justify-content-between"><span>Phí vận chuyển</span><strong id="sumShip">0₫</strong></div>
                    <div class="d-flex justify-content-between"><span>Giảm chuyển khoản</span><strong id="sumBankDiscount">0₫</strong></div>
                    <div class="d-flex justify-content-between"><span>Giảm khác</span><strong id="sumOtherDiscount">0₫</strong></div>
                    <div class="d-flex justify-content-between fs-5 mt-2"><span><strong>Tổng</strong></span><span><strong id="sumTotal">0₫</strong></span></div>
                  </div>
                  <div class="d-grid mt-3">
                    <input type="hidden" id="cartJson"   name="cart_json"   value="[]">
                    <input type="hidden" id="couponCode" name="coupon_code" value="">
                    <input type="hidden" id="totalsJson" name="totals_json" value="{}">
                    <button type="submit" class="btn btn-brand btn-lg"><i class="bi bi-shield-lock me-2"></i>Đặt hàng</button>
                  </div>
                  <div class="text-center mt-2 small text-muted">Đặt hàng = đồng ý điều khoản.</div>


                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Tiếp tục mua</button></div>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
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
        </script>
        <script>
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
        </script>
        <script>
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
    </script>

</body>
</html>
