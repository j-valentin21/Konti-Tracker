<template>
    <div v-if="success_Check" class="col-sm-12">
        <div class="alert fade alert__success alert-dismissible text-left brk-library-rendered rendered show">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true" class="mb-5">
                    <svg class="alert__icon alert__icon--x">
                        <use href="svg/sprite.svg#icon-times"></use>
                    </svg>
                </span>
                <span class="sr-only">Close</span>
            </button>
            <span class="alert__start">
                <svg class="alert__icon alert__icon--check">
                    <use href="svg/sprite.svg#icon-check_circle_outline"></use>
                </svg>
            </span>
            <strong class="font__weight-semibold">Your profile has been successfully updated!</strong>.
        </div>
    </div>
</template>

<script>

export default {
    name: "SuccessFlash",
    props : ['success'],
    data() {
        return {
            success_Check: this.success,
        }
    },
}
</script>

<style scoped>

</style>
