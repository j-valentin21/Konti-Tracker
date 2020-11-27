<template>
    <div class="weather" :style="image">
        <div class="weather__container">
            <header class="weather__header">
                <input type="text" autocomplete="off" class="weather__header-text" placeholder="Search for a city..." />
            </header>
            <main class="weather__body">
                <section v-if="forecast">
                    <div class="weather__city">name</div>
                    <div class="weather__date">{{}}</div>
                    <div>
                        <div class="weather__temp">{{ roundTemp(25) }} <span class="weather__fair">°F</span></div>
                        <div class="weather__name"> description </div>
                        <div class="weather__hi-lo">{{ roundTemp(20) + '&#176F' }} /
                            {{ roundTemp(30) + '&#176F' }}</div>
                    </div>
                    <button type="button" @click="forecast = !forecast" class="btn btn-primary btn-lg border border-dark mt-5">7-Day Forecast</button>
                </section>
                <forecast v-if="!forecast"/>
            </main>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.fetchWeather();
        Fire.$on('dailyForecast', () => {
            this.forecast = true
        });
    },
    data() {
        return {
            daily:[],
            conditions: [],
            image: {},
            forecast: true,
            location: {
                name: 'Allentown, PA',
                lon: -75.49,
                lat: 40.61
            }
        }
    },
    methods: {
        fetchWeather() {
            let uri = `/api/weather-daily?lat=${this.location.lat}&lon=${this.location.lon}&exclude=current,minutely,hourly,alerts&units=imperial`;
            axios.get(uri).then(response => {
                this.daily = response.data;
                this.conditions = response.data.daily[0].weather[0].main;
                switch (this.conditions) {
                    case "Clouds":
                        this.image = {backgroundImage: "url(http://127.0.0.1:8000/img/cloudy.jpg)"}
                        break;
                    case "Thunderstorm":
                        this.image = {backgroundImage: "url(http://127.0.0.1:8000/img/thunderstorm.jpg)"}
                        break;
                    case "Drizzle":
                        this.image = {backgroundImage: "url(http://127.0.0.1:8000/img/drizzle.jpg)"}
                        break;
                    case "Rain":
                        this.image = {backgroundImage: "url(http://127.0.0.1:8000/img/rain.jpg)"}
                        break;
                    case "Snow":
                        this.image = {backgroundImage: "url(http://127.0.0.1:8000/img/snow.jpg)"}
                        break;
                    case "Clear":
                        this.image = {backgroundImage: "url(http://127.0.0.1:8000/img/clear.jpg)"}
                        break;
                    case "Fog":
                        this.image = {backgroundImage: "url(http://127.0.0.1:8000/img/fog.jpg)"}
                        break;
                    case "Tornado":
                        this.image = {backgroundImage: "url(http://127.0.0.1:8000/img/tornado.jpg)"}
                        break;
                }
            })
            .catch((err) => {
                console.log(err)
            })
        },
        toFullDate(timestamp) {
            return new Date(timestamp * 1000);
        },
        roundTemp(temp) {
            return Math.round(temp);
        }
    },
}
</script>

<style scoped>

</style>
