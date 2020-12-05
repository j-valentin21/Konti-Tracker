<template>
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
                            <form method="POST">
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
                                            <label class="control-label pto_modal__label">Choose your date</label>
                                            <flat-pickr
                                                v-model="date"
                                                :config="config"
                                                class="form-control"
                                                placeholder="Select date"
                                                name="date">
                                            </flat-pickr>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="pto_modal__or">OR</label>
                                    </div>
                                    <div class='col-md-5'>
                                        <div class="form-group">
                                            <label for="date-range" class="control-label pto_modal__label">Choose your date range</label>
                                            <div class='input-group date' id='date-range'>
<!--                                                <flat-pickr-->
<!--                                                    v-model="date"-->
<!--                                                    :config="config"-->
<!--                                                    class="form-control"-->
<!--                                                    placeholder="Select date"-->
<!--                                                    name="date">-->
<!--                                                </flat-pickr>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <input type="submit" class="pto_modal__button pto_modal__button--black" value="Submit">
                                </div>
                                <div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

export default {
    data () {
        return {
            date: 'today',
            config: {
                wrap: true,
                altFormat: 'M j, Y',
                altInput: true,
                dateFormat: 'Y-m-d',
                minDate: "2020-01-01",
                disable: [
                    `${this.getYear()}-12-07`,`${this.getYear()}-01-20`, `${this.getYear()}-02-17`,`${this.getYear()}-04-10`,`${this.getYear()}-05-25`,
                    `${this.getYear()}-07-04`,`${this.getYear()}-09-07`,`${this.getYear()}-10-12`,`${this.getYear()}-12-24`,`${this.getYear()}-12-25`,
                    `${this.getYear()}-12-31`,
                    function(date) {
                        // return true to disable
                        return (date.getDay() === 0 || date.getDay() === 6)
                    },
                    {
                        from: "2020-01-01",
                        to: "today"
                    },
                    {
                        from: `${this.getYear()}-11-26`,
                        to: `${this.getYear()}-11-28`
                    },
                ],
            }
        }
    },
    methods: {
        getYear() {
            let date = new Date();
            return date.getFullYear()
        },
    },
    components: {
        flatPickr
    },
}
</script>
