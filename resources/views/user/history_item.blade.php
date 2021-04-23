@switch($data->type)
    @case(USER_HISTORY_BUY_ITEM)
    <div class="row m0 p15 justify-content-between border-bottom" style="height: 70px">
        <div>
            <div class="fs16 m10b">
                <span class="font-weight-bold text-blue">Bạn</span> đã mua <span class="font-weight-bold">{{ $data->product_name }}</span> từ <span class="font-weight-bold" style="color: #009fff">{{ $data->partner_name }}</span> với giá <span class="font-weight-bold">{{ number_format($data->purchase_money) }}</span>.
            </div>
            <div class="fs14">
                {{ date('h:i d/m/Y', strtotime($data->created_at)) }}
            </div>
        </div>
        <div class="fs18" style="color: red">
            - {{ number_format($data->purchase_money) }}
        </div>
    </div>
    @break
    @case(USER_HISTORY_SELL_ITEM)
    <div class="row m0 p15 justify-content-between border-bottom" style="height: 70px">
        <div>
            <div class="fs16 m10b">
                <span class="font-weight-bold" style="color: #009fff">{{ $data->partner_name }}</span> đã mua <span class="font-weight-bold">{{ $data->product_name }}</span> với giá <span class="font-weight-bold">{{ number_format($data->purchase_money) }}</span>.
            </div>
            <div class="fs14">
                {{ date('h:i d/m/Y', strtotime($data->created_at)) }}
            </div>
        </div>
        <div class="fs18" style="color: green">
            + {{ number_format($data->purchase_money) }}
        </div>
    </div>
    @break
@endswitch