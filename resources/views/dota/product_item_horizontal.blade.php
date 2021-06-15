<a class="" href="{{ route(DOTA_DETAIL, $item['id']) }}">
    <div class="product-item-horizontal" style="padding: 10px;">
        <div class="d-flex position-relative h-100">
            <div class="col-4 d-flex overflow-hidden" style="width: 100%; height: 110px; background-color: black">
                <img class="zoom-hover object-fit-contain" src="{{ asset(getImageUrl($item['product'])) }}" alt="">
            </div>
            <div class="col-8 row m0 p10lr">
                <div class="col-12 p10t p10b font-weight-bold">{{ mb_strimwidth($item['product_name'], 0, 25, '...') }}</div>
                <div class="col-12 d-flex product-hero m5b">
                    <div class="icon-hero">
                        <img class="" src="{{ isset($item['hero_image']) ? asset(URL_DOTA_HERO_IMAGES . $item['hero_image']) : asset(URL_DOTA_HERO_IMAGES . 'default.png') }}" alt="">
                    </div>
                    <div class="centered-vertical p10l">
                        <span>{{ $item['hero_name'] ?? 'Tất cả tướng' }}</span>
                    </div>
                </div>
                <div class="col-12 product-price p10t p10b font-weight-bold text-center" style="height: fit-content"><i class="fas fa-coins text-gold" ></i> {{ number_format($item['price']) }}</div>
            </div>
        </div>
    </div>
</a>
