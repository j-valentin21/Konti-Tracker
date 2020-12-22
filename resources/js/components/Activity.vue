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
            <tbody class="dashboard__table__body">
                <tr v-for="(act, index) in activity" :key="index"  class="dashboard__table__activity-row">
                    <td>{{act.date}}</td>
                    <td>{{act.time}}</td>
                    <td>{{act.pto_used}}</td>
                    <td>{{act.points}}</td>
                    <td class="pb-5">
                        <button class="trash btn btn-danger">
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
            <tbody class="dashboard__table__body">
                <tr  v-for="(act, index) in activity" :key="index" class="dashboard__table__activity-row">
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

        }
    },



}
</script>

<style scoped>

</style>
