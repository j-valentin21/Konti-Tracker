<template>
    <div v-if="failure_Check" class="col-sm-12">
        <div class="alert fade alert__danger alert-dismissible text-left brk-library-rendered rendered show">
            <button type="button" class="close" data-dismiss="alert" @click="showFalse">
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
            <slot><strong class="alert__message">Please try again at a later time.....</strong></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "FailureFlash",
    data() {
        return {
            failure_Check: false
        }
    },
    mounted() {
        this.failure_Check = false
        Fire.$on('Failureflash', () => {
            this.failure_Check = true
        });
    },
    methods: {
        showFalse: function() {
            this.failure_Check = false
        }
    }
}
</script>

<style scoped>

</style>
