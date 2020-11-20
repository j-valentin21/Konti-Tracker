<template>
    <div v-if="failure_Check" class="col-sm-12">
        <div class="alert fade alert__danger alert-dismissible text-left brk-library-rendered rendered show">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true" class="mb-5">
                    <svg class="alert__icon alert__icon--x_red">
                        <use href="http://127.0.0.1:8000/svg/sprite.svg#icon-times"></use>
                    </svg>
                </span>
                <span class="sr-only">Close</span>
            </button>
            <span class="alert__start">
                <svg class="alert__icon alert__icon--danger">
                    <use href="http://127.0.0.1:8000/svg/sprite.svg#icon-dangerous"></use>
                </svg>
            </span>
            <slot><strong class="font__weight-semibold">Please try again at a later time.</strong>.</slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "FailureFlash",
    props : ['failure'],
    data() {
        return {
            failure_Check: this.failure,
        }
    },
}
</script>

<style scoped>

</style>
