<template>
    <div class="modal fade pto_modal" id="request-modal" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg pto_modal__dialog">
            <div class="modal-content pto_modal__content">
                <div class="modal-header pto_modal__header text-center">
                    <h5 class="modal-title w-100 pto_modal__title" id="staticBackdropLabel">Request PTO Day</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body pto">
                    <div class="container">
                        <form method="POST" @submit.prevent = 'submitPTOForm' @keydown="errors.clear($event.target.name)">
                            <div class="form-group">
                                <label for="pto-consumed" class="control-label pto_modal__label mr-3 mt-3">How much PTO days do you want to use?</label>
                                <input v-model.number="ptoDays" type="number" id="pto-consumed" name="pto-consumed" placeholder="Days"
                                       step=".25" min="0.25" max="40" required>
                            </div>
                            <strong v-if="errors.has('ptoDays')" v-text="errors.get('ptoDays')" class="text-danger"></strong>

                            <div class="form-group">
                                <label for="reason" class="control-label pto_modal__label my-3">Reason for request</label>
                                <input v-model="reason" type="text" class="form-control pto_modal__input" name="reason" id="reason" maxlength="100" placeholder="Reason for request"
                                required>
                            </div>
                            <strong v-if="errors.has('reason')" v-text="errors.get('reason')" class="text-danger"></strong>

                            <div class="form-group">
                                <label class="control-label pto_modal__label my-3">Choose your date</label>
                                <flat-pickr
                                    @on-change="onChange"
                                    v-model="date"
                                    :config="config"
                                    class="form-control pto_modal__input mb-3"
                                    placeholder="Select date"
                                    name="date">
                                </flat-pickr>
                            </div>
                            <strong v-if="errors.has('date')" v-text="errors.get('date')" class="text-danger"></strong>

                            <div v-if="selectDate" class="form-group">
                                <label class="control-label pto_modal__label my-3">Choose your scheduling time for each date</label>
                                <transition-group name="list">
                                    <div v-for="(date, index) in datesArray" :key="date" class="container">
                                        <div class="row">
                                            <div class="col-sm-6 mt-3 mt-sm-3 text-center text-sm-left">
                                                <time class="font-weight-bold font-italic" datetime="2020-07-07">{{date}}</time>
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="start-time">Start Time</label>
                                                <flat-pickr
                                                    name="startTime"
                                                    id="start-time"
                                                    v-model="startTime[index]"
                                                    :config="configTime"
                                                    class="form-control pto_modal__input mb-3"
                                                    placeholder="Select time">
                                                </flat-pickr>
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="start-time">End Time</label>
                                                <flat-pickr
                                                    name="endTime"
                                                    id="end-time"
                                                    v-model="endTime[index]"
                                                    :config="configTime"
                                                    class="form-control pto_modal__input mb-3"
                                                    placeholder="Select time">
                                                </flat-pickr>
                                            </div>

                                        </div>
                                    </div>
                                </transition-group>
                            </div>
                            <strong v-if="errors.has('startTime')" v-text="errors.get('startTime')" class="text-danger"></strong>
                            <br>
                            <strong v-if="errors.has('endTime')" v-text="errors.get('endTime')" class="text-danger"></strong>

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
/**
 * Keeps track of all of laravel's validation errors that come from axios.
 */
class Errors {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    constructor() {
        this.errors = {};
    }
    /**
     * Checks to see if this.errors has a 'field' property.
     *
     * @return boolean
     */
    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    /**
     * Get error(field) name to display correct error.
     *
     * @return object
     */
    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }

    /**
     * Get error from axios and store it.
     *
     * @return void
     */
    record(errors) {
        this.errors = errors;
    }
    /**
     * Delete error message on keydown.
     *
     * @return void
     */
    clear(field) {
        delete this.errors[field];
    }

}
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

export default {
    data () {
        return {
            ptoDays:'',
            reason:'',
            date: '',
            errors: new Errors(),
            datesArray: [],
            startTime: [],
            endTime:[],
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
                .catch(error => this.errors.record(error.response.data.errors))
        },
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
