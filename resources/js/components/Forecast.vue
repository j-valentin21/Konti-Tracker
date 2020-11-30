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
                <div class="col-3 text-right mt-2">
                    <canvas ref="iconCurrent" id="iconCurrent" width="50" height="50"></canvas>
                    <div>{{dailyTemperature.high + '°F'}}</div>
                    <div>{{dailyTemperature.low + '°F'}}</div>
                </div>
            </div>
        </div>
        <div class="forecast__future-weather px-3 py-4 overflow-hidden">
            <div
                v-for="(day, index) in dailyWeather"
                :key="day.dt"
                class="d-flex align-items-center"
                :class="{'mt-4' : index > 0}">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 forecast__day">{{ day.dt }}</div>
                        <div class="col-6 px-2 d-flex align-items-center ">
                            <div>Icon</div>
                            <div class="ml-1">Cloudy with a chance of showers</div>
                        </div>
                        <div class="col-3 text-right mt-2">
                            <div>45°F</div>
                            <div>35°F</div>
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
    mounted() {
        this.conditions = this.daily.daily[0].weather[0].main;
        switch (this.conditions) {
            case "Clouds":
                this.dailyTemperature.icon = "cloudy"
                break;
            case "Thunderstorm":
                this.dailyTemperature.icon = "thunder-rain"
                break;
            case "Drizzle":
                this.dailyTemperature.icon = "showers-day"
                break;
            case "Rain":
                this.dailyTemperature.icon = "rain"
                break;
            case "Snow":
                this.dailyTemperature.icon = "snow"
                break;
            case "Clear":
                this.dailyTemperature.icon = "clear-day"
                break;
            case "Fog":
                this.dailyTemperature.icon = "fog"
                break;
            case "Tornado":
            default:
                this.dailyTemperature.icon = "partly-cloudy-day"
                break;
        }
        const skycons = new Skycons({'color': 'white'});
        skycons.add("iconCurrent", this.dailyTemperature.icon);
        skycons.play()
    },
    data() {
        return {
            dailyWeather: this.daily.daily,
            feelsLike: this.currentTemperature.feels,
            dailyForecast: true,
            dailyTemperature: {
                high: Math.round(this.daily.daily[0].temp.max) ,
                low: Math.round(this.daily.daily[0].temp.min),
                actual: Math.round(this.daily.daily[0].temp.day),
                description: this.daily.daily[0].weather[0].description,
                icon: ''
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
