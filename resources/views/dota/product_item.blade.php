<a class="col-2dot4" style="padding: 10px; min-height: 280px" href="{{ route(DOTA_DETAIL, $item['id']) }}">
    <div class="product-item" style="padding: 10px">
        <div class="position-relative h-100 p100b">
            <div class="d-flex overflow-hidden" style="width: 100%; height: 110px">
                <img class="zoom-hover" style="object-fit: fill" src="{{ asset(getImageUrl($item['product'])) }}" alt="">
            </div>
            <div class="p10t font-weight-bold">{{ mb_strimwidth($item['product_name'], 0, 25, '...') }}</div>
            <div class="d-flex product-hero p10t">
                <div class="icon-hero">
                    <img class="" src="{{ isset($item['hero_image']) ? asset(URL_DOTA_HERO_IMAGES . $item['hero_image']) : asset(URL_DOTA_HERO_IMAGES . 'default.png') }}" alt="">
                </div>
                <div class="centered-vertical p10l">
                    <span>{{ $item['hero_name'] ?? 'Tất cả tướng' }}</span>
                </div>
            </div>
            <div class="product-price p10t p10b font-weight-bold text-center"><i class="fas fa-coins text-gold" ></i> {{ number_format($item['price']) }}</div>
        </div>
    </div>
</a>