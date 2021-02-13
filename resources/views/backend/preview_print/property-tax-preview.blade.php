<div>
    <div class="row">
        @foreach($data as $item)
            @if($loop->index == 0)
                <div class="col-4">
            @elseif(($loop->index) % 5 == 0)
                </div>
                <div class="col-4">
            @endif
            <div>{{ $item->house_name }}</div>
        @endforeach
            </div>
    </div>
</div>
