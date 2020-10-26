<template>
    <div>
        <success-flash v-if="success" :success="success"/>
        <div class="pb-3 border__bottom--grey">
            <div class="row align-items-center">
                <div class="col-8">
                    <p class="mb-2 dashboard__card__text ">PTO</p>
                    <h4  class="my-3 text-white">{{ pto_value }}</h4>
                </div>
                <div class="col-4">
                    <div class="text-right">
                        <button type="button" @click="increasePTO" class="btn__step mb-2">+</button>
                        <button type="button" @click="decreasePTO" class="btn__step">-</button>
                    </div>
                </div>
            </div>
            <form method="POST" @submit.prevent = 'submitCount'>
                <div class="text-center">
                    <button class="btn__submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="py-3 border__bottom--grey">
            <div class="row align-items-center">
                <div class="col-8">
                    <p class="mb-2 dashboard__card__text">Points</p>
                    <h4 class="my-3 text-white">{{ points_value }}</h4>
                </div>
                <div class="col-4">
                    <div class="text-right">
                        <button type="button" @click="increasePoints" class="btn__step mb-2">+</button>
                        <button type="button" @click="decreasePoints" class="btn__step">-</button>
                    </div>
                </div>
            </div>
            <form method="POST" @submit.prevent = 'submitCount'>
                <div class="text-center">
                    <button type="submit" class="btn__submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import SuccessFlash from './SuccessFlash.vue';
export default {
    components: {
        SuccessFlash
    },
    props : ['pto', 'points'],
    data() {
        return {
            pto_value: this.pto,
            points_value: this.points,
            failure: false,
            success: false
        }
    },
    methods: {
        increasePTO: function() {
            if(this.pto_value < 40) {
                this.pto_value++;
            }
        },
        decreasePTO:  function() {
            if(this.pto_value > 0) {
                this.pto_value--;
            }
        },
        increasePoints: function() {
            if(this.points_value < 15) {
                this.points_value++;
            }
        },
        decreasePoints:  function() {
            if(this.points_value > 0) {
                this.points_value--;
            }
        },
       changeSuccess: function() {
            return new Promise(function(resolve, reject) {
            setTimeout(resolve, 8000);
            }).then( response => {
            this.success = false;
            });
        },
        submitCount() {
            axios.put("/dashboard",this.$data)
            .then( response => {
               this.success = true
                this.changeSuccess()
            })

            .catch((err) => {
                this.failure = true
            })
        },
    }
}
</script>
