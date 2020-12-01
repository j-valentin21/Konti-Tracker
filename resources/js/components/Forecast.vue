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
                    <canvas ref="iconCurrent" id="iconCurrent" width="45" height="45"></canvas>
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
                :class="{'mt-4' : index > 0}"
               v-if="index >= 1">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-3 forecast__day">{{ toDayOfWeek(day.dt) }}</div>
                        <div class="col-sm-6 px-2 d-flex align-items-center">
                            <div class="mr-3"><canvas :id="`icon${index+1}`" :data-icon="day.weather[0].icon" width="20" height="20"></canvas></div>
                            <div class="ml-1">{{ day.weather[0].description }}</div>
                        </div>
                        <div class="col-sm-3 text-right mt-2">
                            <div>{{ Math.round(day.temp.max) + '°F' }}</div>
                            <div>{{ Math.round(day.temp.min) + '°F' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="justify-content-center">
                <button type="button" @click="getDailyForecast"   class="btn btn-primary btn-lg border border-dark mt-5">Current Weather</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['currentTemperature', 'daily'],
    mounted() {
        this.dailyWeather.forEach(element => {
            switch (element.weather[0].main) {
                case "Clouds":
                    element.weather[0].icon = "cloudy"
                    break;
                case "Thunderstorm":
                    element.weather[0].icon = "thunder-rain"
                    break;
                case "Drizzle":
                    element.weather[0].icon = "showers-day"
                    break;
                case "Rain":
                    element.weather[0].icon = "rain"
                    break;
                case "Snow":
                    element.weather[0].icon = "snow"
                    break;
                case "Clear":
                    element.weather[0].icon = "clear-day"
                    break;
                case "Fog":
                    element.weather[0].icon = "fog"
                    break;
                case "Tornado":
                default:
                    element.weather[0].icon = "partly-cloudy-day"
                    break;
            }
        })
        const skycons = new Skycons({'color': 'white'});
        skycons.add("iconCurrent", this.dailyWeather[0].weather[0].icon);
        skycons.play()

        this.$nextTick(() => {
            skycons.add('icon2', document.getElementById('icon2').getAttribute('data-icon'))
            skycons.add('icon3', document.getElementById('icon3').getAttribute('data-icon'))
            skycons.add('icon4', document.getElementById('icon4').getAttribute('data-icon'))
            skycons.add('icon5', document.getElementById('icon5').getAttribute('data-icon'))
            skycons.add('icon6', document.getElementById('icon6').getAttribute('data-icon'))
            skycons.add('icon7', document.getElementById('icon7').getAttribute('data-icon'))
            skycons.add('icon8', document.getElementById('icon8').getAttribute('data-icon'))
            skycons.add('icon9', document.getElementById('icon9').getAttribute('data-icon'))
            skycons.play()
        })
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
            }
        }
    },
    methods: {
        getDailyForecast() {
            Fire.$emit('dailyForecast');
        },
        toDayOfWeek(timestamp) {
            const newDate = new Date(timestamp*1000)
            const days = ['SUN','MON','TUE','WED','THU','FRI','SAT']
            return days[newDate.getDay()]
        },
    },
}
</script>

<style scoped>

</style>
