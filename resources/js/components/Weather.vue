<template>
    <div class="weather">
        <div class="weather__container">
            <header class="weather__header">
                <input type="text" autocomplete="off" class="weather__header-text" placeholder="Search for a city..." />
            </header>
            <main class="weather__body">
                <section>
                    <div class="weather__city">{{ current_weather.name }}</div>
                    <div class="weather__date">Thursday 10 January 2020</div>
                </section>
                <div>
                    <div class="weather__temp">{{ roundTemp(daily_weather[0].temp.day) }} <span class="weather__fair">°F</span></div>
                    <div class="weather__name">{{ daily_weather[0].weather[0].description }}</div>
                    <div class="weather__hi-lo">{{ roundTemp(daily_weather[0].temp.max) + '&#176F' }} /
                        {{ roundTemp(daily_weather[0].temp.min) + '&#176F' }}</div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.fetchCurrentWeather();
        this.fetchDailyWeather();
    },
    data() {
        return {
            current_weather: [],
            daily_weather:[]
        }
    },
    computed: {

    },

    methods: {
        fetchCurrentWeather() {
            let uri = `/api/weather-current`;
            axios.get(uri).then(response => {
                this.current_weather = response.data;
            })
            .catch((err) => {
                console.log(err)
            })
        },
        fetchDailyWeather() {
            let uri = `/api/weather-daily`;
            axios.get(uri).then(response => {
                this.daily_weather = response.data.daily;
            })
            .catch((err) => {
                console.log(err)
            })
        },
        roundTemp(temp) {
            return Math.round(temp);
        }
    },
}
</script>

<style scoped>

</style>
