<div class="modal modal-simulation" id="modal-save-success">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-unhead">
            <div class="modal-body modal-body-unhead">
                <button type="button" class="close btn-close-modal-simulation" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="contain-modal">
                    <div class="contain-modal-body text-center">
                        <span class="fs18">{{__('attributes.home.modal.success') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal zoom-chart bg-white overflow-auto" id="zoom-chart">
    <button type="button" class="close fs36 btn-close-modal-zoom m8r" id="btn-close-modal-preview" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="container content-zoom-chart">
        <div id="zoom-chart-simulation"></div>
        <p class="highcharts-description fs11 highcharts-note" style="display: none">
            {{ __('attributes.simulation_charts.note_1') }}<br/>
            {{ __('attributes.simulation_charts.note_2') }}
        </p>
    </div>
</div>
