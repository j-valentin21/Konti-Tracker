<template>
    <form method="POST">
        <table class="table dashboard__table pr-3">
            <thead class="dashboard__table__head dashboard__table__head--black">
                <tr class="dashboard__table__activity-row">
                    <th>Date</th>
                    <th>Time</th>
                    <th>PTO Used</th>
                    <th>Points</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class="dashboard__table__body" name="activity" is="transition-group">
                <tr v-for="(act, index) in activities" :key="act.id"  class="dashboard__table__activity-row">
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
                <tr v-for="(act, index) in activities" :key="act.id" class="dashboard__table__activity-row">
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
props:['activity'],
    data () {
        return {
            activities:this.activity
        }
    },
    methods: {
        deleteActivity(id) {
            const url = '/dashboard/activity/' + id
            axios.delete(url).then((response) => {
                this.activities = response.data.results
            })
            .catch((err) => {
                console.log(err)
            });
        },
    }
}
</script>

<style lang="css">
.activity-enter-active {
    animation: add-item 1s;
}

.activity-leave-active {
    animation: add-item 1s reverse;
    transition: transform 1s;
}

@keyframes add-item {
    0% {
        opacity: 0;
        transform: translateX(150px);
    }
    50% {
        opacity: 0.5;
        transform: translateX(-10px) skewX(20deg);
    }
    100% {
        opacity: 1;
        transform: translateX(0px);
    }
}
</style>
