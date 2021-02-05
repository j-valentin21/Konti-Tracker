<template>
    <div v-if="failureCheck" class="col-sm-12">
        <div class="alert fade alert__danger alert-dismissible text-left brk-library-rendered rendered show">
            <button type="button" class="close" data-dismiss="alert" @click="showFalse">
                <span aria-hidden="true" class="mb-5">
                    <svg class="alert__icon alert__icon--x_red">
                        <use href="/svg/sprite.svg#icon-times"></use>
                    </svg>
                </span>
                <span class="sr-only">Close</span>
            </button>
            <span class="alert__start">
                <svg class="alert__icon alert__icon--danger">
                    <use href="/svg/sprite.svg#icon-dangerous"></use>
                </svg>
            </span>
            <slot><strong class="alert__message">{{ message }}</strong></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "FailureFlash",
    data() {
        return {
            failureCheck: false,
            message: ""
        }
    },
    mounted() {
        this.failureCheck = false
        Fire.$on('Failureflash', (event) => {
            this.failureCheck = true
            this.message = event.message
        });
    },
    methods: {
        showFalse: function() {
            this.failureCheck = false
        }
    }
}
</script>
