<div class="card-soft p-4 p-md-5">
    <div class="d-flex align-items-center gap-2 mb-2">
        <span class="badge badge-soft rounded-pill">Freesize 2–6 tuổi</span>
        <span class="text-muted">Vòng đầu 48-52cm</span>
    </div>

    <h1 class="h2 fw-bold mb-2">Mũ Bảo Hiểm Bảo Vệ Đầu Cho Bé </h1>
    <div class="d-flex align-items-center gap-3 mb-3">
        <div class="rating small">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
            <i class="bi bi-star-half"></i>
            <span class="ms-1 text-muted">4.5 (268)</span>
        </div>
        <span class="vr"></span>
        <span class="text-success fw-semibold"><i class="bi bi-shield-check me-1"></i>An toàn</span>
        <span class="text-success fw-semibold"><i class="bi bi-shield-check me-1"></i>Chính hãng</span>

    </div>

    <div class="d-flex align-items-end gap-3 mb-3">
        <div id="price" class="price">—</div>
        <div id="compare" class="strike d-none">—</div>
        <span id="discountBadge" class="badge text-bg-success d-none">—%</span>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Loại sản phẩm</label>
        <div class="d-flex gap-2 flex-wrap" id="variantGroup">
            @foreach ($product_list as $key => $product)
                @php
                    $name = $product['name'];
                    $slug = $product['slug'];
                    $shortName = $product['short_name'];
                    $imagePath = $product['thumbnail'];
                    $main = $product['main'];
                @endphp

                <input
                    type="radio"
                    class="btn-check"
                    name="variant"
                    id="{{ $slug }}"
                    data-variant="{{ $shortName }}"
                    data-image="{{ asset($imagePath) }}"
                    @if ($main === 1) checked @endif
                >

                <label class="btn btn-outline-brand btn-sm" for="{{ $slug }}">
                    {{ $name }}
                </label>
            @endforeach


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
        <button class="addToCartBtn btn btn-outline-brand btn-lg px-4" type="button"><i class="bi bi-cart-plus me-2"></i>Thêm vào giỏ</button>
        <button id="buyNowBtn" class="btn btn-brand btn-lg px-4" type="button"><i class="bi bi-bag-check me-2"></i>Thanh toán ngay</button>
    </div>

    <div class="row g-3 mt-4 small text-muted">
        <div class="col-md-4 d-flex align-items-center gap-2"><i class="bi bi-truck"></i> Giao nhanh 2–4 ngày</div>
        <div class="col-md-4 d-flex align-items-center gap-2"><i class="bi bi-arrow-counterclockwise"></i> Đổi trả 7 ngày</div>
        <div class="col-md-4 d-flex align-items-center gap-2"><i class="bi bi-shield-lock"></i> Thanh toán bảo mật</div>
    </div>

    {{-- Voucher Box --}}
    <div class="voucher-box mt-4">
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
                    <p class="voucher-desc mb-1">Giảm <b>15%</b> khi thanh toán chuyển khoản</p>
                    <span class="voucher-code" data-code="BANK8OFF">BANK8OFF</span>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- Sticky Buy (mobile) --}}
<div class="card-soft sticky-buy py-3 d-lg-none">
    <div class="container d-flex align-items-center justify-content-between gap-3">
        <button id="mobileBuyNowBtn" class="btn btn-brand btn " type="button">
            <i class="bi bi-bag-check me-2"></i> Xem giỏ hàng
        </button>
        <button class="addToCartBtn btn btn-brand btn text-bg-success " type="button"><i class="bi bi-cart-plus me-2"></i>Thêm </button>
        <div>
            <div id="mPrice" class="fw-bold">—</div>
            <small class="text-muted"><span id="mCompare" class="strike d-none">—</span></small>
        </div>

    </div>
</div>
