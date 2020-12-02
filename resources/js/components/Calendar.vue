<template>
    <div class="row justify-content-center">
        <success-flash v-if="success" :success="success">
            <strong class="font__weight-semibold pr-3">{{message}}</strong>
        </success-flash>
        <failure-flash v-if="failure" :failure="failure">
            <strong class="font__weight-semibold pr-3 ml-2">{{message}}</strong>
        </failure-flash>
        <div class="col-12 mb-5">
            <form @submit.prevent>
                <div class="form-group">
                    <label for="event_name">Event Name</label>
                    <input type="text" id="event_name" class="form-control" v-model="newEvent.event_name" required>
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
                            <button class="btn btn-sm btn-secondary" @click="cancelForm">Cancel</button>
                        </div>
                    </template>
                </div>
            </form>
        </div>
        <div class="col-12">
            <Fullcalendar :key="componentKey"  :options="calendarOptions"/>
        </div>
    </div>
</template>

<script>

import Fullcalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

export default {
    props:['componentKey'],
    name: 'Calendar',
    components: {
        Fullcalendar
    },
    data() {
        return {
            success: false,
            failure: false,
            message: "",
            calendarEvents: [],
            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                eventClick: this.eventClick,
                editable: true,
                eventDrop: this.eventDrop,
                eventDragStart: this.eventDragStart,
                selectable:true,
                select: this.selectionClick,
                selectMinDistance: 20,
                eventBackgroundColor: '#eba72b',
                eventBorderColor: 'black',
                eventTextColor: 'black',
                events: [
                    {
                        title  : "New Year's Day",
                        start  : `${this.getYear()}-01-05`,
                    },
                    {
                        title  : 'MLK Day',
                        start  : `${this.getYear()}-01-20`,
                    },
                    {
                        title  : "President's Day",
                        start  : `${this.getYear()}-02-17`,
                    },
                    {
                        title  : "Good Friday",
                        start  : `${this.getYear()}-04-10`,
                    },
                    {
                        title  : "Memorial Day",
                        start  : `${this.getYear()}-05-25`,
                    },
                    {
                        title  : "Independence Day",
                        start  : `${this.getYear()}-07-04`,
                    },
                    {
                        title  : "Labor Day",
                        start  : `${this.getYear()}-09-07`,
                    },
                    {
                        title  : "Columbus Day",
                        start  : `${this.getYear()}-10-12`,
                    },
                    {
                        title  : "Thanksgiving Day",
                        start  : `${this.getYear()}-11-26`,
                        end    : `${this.getYear()}-11-28`,
                    },
                    {
                        title  : "Christmas Eve",
                        start  : `${this.getYear()}-12-24`,
                    },
                    {
                        title  : "Christmas Day",
                        start  : `${this.getYear()}-12-25`,
                    },
                    {
                        title  : "New Year's Eve",
                        start  : `${this.getYear()}-12-31`,
                    },
                ],
                eventSources: [
                    {
                        events(start, callback) {
                            axios.get('http://127.0.0.1:8000/dashboard/calendar/events/').then(response => {
                                callback(response.data.resource)
                            })
                        }
                    }
                ],
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
        eventClick: function(info) {
            this.addingMode = false;
            let startDate = info.event.startStr;
            let endDate = info.event.endStr;
            if (endDate === '') {
                endDate = startDate
            }
            this.indexToUpdate = info.event.id;

            this.newEvent = {
                event_name: info.event.title,
                start_date: startDate,
                end_date: endDate
            };
        },
        eventDrop: function(info) {
            if (!confirm(`Are you sure you want to move ${info.event.title} to date ${info.event.startStr}`)) {
                info.revert();
            } else {
                let startDate = info.event.startStr;
                let endDate = info.event.endStr;
                if (endDate === '') {
                    endDate = startDate
                }
                this.indexToUpdate = info.event.id;

                this.newEvent = {
                    event_name: info.event.title,
                    start_date: startDate,
                    end_date: endDate
                };
                this.updateEvent();
                this.addingMode = false;
            }
        },
        selectionClick: function(selectionInfo ) {
            this.addingMode = true
            let startDate = selectionInfo.startStr;
            let endDate = selectionInfo.endStr;
            if (endDate === '') {
                endDate = startDate
            }
            this.indexToUpdate = selectionInfo.id;

            this.newEvent = {
                start_date: startDate,
                end_date: endDate
            };
        },
        addNewEvent() {
            axios
                .post("/dashboard/calendar", {
                    ...this.newEvent
                })
                .then(resp => {
                    this.resetForm();
                    this.componentKey++;
                    this.message = resp.data.message;
                    this.success = true;
                })
                .catch(err => {
                    this.message = "Unable to add new event. Please try again at a later time."
                    this.failure = true;
                });

        },
        updateEvent() {
        axios
            .put("/dashboard/calendar/" + this.indexToUpdate, {
                ...this.newEvent
            })
            .then(resp => {
                this.resetForm();
                this.addingMode = !this.addingMode;
                this.componentKey++;
                this.message = resp.data.message;
                this.success = true;
            })
            .catch(err => {
                this.message = "Unable to update event. Please try again at a later time."
                this.failure = true
            });
        },
        deleteEvent() {
        axios
            .delete("/dashboard/calendar/" + this.indexToUpdate)
            .then(resp => {
                this.resetForm();
                this.addingMode = !this.addingMode;
                this.componentKey++;
                this.message = resp.data.message;
                this.success = true;
            })
            .catch(err => {
                this.message = "Unable to delete event. Please try again at a later time."
                this.failure = true
            });
        },
        resetForm() {
            Object.keys(this.newEvent).forEach(key => {
                return (this.newEvent[key] = "");
            });
        },
        cancelForm() {
            this.resetForm();
            this.addingMode = !this.addingMode;
        },
        getYear() {
            let date = new Date();
            return date.getFullYear()
        },
    },

    watch: {
        indexToUpdate() {
            return this.indexToUpdate;
        }
    }
}
</script>

<style lang="css">
.fc .fc-toolbar-title {
    font-size: 2rem;
    margin: 0;
    color: black
}

.fc .fc-scroller-liquid-absolute {
    background-color: white;
}

.fc-col-header-cell {
    background-color: #212529;
    color: white;
}

.fc-event-title-container {
    font-size: 1rem;
    font-weight: 600;
}

.fc .fc-daygrid-day-frame:hover {
    border: 3px solid grey;
}

.fc .fc-daygrid-day-frame:active {
    background-color: lightgrey;
}

.fc-scrollgrid-sync-inner {
    border: 1px solid lightgrey;
}
</style>
