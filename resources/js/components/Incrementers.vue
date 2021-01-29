<template>
    <div>
        <h4 class="card-title dashboard__card__title  mb-4">Overview</h4>
        <div class="pb-3 border__bottom--grey">
            <div class="row align-items-center">
                <div class="col-8">
                    <h4 class="mb-2 dashboard__card__header ">PTO</h4>
                    <p class="dashboard__card__value my-3 mx-2 text-white">{{ `${pto_value} Days`}}</p>
                </div>
                <div class="col-4">
                    <div class="text-right">
                        <button type="button" @click="increasePTO" class="btn__step mb-2">+</button>
                        <button type="button" @click="decreasePTO" class="btn__step">-</button>
                    </div>
                </div>
            </div>
            <form v-if="showPTOButton" method="POST" @submit.prevent = 'submitCount'>
                <div class="text-center mt-3">
                    <button class="btn__submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="py-3 border__bottom--grey">
            <div class="row align-items-center">
                <div class="col-8">
                    <h4 class="mb-2 dashboard__card__header">Points</h4>
                    <p class="dashboard__card__value my-3 mx-2 text-white">{{ points_value }}</p>
                </div>
                <div class="col-4">
                    <div class="text-right">
                        <button type="button" @click="increasePoints" class="btn__step mb-2">+</button>
                        <button type="button" @click="decreasePoints" class="btn__step">-</button>
                    </div>
                </div>
            </div>
            <form v-if="showPointsButton" method="POST" @submit.prevent = 'submitCount'>
                <div class="text-center mt-3">
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
            pto_count: 0,
            points_count: 0,
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
                this.pto_value+= .25;
                this.pto_count+= .25;
            }
        },
        decreasePTO:  function() {
            if(this.pto_value > 0) {
                this.showPTOButton = true
                this.pto_value-= .25;
                this.pto_count-= .25;
            }
        },
        increasePoints: function() {
            if(this.points_value < 15) {
                this.showPointsButton = true
                this.points_value++;
                this.points_count++
            }
        },
        decreasePoints:  function() {
            if(this.points_value > 0) {
                this.showPointsButton = true
                this.points_value--;
                this.points_count--;
            }
        },
        submitCount() {
            axios.put("/dashboard",this.$data)
            .then( response => {
                Fire.$emit('SubmitCount');
                Fire.$emit('Successflash');
            })
            .catch((err) => {
                Fire.$emit('Failureflash');
            })
        },
    }
}
</script>
