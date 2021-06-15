<div class="col-2dot4" style="padding: 10px; height: 280px">
    <div class="product-item hovereffect" style="padding: 10px">
        <div class="position-relative h-100 p50b">
            <div class="d-flex overflow-hidden" style="width: 100%; height: 110px">
                <img class="zoom-hover" style="object-fit: fill" src="{{ asset(getImageUrl($item->product)) }}" alt="">
                <div class="overlay d-flex justify-content-center align-items-center">
                    <div>
                        <button class="btn btn-primary fs18 withdraw-item" style="min-width: 100px" data-market-id="{{ $item->id }}" data-product-image="{{ asset(getImageUrl($item->product)) }}"
                                data-product-name="{{ $item->product_name }}" data-product-special="{{ $item->product->special }}" data-hero-name="{{ $item->hero_name ?? 'Tất cả tướng' }}" data-product-price="{{ number_format($item->price) }}">
                            Thu hồi
                        </button>
                    </div>
                </div>
            </div>
            <div class="p10t font-weight-bold" style="color: {{ SPECIAL_COLOR[$item->product->special] }}">{{ mb_strimwidth($item->product_name, 0, 25, '...') }}</div>
            <div class="d-flex product-hero p10t">
                <div class="icon-hero">
                    <img class="not-zoom" src="{{ isset($item->hero_image) ? asset(URL_DOTA_HERO_IMAGES . $item->hero_image) : asset(URL_DOTA_HERO_IMAGES . 'default.png') }}" alt="">
                </div>
                <div class="centered-vertical p10l">
                    <span>{{ $item->hero_name ?? 'Tất cả tướng' }}</span>
                </div>
            </div>
            <div class="product-price p10t p10b font-weight-bold text-center"><i class="fas fa-coins text-gold" ></i> {{ number_format($item->price) }}</div>
        </div>
    </div>
</div>