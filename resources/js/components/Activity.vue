<template>
    <form method="POST">
        <table class="table dashboard__table pr-3">
            <thead class="dashboard__table__head dashboard__table__head--black">
                <tr class="dashboard__table__activity-row">
                    <th>Date</th>
                    <th>Time</th>
                    <th>PTO</th>
                    <th>Points</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class="dashboard__table__body" name="activity" is="transition-group">
                <tr v-for="(act, index) in activities.data" :key="act.id"  class="dashboard__table__activity-row">
                    <td>{{act.date}}</td>
                    <td>{{act.time}}</td>
                    <td>{{act.pto_used}}</td>
                    <td>{{act.points}}</td>
                    <td class="pb-5">
                        <button type="button" @click="deleteActivity(act.id)" class="trash btn btn-danger">
                            <span class="trash__lid rotate "></span>
                            <span class="trash__can"></span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="mb-3">
            <ul class="pagination pagination-rounded justify-content-center mb-0">
                <pagination :data="activities" @pagination-change-page="getResults">
                    <span slot="prev-nav">&lt; Previous</span>
                    <span slot="next-nav">Next &gt;</span>
                </pagination>
            </ul>
        </div>

        <table class="table dashboard__table pr-3">
            <thead class="dashboard__table__head dashboard__table__head--black">
            <tr class="dashboard__table__activity-row">
                <th>Pending</th>
                <th>Reason For Request</th>
                <th>Supervisor Name</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody class="dashboard__table__body" name="activity" is="transition-group">
                <tr v-for="(act, index) in activities.data" :key="act.id" class="dashboard__table__activity-row">
                    <td>{{act.pending}}</td>
                    <td>{{act.reason_for_request}}</td>
                    <td >{{act.supervisor_name}} </td>
                    <td class="badge">{{act.status}}</td>
                </tr>
            </tbody>
        </table>
    </form>
</template>

<script>
export default {
    data () {
        return {
            activities: {},
        }
    },
    mounted() {
        this.getResults();
    },
    methods: {
        deleteActivity(id) {
            const url = '/dashboard/activity/' + id
            axios.delete(url).then((response) => {
                this.activities = response.data.results
                console.log(response.data);
            })
            .catch((err) => {
                console.log(err)
            });
        },
        getResults(page = 1) {
            axios.get('/dashboard/get-activity?page=' + page, {
                params: {
                    activity: 10
                }
            }) .then(response => {
                this.activities = response.data;
            });
        }
    },
}
</script>

<style lang="css">

.activity-enter-active {
    animation: flipInX 1s;
    backface-visibility: visible !important;
}

.activity-enter, .activity-leave-to {
    position: absolute;
    opacity: 0;
}
</style>
