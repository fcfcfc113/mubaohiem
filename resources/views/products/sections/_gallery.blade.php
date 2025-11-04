<div class="card-soft p-3 p-sm-4" style="height: 100%;">
    <div class="ratio ratio-1x1 mb-3">
        @php
            $mainImage = '';
            foreach ($product_list as $product) {
                if ($product['main'] === 1) {
                    $mainImage = asset($product['thumbnail']);
                    break;
                }
            }
        @endphp
        <img id="main-image" class="w-100 h-100 object-fit-cover rounded-3" src="{{ $mainImage }}" alt="Ảnh sản phẩm" />
    </div>

    <div class="row g-3" id="thumbRow">
        @foreach ($product_list as $key => $product)
            @php
                $name = $product['name'];
                $slug = $product['slug'];
                $shortName = $product['short_name'];
                $imagePath = $product['thumbnail'];
            @endphp

            <div class="col-3">
                <img
                    class="thumb w-100 @if ($product['main'] === 1) active @endif"
                    src="{{ asset($imagePath) }}"
                    data-big="{{ asset($imagePath) }}"
                    data-variant="{{ $shortName }}"
                    alt="{{ $name }}"
                >
            </div>
        @endforeach
    </div>
</div>
