<template>
    <div class="modal fade pto_modal" id="request-modal" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg pto_modal__dialog">
            <div class="modal-content pto_modal__content">
                <header class="modal-header pto_modal__header text-center">
                    <h5 class="modal-title w-100 pto_modal__title" id="staticBackdropLabel">Request PTO Day</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </header>
                <div class="modal-body pto">
                    <div class="container">
                        <failure-flash-form></failure-flash-form>
                        <!-- ========== PTO REQUEST FORM ========== -->
                        <form method="POST" @submit.prevent = 'submitPTOForm' @keydown="errors.clear($event.target.name)">
                            <div class="form-group">
                                <label for="pto-consumed" class="control-label pto_modal__label mr-3 mt-3">How much PTO days do you want to use?</label>
                                <input v-model.number="pto_days" type="number" id="pto-consumed" name="pto_days" placeholder="Days"
                                       step=".25" min="0.25" max="40" required>
                            </div>
                            <strong v-if="errors.has('pto_days')" v-text="errors.get('pto_days')" class="text-danger"></strong>

                            <div class="form-group">
                                <label for="reason_for_request" class="control-label pto_modal__label my-3">Reason for request</label>
                                <input v-model="reason_for_request" type="text" class="form-control pto_modal__input" name="reason_for_request"
                                       id="reason_for_request" maxlength="100" placeholder="Reason for request"
                                required>
                            </div>
                            <strong v-if="errors.has('reason_for_request')" v-text="errors.get('reason_for_request')" class="text-danger"></strong>

                            <div class="form-group">
                                <label class="control-label pto_modal__label my-3">Choose your date</label>
                                <flat-pickr
                                    @on-change="onChange"
                                    v-model="dates"
                                    :config="config"
                                    class="form-control pto_modal__input mb-3"
                                    placeholder="Select date"
                                    name="date">
                                </flat-pickr>
                            </div>
                            <strong v-if="errors.has('dates')" v-text="errors.get('dates')" class="text-danger"></strong>

                            <div v-if="selectDate" class="form-group">
                                <label class="control-label pto_modal__label my-3">Choose your scheduling time for each date</label>
                                <transition-group name="list">
                                    <div v-for="(date, index) in datesArray" :key="date" class="container">
                                        <div class="row">
                                            <div class="col-sm-6 mt-3 mt-sm-3 text-center text-sm-left">
                                                <time class="font-weight-bold font-italic" datetime="2020-07-07">{{date}}</time>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="start_times">Start Time</label>
                                                <flat-pickr
                                                    name="start_times"
                                                    id="start_times"
                                                    v-model="start_times[index]"
                                                    :config="configTime"
                                                    class="form-control pto_modal__input mb-3"
                                                    placeholder="Select time">
                                                </flat-pickr>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="end_times">End Time</label>
                                                <flat-pickr
                                                    name="end_times"
                                                    id="end_times"
                                                    v-model="end_times[index]"
                                                    :config="configTime"
                                                    class="form-control pto_modal__input mb-3"
                                                    placeholder="Select time">
                                                </flat-pickr>
                                            </div>

                                        </div>
                                    </div>
                                </transition-group>
                            </div>
                            <strong v-if="errors.has('start_times')" v-text="errors.get('start_times')" class="text-danger"></strong>
                            <br>
                            <strong v-if="errors.has('end_times')" v-text="errors.get('end_times')" class="text-danger"></strong>
                            <div class="text-center text-sm-right mt-3">
                                <button type="submit" class="pto_modal__button pto_modal__button--black">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import { Errors } from '../error.js'

export default {
    props:['pto'],
    created() {
        Fire.$on('SubmitCount', () => {
            this.getActualPTO();
        });
    },
    data () {
        return {
            actualPTO: this.pto,
            pto_days:'',
            reason_for_request:'',
            dates: '',
            errors: new Errors(),
            datesArray: [],
            start_times: [],
            end_times:[],
            selectDate: false,
            config: {
                wrap: true,
                altFormat: 'm/d/y',
                altInput: true,
                dateFormat: 'm/d/y',
                minDate: "2020-01-01",
                mode: 'multiple',
                disable: [
                    `${this.getYear()}-01-20`, `${this.getYear()}-02-17`,`${this.getYear()}-04-10`,`${this.getYear()}-05-25`,`${this.getYear()}-12-31`,
                    `${this.getYear()}-07-04`,`${this.getYear()}-09-07`,`${this.getYear()}-10-12`,`${this.getYear()}-12-24`,`${this.getYear()}-12-25`,
                    function(date) {
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
            },
            configTime: {
                minTime: "8:00",
                maxTime: "16:30",
                enableTime: true,
                noCalendar: true,
                dateFormat: "h:i K",
            },
        }
    },
    methods: {
        getYear() {
            let date = new Date();
            return date.getFullYear()
        },
        onChange: function(selectedDates, dateStr, instance){
            this.datesArray = dateStr.split(",");
            this.selectDate = dateStr !== '';
        },
        submitPTOForm() {
            axios.post("/dashboard", this.$data)
                .then( response => {
                    window.location.href = '/dashboard';
                })
                .catch(error => {
                    this.errors.record(error.response.data.errors)
                    Fire.$emit('Failureflash-form',{
                        message: "An issue creating your PTO request form has occurred. Please try again at a later time."
                    });
                })
        },
        getActualPTO() {
            axios.get("/dashboard/pto-char")
                .then( response => {
                   this.actualPTO = response.data[1];
                })
                .catch(error => {
                    this.errors.record(error.response.data.errors)
                })
        },
        showFalse: function() {
            this.failureCheck = false
        }
    },
    components: {
        flatPickr
    },
}
</script>

<style lang="css">
.flatpickr-months .flatpickr-prev-month svg {
    fill: white;
}

.flatpickr-current-month {
    color: orange;
    font-weight: bolder;
}

.flatpickr-months .flatpickr-month {
    background-color: black;
}

.flatpickr-months .flatpickr-next-month svg {
    fill: white;
}

.flatpickr-rContainer {
    background-color: #FFFAFA;
}

.list-enter-active,
.list-leave-active {
    transition: opacity .5s ease-in-out, transform 0.5s ease;
}

.list-enter-active {
    transistion-delay:0.5s
}

.list-enter, .list-leave-to {
    opacity: 0;
    transform: translateX(-100px);
}


.list-enter-to, .view-leave {
    opacity: 1;
    transform: translateX(0px);
}
</style>
