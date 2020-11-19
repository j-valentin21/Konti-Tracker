<template>
    <div class="row justify-content-center">
        <div class="col-12 mb-5">
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
        addNewEvent() {
            axios
                .post("/dashboard/calendar", {
                    ...this.newEvent
                })
                .then(data => {
                    this.resetForm();
                    this.componentKey++;
                })
                .catch(err =>
                    console.log("Unable to add new event!", err.response.data)
                );
        },
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
            if (!confirm("Are you sure about this change?")) {
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
        updateEvent() {
        axios
            .put("/dashboard/calendar/" + this.indexToUpdate, {
                ...this.newEvent
            })
            .then(resp => {
                this.resetForm();
                this.addingMode = !this.addingMode;
                this.componentKey++;
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
                this.addingMode = !this.addingMode;
                this.componentKey++;
            })
            .catch(err =>
                console.log("Unable to delete event!", err.response.data)
            );
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
    },
    watch: {
        indexToUpdate() {
            return this.indexToUpdate;
        }
    }
}
</script>

<style lang="css" >
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
