<!doctype html>
<html lang="vi">
  @include('layouts.partials._head')
  <body>
    @include('layouts.partials._header')

    <main class="container my-5">
      @yield('content')
    </main>

    @include('layouts.partials._footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')
  </body>
</html>
