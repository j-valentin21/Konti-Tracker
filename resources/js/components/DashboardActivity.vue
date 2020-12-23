<template>
    <div class="table-responsive">
        <table class="table table-centered">
            <thead>
            <tr class="dashboard__card__title">
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">PTO Used</th>
                <th scope="col">Points</th>
                <th scope="col">Pending</th>
                <th scope="col">Reason for Request</th>
                <th scope="col">Supervisor name</th>
                <th scope="col" colspan="2">Status</th>
            </tr>
            </thead>
            <tbody class="dashboard__card__text">
            <tr v-for="(act, index) in activities" :key="act.id">
                <td>{{act.date}}</td>
                <td class="dashboard__card__text">{{act.time}}</td>
                <td>{{act.pto_used}}</td>
                <td>{{act.points}}</td>
                <td>{{act.pending}}</td>
                <td>{{act.reason_for_request}}</td>
                <td>{{act.supervisor_name}}</td>
                <td class="badge">{{act.status}}</td>
            </tr>
            </tbody>
        </table>
        <!-- ========== PAGINATION ========== -->
        <div class="mb-3">
            <ul class="pagination pagination-rounded justify-content-center mb-0">
                <li class="pagination__item">
                    <a class="pagination__link" href="#">Previous</a>
                </li>
                <li class="pagination__item"><a class="pagination__link" href="#">1</a></li>
                <li class="pagination__item active"><a class="pagination__link" href="#">2</a></li>
                <li class="pagination__item"><a class="pagination__link" href="#">3</a></li>
                <li class="pagination__item"><a class="pagination__link" href="#">Next</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props:['activity'],
    data () {
        return {
            activities:this.activity
        }
    },
}
</script>

<style scoped>

</style>
