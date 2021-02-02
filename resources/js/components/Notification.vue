<template>
    <div>
        <vue-confirm-dialog></vue-confirm-dialog>
        <failure-flash></failure-flash>
        <table class="table dashboard__table pr-3">
            <thead class="dashboard__table__head dashboard__table__head--black">
            <tr class="dashboard__table__activity-row">
                <th>Supervisor Name</th>
                <th>Message</th>
                <th>Time</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody class="dashboard__table__body" name="notification" is="transition-group">
            <tr v-for="(notification, index) in notifications.data" :key="notification.id" class="dashboard__table__activity-row">
                <td>{{ notification.data['name']}}</td>
                <td>{{ notification.data['message'] }}</td>
                <td class="badge" >{{ formatDate(notification.created_at) }} </td>
                <td class="pb-5">
                    <button type="button" @click="deleteNotification(notification.id)" class="trash btn">
                        <span class="trash__lid rotate "></span>
                        <span class="trash__can"></span>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="mb-3">
            <ul class="pagination pagination-rounded justify-content-center mb-0 overflow-hidden">
                <pagination :limit= 2 :data="notifications" @pagination-change-page="getResults"></pagination>
            </ul>
        </div>

        <div class="text-center">
            <button type="button" @click="deleteAllNotifications(userId)" class="form__wizard__btn form__wizard__btn--red mt-4">Delete All</button>
        </div>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    props:['user_id'],
    data () {
        return {
            notifications: {},
            userId: this.user_id
        }
    },
    mounted() {
        this.getResults();
    },
    methods: {
        deleteNotification(id) {
            const url = '/dashboard/notifications/' + id
            axios.delete(url).then((response) => {
                this.notifications = response.data.results
            })
                .catch((err) => {
                    console.log(err)
                });
        },
        deleteAllNotifications(id) {
            const url = '/dashboard/notifications/' + id
            this.$confirm(
                {
                    message: `Are you sure you want to delete all your notifications?`,
                    button: {
                        no: 'No',
                        yes: 'Yes'
                    },
                    callback: confirm => {
                        if (confirm) {
                            axios.delete(url, {
                                params: {
                                    deleteAll: true
                                }
                            }).then((response) => {
                                this.notifications = response.data.results
                            })
                            .catch((err) => {
                                Fire.$emit('Failureflash',{
                                    message: "An issue deleting all your notifications has occurred. Please try again at a later time."
                                });
                            });
                        }
                    }
                }
            )
        },
        getResults(page = 1) {
            axios.get('/dashboard/get-notifications?page=' + page)

             .then(response => {
                this.notifications = response.data;
            });
        },
        formatDate(date) {
           return moment(date).fromNow()
        }
    },
}
</script>

<style lang="css">
@media (hover: none) {
    a:hover { color: inherit; }
}

.notification-enter-active {
    animation: fadeIn 1.25s;
    backface-visibility: visible !important;
}

.notification-enter, .notification-leave-to {
    position: absolute;
    opacity: 0;
}

</style>
