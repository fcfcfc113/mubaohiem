<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container py-2">
    <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ url('/') }}">
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
        <a class="btn btn-sm btn-light position-relative" href="#" id="cartBtn"
           data-bs-toggle="modal" data-bs-target="#cartModal" aria-label="Giỏ hàng">
          <i class="bi bi-cart3"></i>
          <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
        </a>
      </div>
    </div>
  </div>
</nav>
