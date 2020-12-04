<div class="modal fade pto_modal" id="request-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content pto_modal__content">
            <div class="modal-header pto_modal__header text-center">
                <h5 class="modal-title w-100 pto_modal__title" id="staticBackdropLabel">Request PTO Day</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body pto">
                <div class="container">
                    <div class="">
                        <form method="GET" action="{{ route('dashboard.index') }}">
                            <div class="form-group">
                                <label for="pto-consumed" class="control-label pto_modal__label mr-3">How much PTO days do you want to use?</label>
                                <input type="number" id="pto-consumed" name="pto-consumed" step=".25" min="0.25" max="40">
                            </div>
                            <div class="form-group">
                                <label for="reason" class="control-label pto_modal__label">Reason for request</label>
                                <input type="text" class="form-control" name="reason" id="reason">
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="date" class="control-label pto_modal__label">Choose your date</label>
                                        <input type="date" class="form-control" name="date" id="date">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="pto_modal__or">OR</label>
                                </div>
                                <div class='col-md-5'>
                                    <div class="form-group">
                                        <label for="date-range" class="control-label pto_modal__label">Choose your date range</label>
                                        <div class='input-group date' id='date-range'>
                                            <input type='date' class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-3">
                                <input type="submit" class="pto_modal__button pto_modal__button--black" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
