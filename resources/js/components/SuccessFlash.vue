<template>
    <div v-if="successCheck" class="col-sm-12">
        <div class="alert fade alert__success alert-dismissible text-left brk-library-rendered rendered show">
            <div class="d-flex">
                <button type="button" class="close" data-dismiss="alert" @click="showFalse">
                    <span aria-hidden="true" class="mb-5">
                        <svg class="alert__icon alert__icon--x">
                            <use href="/svg/sprite.svg#icon-times"></use>
                        </svg>
                    </span>
                    <span class="sr-only">Close</span>
                </button>
                <span class="alert__start mr-3">
                    <svg class="alert__icon alert__icon--check">
                        <use href="/svg/sprite.svg#icon-check_circle_outline"></use>
                    </svg>
                </span>
                <slot> <strong class="alert__message pr-3">{{ message }}</strong></slot>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "SuccessFlash",
    data() {
        return {
            message: '',
            successCheck: false
        }
    },
    mounted() {
        this.successCheck = false
        Fire.$on('Successflash', (event) => {
            this.successCheck = true
            this.message = event.message
        });
    },
    methods: {
        showFalse: function() {
            this.successCheck = false
        }
    }
}
</script>
