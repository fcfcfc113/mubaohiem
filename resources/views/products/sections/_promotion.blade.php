<div class="hero-media" id="heroSlider">
  <div class="slider-stage">
    @foreach ( $banners as $banner )
      <img src="{{ asset( 'public/'.$banner['image'] ) }}" alt="Hero {{ $banner['id'] }}" loading="lazy" >
    @endforeach
  </div>

  <button class="slider-btn slider-prev text-dark" aria-label="Prev"><i class="bi bi-chevron-left"></i></button>
  <button class="slider-btn slider-next text-dark" aria-label="Next"><i class="bi bi-chevron-right"></i></button>

  <div class="slider-dots" aria-label="Slide indicators"></div>
</div>
