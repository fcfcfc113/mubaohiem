{{-- Toast --}}
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

{{-- Media Viewer Modal (DUY NHẤT) --}}
<div class="modal fade" id="rvMediaModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bg-black text-white border-0">
      <div class="modal-body position-relative p-0">
        <button type="button" class="btn btn-light position-absolute top-0 end-0 m-2"
                data-bs-dismiss="modal" aria-label="Đóng">
          <i class="bi bi-x-lg"></i>
        </button>

        <button class="btn btn-dark position-absolute top-50 start-0 translate-middle-y ms-2 rv-prev" aria-label="Prev">
          <i class="bi bi-chevron-left"></i>
        </button>
        <button class="btn btn-dark position-absolute top-50 end-0 translate-middle-y me-2 rv-next" aria-label="Next">
          <i class="bi bi-chevron-right"></i>
        </button>

        <div class="ratio ratio-16x9" id="rvMediaStage">
          {{-- JS sẽ render <img> hoặc <video> --}}
        </div>

        <div class="p-3 small d-flex align-items-center justify-content-between">
          <div id="rvMediaCaption" class="text-truncate pe-2"></div>
          <div id="rvMediaPager" class="text-muted"></div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Cart / Checkout Modal --}}
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
                <div class="col-6"><label class="form-label mb-1">Quận/Huyện/Xã</label><input type="text" class="form-control" name="district" required></div>
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
              <img id="qrCodeImage" class="img-fluid mt-2" src="" alt="QR Code">
              <div id="qrTimerWrap" class="small text-muted mt-2 d-none">
                Vui lòng thanh toán trong <b id="qrCountdown">40</b>s.
                Hết thời gian hệ thống sẽ tải lại trang.
                </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tiếp tục mua</button>
      </div>
    </div>
  </div>
</div>
