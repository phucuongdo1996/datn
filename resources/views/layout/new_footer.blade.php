<div id="footWrap">
    <footer id="footer" class="inner p0">
        <div id="footNavWrap">
            <div id="footNav">
                <ul>
                    <li class="lh1"><a href="{{ route(LEGAL) }}" target="_blank">{{ trans('attributes.new_footer.legal') }}</a></li>
                    <li class="lh1"><a href="{{ route(PRIVACY) }}" target="_blank">{{ trans('attributes.footer.policy') }}</a></li>
                    <li class="lh1"><a href="{{ route(TERMS) }}" target="_blank">{{ trans('attributes.footer.rules') }}</a></li>
                </ul>
            </div><!-- footNav -->
        </div><!-- footNavWrap -->

        <div id="copyright">
            <p>{{ trans('attributes.new_footer.copy_right') }}</p>
        </div><!--copyright-->
    </footer><!--footer-->
</div>
