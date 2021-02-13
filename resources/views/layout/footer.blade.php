<footer id="footer" class="">
    <div class="container h-100">
        <div class="row h-100 justify-content-between">
            <div class="col-md-6 text-center text-md-left fw-bold">{{__('attributes.footer.copy_right')}}</div>
            <div class="row col-md-6">
                <div class="col-7 col-md-8 text-center text-md-right fw-bold fs14"><a href="{{ route(PRIVACY) }}">{{__('attributes.footer.policy')}}</a></div>
                <div class="col-5 col-md-4 text-center text-md-left fw-bold fs14 div-show-rules"><a class="show-rules-modal" href="#">{{__('attributes.footer.rules')}}</a></div>
            </div>
        </div>
    </div>
</footer>
@include('modal.policy')
@include('modal.rules')
@include('modal.edit_email')
