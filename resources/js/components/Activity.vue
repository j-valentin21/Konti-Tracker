<template>
    <form method="POST">
        <table class="table dashboard__table pr-3">
            <thead class="dashboard__table__head dashboard__table__head--black">
                <tr class="dashboard__table__activity-row">
                    <th>Date</th>
                    <th>Time</th>
                    <th>PTO Used</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody class="dashboard__table__body">
                <tr class="dashboard__table__activity-row">
                    <td>12/20/20</td>
                    <td>8:32AM</td>
                    <td>3</td>
                    <td>1</td>
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
                <tr class="dashboard__table__activity-row">
                    <td>3</td>
                    <td>COVID</td>
                    <td >John Smith </td>
                    <td class="badge">Approved</td>
                </tr>
            </tbody>
        </table>
    </form>
</template>

<script>
export default {

}
</script>

<style scoped>

</style>
