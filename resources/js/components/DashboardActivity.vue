<template>
    <div class="table-responsive">
        <table class="table table-centered">
            <thead class="border-top border-white">
                <tr class="dashboard__card__title">
                    <th>Date</th>
                    <th>Time</th>
                    <th>PTO</th>
                    <th>Points</th>
                    <th>Pending</th>
                    <th>Dates Requested</th>
                    <th>Reason for Request</th>
                    <th>Supervisor name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="dashboard__card__text" name="fade" is="transition-group">
                <tr v-for="act in activities.data" :key="act.id">
                    <td>{{act.date}}</td>
                    <td class="dashboard__card__text">{{act.time}}</td>
                    <td>{{act.pto_used}}</td>
                    <td>{{act.points}}</td>
                    <td>{{act.pending}}</td>
                    <td>{{act.dates_requested}}</td>
                    <td>{{act.reason_for_request}}</td>
                    <td>{{act.supervisor_name}}</td>
                    <td>{{act.status}}</td>
                </tr>
            </tbody>
        </table>
    <!--========== PAGINATION ==========-->
        <div class="mb-3">
            <ul class="pagination pagination-rounded justify-content-center mb-0 overflow-hidden">
                <pagination :limit= 2 :data="activities" @pagination-change-page="getResults">
                    <span slot="prev-nav">&lt; Previous</span>
                    <span slot="next-nav">Next &gt;</span>
                </pagination>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            activities: {},
        }
    },
    created() {
        Fire.$on('SubmitCount', () => {
            return new Promise(function(resolve, reject) {
            setTimeout(resolve, 3000);
                }).then( response => {
                    this.getResults();
                });
        });
    },
    mounted() {
        this.getResults();
    },
    methods: {
        getResults(page = 1) {
        axios.get('/dashboard/get-activity?page=' + page)
            .then(response => {
                this.activities = response.data;
            })
            .catch((err) => {
                Fire.$emit('Failureflash',{
                    message: "An issue retrieving your activities has occurred. Please try again another time."
                });
            });
        }
    }
}
</script>
<style lang="css">
.page-item {
    margin: 0 3px;
    border: none;
    text-decoration: none;
}

.page-link {
    position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #7e8396;
    font-weight: bolder;
    background-color: #273344;
    border: 1px solid darkslategray;
    text-decoration: none;
}

.page-link:hover {
    text-decoration: none;
    color: #212529;
    background-color: orange;
    border-color: black;
}

.page-item.active .page-link {
    z-index: 3;
    color: #212529;
    background-color: orange;
    border-color: black;
}

.fade-enter-active {
    animation: flipInX 1s;
    backface-visibility: visible !important;
}

.fade-enter, .fade-leave-to {
    position: absolute;
    opacity: 0;
}
</style>
