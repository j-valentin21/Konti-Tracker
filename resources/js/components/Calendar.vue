<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form @submit.prevent>
                    <div class="form-group">
                        <label for="event_name">Event Name</label>
                        <input type="text" id="event_name" class="form-control" v-model="newEvent.event_name">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input
                                    type="date"
                                    id="start_date"
                                    class="form-control"
                                    v-model="newEvent.start_date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" id="end_date" class="form-control" v-model="newEvent.end_date">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4" v-if="addingMode">
                            <button class="btn btn-sm btn-primary" @click="addNewEvent">Save Event</button>
                        </div>
                        <template v-else>
                            <div class="col-md-6 mb-4">
                                <button class="btn btn-sm btn-success" @click="updateEvent">Update</button>
                                <button class="btn btn-sm btn-danger" @click="deleteEvent">Delete</button>
                                <button class="btn btn-sm btn-secondary" @click="addingMode = !addingMode">Cancel</button>
                            </div>
                        </template>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <Fullcalendar :options="calendarOptions"/>
            </div>
        </div>
    </div>
</template>

<script>
import Fullcalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import moment from 'moment'

export default {
    props: ['calendar'],
    name: 'Calendar',
    components: {
        Fullcalendar
    },
    data() {
        return {
            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                events: this.getEvents(),
                dateClick: this.handleDateClick,
                eventClick: this.eventClick,
            },
            newEvent: {
                event_name: "",
                start_date: "",
                end_date: ""
            },
            addingMode: true,
            indexToUpdate: ""
        };
    },
    methods: {
        addNewEvent() {
            axios
                .post("/dashboard/calendar", {
                    ...this.newEvent
                })
                .then(data => {
                    this.getEvents(); // update our list of events
                    this.resetForm(); // clear newEvent properties (e.g. title, start_date and end_date)
                })
                .catch(err =>
                    console.log("Unable to add new event!", err.response.data)
                );
        },
        handleDateClick: function(info) {
            this.addingMode = false;
        },
        eventClick: function(info) {
            this.addingMode = false;
            let startDate = moment(info.event.start).format("YYYY-MM-DD");
            let endDate = moment(info.event.end).format("YYYY-MM-DD");

            this.indexToUpdate = info.event.id;
            this.newEvent = {
                event_name: info.event.title,
                start_date: startDate,
                end_date: endDate
            };
            },
        updateEvent() {
            axios
                .put("/dashboard/calendar/" + this.indexToUpdate, {
                    ...this.newEvent
                })
                .then(resp => {
                    this.resetForm();
                    this.getEvents();
                    this.addingMode = !this.addingMode;
                })
                .catch(err =>
                    console.log("Unable to update event!", err.response.data)
                );
        },
        deleteEvent() {
            axios
                .delete("/dashboard/calendar/" + this.indexToUpdate)
                .then(resp => {
                    this.resetForm();
                    this.getEvents();
                    this.addingMode = !this.addingMode;
                })
                .catch(err =>
                    console.log("Unable to delete event!", err.response.data)
                );
        },
        getEvents() {
            return this.calendar;
        },
        resetForm() {
            Object.keys(this.newEvent).forEach(key => {
                return (this.newEvent[key] = "");
            });
        }
    },
    watch: {
        indexToUpdate() {
            return this.indexToUpdate;
        }
    }
}

</script>

<style lang="scss" scoped>

</style>
