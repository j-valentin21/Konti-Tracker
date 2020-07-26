 <!-- MODAL -->
 <div id="app">
    <section class="modal" id="exampleModalCentered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header modal__header">
                    <h5 class="modal-title" id="exampleModalCenteredLabel">Sign In</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div  class="modal-body modal__body">
                    @csrf

                   <login-form></login-form>

                </div>
            </div>
        </div>
    </section>
</div>

