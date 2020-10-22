<template>
    <div>
        <div class="pb-3 border__bottom--grey">
            <div class="row align-items-center">
                <div class="col-8">
                    <p class="mb-2 dashboard__card__text ">PTO</p>
                    <h4 class="my-3 text-white">{{ pto }}</h4>
                </div>
                <div class="col-4">
                    <div class="text-right">
                        <button type="button" @click="increasePTO" class="btn__step mb-2">+</button>
                        <button type="button" @click="decreasePTO" class="btn__step">-</button>
                    </div>
                </div>
            </div>
            <form method="POST" @submit.prevent = 'submitPTO'>
                <div class="text-center">
                    <button class="btn__submit">Submit</button>
                </div>
            </form>
        </div>
        <div class="py-3 border__bottom--grey">
            <div class="row align-items-center">
                <div class="col-8">
                    <p class="mb-2 dashboard__card__text">Points</p>
                    <h4 class="my-3 text-white">{{ points }}</h4>
                </div>
                <div class="col-4">
                    <div class="text-right">
                        <button type="button" @click="increasePoints" class="btn__step mb-2">+</button>
                        <button type="button" @click="decreasePoints" class="btn__step">-</button>
                    </div>
                </div>
            </div>
            <form method="POST" @submit.prevent = 'submitPoints'>
                <div class="text-center">
                    <button class="btn__submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props : ['pto', 'points'],
    methods: {
        increasePTO: function() {
            if(this.pto < 40) {
                this.pto++;
            }
        },
        decreasePTO:  function() {
            if(this.pto > 0) {
                this.pto--;
            }
        },
        increasePoints: function() {
            if(this.points < 15) {
                this.points++;
            }
        },
        decreasePoints:  function() {
            if(this.points > 0) {
                this.points--;
            }
        },
        submitPTO() {
            axios.put("/dashboard", this.$props)
                .catch(error => this.errors.record(error.response.data.errors))
        },
        submitPoints() {
            axios.put("/dashboard", this.$props)
                .catch(error => this.errors.record(error.response.data.errors))
        }
    }
}
</script>
