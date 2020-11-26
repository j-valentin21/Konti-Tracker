<template>
    <div class="weather">
        <div class="weather__container">
            <header class="weather__header">
                <input type="text" autocomplete="off" class="weather__header-text" placeholder="Search for a city..." />
            </header>
            <main class="weather__body">
                <section v-if="forecast">
                    <div class="weather__city">name</div>
                    <div class="weather__date">{{}}</div>
                    <div>
                        <div class="weather__temp">{{ roundTemp(day) }} <span class="weather__fair">°F</span></div>
                        <div class="weather__name"> description </div>
                        <div class="weather__hi-lo">{{ roundTemp(20) + '&#176F' }} /
                            {{ roundTemp(30) + '&#176F' }}</div>
                    </div>
                </section>
                <forecast v-else/>
                <button type="button" @click="getForecast" class="btn btn-primary btn-lg border border-dark mt-5">7-Day Forecast</button>
            </main>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.fetchWeather();
    },
    data() {
        return {
            forecast: true,
            location: {
                name: 'Allentown, PA',
                lon: -75.49,
                lat: 40.61
            }
        }
    },
    computed: {

    },
    methods: {
        fetchWeather() {
            let uri = `/api/weather-daily?lat=${this.location.lat}&lon=${this.location.lon}&exclude=current,minutely,hourly,alerts&units=imperial`;
            axios.get(uri).then(response => {
                console.log(response.data);
            })
            .catch((err) => {
                console.log(err)
            })
        },
        getForecast() {
            this.forecast = false
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
