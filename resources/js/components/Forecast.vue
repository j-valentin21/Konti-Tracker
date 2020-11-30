<template>
    <div class="text-white mb-5">
        <div class="forecast rounded">
            <div class="d-flex align-content-center justify-content-between px-3 py-4">
                <div class="d-flex align-items-center">
                    <div>
                        <div class="forecast__current font-weight-bold">{{ dailyTemperature.actual + '°F' }}</div>
                        <div class="">Feels like {{ feelsLike + '°F' }}</div>
                    </div>
                    <div class="mx-3">
                        <div class="font-weight-bold">{{dailyTemperature.description}}</div>
                        <div>Allentown, PA</div>
                    </div>
                </div>
                <div>Icon</div>
                <div class="col-3 text-right mt-2">
                    <div>{{dailyTemperature.high + '°F'}}</div>
                    <div>{{dailyTemperature.low + '°F'}}</div>
                </div>
            </div>
        </div>
        <div class="forecast__future-weather px-3 py-4 overflow-hidden">
            <div class="d-flex align-items-center">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 forecast__day">MON</div>
                        <div class="col-6 px-2 d-flex align-items-center ">
                            <div>Icon</div>
                            <div class="ml-1">Cloudy with a chance of showers</div>
                        </div>
                        <div class="col-3 text-right mt-2">
                            <div>45°F</div>
                            <div>35°F</div>
                        </div>

                        <div class="col-3 forecast__day mt-2">TUES</div>
                        <div class="col-6 px-2 d-flex align-items-center ">
                            <div>Icon</div>
                            <div class="ml-1">Cloudy with a chance of showers</div>
                        </div>
                        <div class="col-3 text-right mt-2">
                            <div>42°F</div>
                            <div>36°F</div>
                        </div>

                        <div class="col-3 forecast__day mt-2">WED</div>
                        <div class="col-6 px-2 d-flex align-items-center ">
                            <div>Icon</div>
                            <div class="ml-1">Cloudy with a chance of showers</div>
                        </div>
                        <div class="col-3 text-right mt-2">
                            <div>41°F</div>
                            <div>34°F</div>
                        </div>
                    </div>
                    <div class="justify-content-center">
                        <button type="button" @click="getDailyForecast"   class="btn btn-primary btn-lg border border-dark mt-5">Current Weather</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['currentTemperature', 'daily'],
    data() {
        return {
            feelsLike: this.currentTemperature.feels,
            dailyForecast: true,
            dailyTemperature: {
                high: Math.round(this.daily.daily[0].temp.max) ,
                low: Math.round(this.daily.daily[0].temp.min),
                actual: Math.round(this.daily.daily[0].temp.day),
                description: this.daily.daily[0].weather[0].description
            }
        }
    },
    methods: {
        getDailyForecast() {
            Fire.$emit('dailyForecast');
        }
    }
}
</script>

<style scoped>

</style>
