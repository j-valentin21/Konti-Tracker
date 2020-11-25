<template>
    <div class="weather">
        <div class="weather__container">
            <header class="weather__header">
                <input type="text" autocomplete="off" class="weather__header-text" placeholder="Search for a city..." />
            </header>
            <main class="weather__body">
                <section>
                    <div class="weather__city">{{ weather.name }}</div>
                    <div class="weather__date">Thursday 10 January 2020</div>
                </section>
                <div>
                    <div class="weather__temp">{{ roundTemp(weather.main.temp) }} <span class="weather__fair">°F</span></div>
                    <div class="weather__name">{{ weather.weather[0].description }}</div>
                    <div class="weather__hi-lo">{{ roundTemp(weather.main.temp_min) }} / {{ weather.main.temp_max }}</div>
                </div>
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
            weather: []
        }
    },
    computed: {

    },

    methods: {
        fetchWeather() {
            let uri = `/api/weather`;
            axios.get(uri).then(response => {
                this.weather = response.data;
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
