<div class="col-2dot4" style="padding: 10px; height: 240px">
    <div class="product-item hovereffect" style="padding: 10px">
        <div class="position-relative h-100 p50b">
            <div class="d-flex overflow-hidden" style="width: 100%; height: 110px">
                <img class="zoom-hover" style="object-fit: fill" src="{{ asset(getImageUrl($item)) }}" alt="">
                <div class="overlay d-flex justify-content-center align-items-center">
                    <div>
                        <button class="btn btn-primary fs18 sell-item" style="min-width: 100px" data-product-id="{{ $item->id }}">
                            Bán
                        </button>
                    </div>
                </div>
            </div>
            <div class="p10t font-weight-bold">{{ mb_strimwidth($item->product_name, 0, 25, '...') }}</div>
            <div class="d-flex product-hero p10t" style="bottom: 0">
                <div class="icon-hero">
                    <img class="not-zoom" src="{{ isset($item->hero_image) ? asset(URL_DOTA_HERO_IMAGES . $item->hero_image) : asset(URL_DOTA_HERO_IMAGES . 'default.png') }}" alt="">
                </div>
                <div class="centered-vertical p10l">
                    <span>{{ $item->hero_name ?? 'Tất cả tướng' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>