<template>
    <div>
        <success-flash v-if="success" :success="success"/>
        <failure-flash v-if="failure" :failure="failure"/>
        <h4 class="card-title dashboard__card__title  mb-4">Overview</h4>
        <div class="pb-3 border__bottom--grey">
            <div class="row align-items-center">
                <div class="col-8">
                    <p class="mb-2 dashboard__card__text ">PTO</p>
                    <h4  class="my-3 text-white">{{ `${pto_value} Days`}}</h4>
                </div>
                <div class="col-4">
                    <div class="text-right">
                        <button type="button" @click="increasePTO" class="btn__step mb-2">+</button>
                        <button type="button" @click="decreasePTO" class="btn__step">-</button>
                    </div>
                </div>
            </div>
            <form v-if="showPTOButton" method="POST" @submit.prevent = 'submitCount'>
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
            <form v-if="showPointsButton" method="POST" @submit.prevent = 'submitCount'>
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
    props : ['pto', 'points','pto_usage'],
    data() {
        return {
            pto_value: this.pto,
            points_value: this.points,
            pto_used: this.pto_usage,
            failure: false,
            success: false,
            showPTOButton:false,
            showPointsButton:false
        }
    },
    methods: {
        increasePTO: function () {
            if (this.pto_value < 40) {
                this.showPTOButton = true
                this.pto_value++;
            }
        },
        decreasePTO:  function() {
            if(this.pto_value > 0) {
                this.showPTOButton = true
                this.pto_value--;
            }
        },
        increasePoints: function() {
            if(this.points_value < 15) {
                this.showPointsButton = true
                this.points_value++;
            }
        },
        decreasePoints:  function() {
            if(this.points_value > 0) {
                this.showPointsButton = true
                this.points_value--;
            }
        },
       changeSuccess: function() {
            return new Promise(function(resolve, reject) {
            setTimeout(resolve, 7000);
            }).then( response => {
            this.success = false;
            });
        },
        changeFailure: function() {
            return new Promise(function(resolve, reject) {
                setTimeout(resolve, 7000);
            }).then( response => {
                this.failure = false;
            });
        },
        submitCount() {
            axios.put("/dashboard",this.$data)
            .then( response => {
               this.success = true
               this.changeSuccess()
                Fire.$emit('SubmitCount');
            })

            .catch((err) => {
                console.log(err)
                this.failure = true
                this.changeFailure()
            })
        },
    }
}
</script>
