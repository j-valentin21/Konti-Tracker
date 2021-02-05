<template>
    <div class="weather" :style="image">
        <div class="weather__container">
            <failure-flash></failure-flash>
            <header class="weather__header">
                <input type="search" id="address" class="weather__header-text" placeholder="Search for a city..." />
                <p hidden>Selected: <strong id="address-value">none</strong></p>
            </header>
            <main class="weather__body">
                <section v-if="forecast">
                    <div class="weather__city">{{location.name}}</div>
                    <div class="weather__date">{{getDate(currentTemperature.time)}}</div>
                    <div>
                        <div class="weather__temp">{{ currentTemperature.actual }} <span class="weather__fair">°F</span></div>
                        <div class="text-white mb-3 font-weight-bold">Feels like {{ currentTemperature.feels + '°F' }}</div>
                        <div class="weather__name my-4"> {{ currentTemperature.description }} </div>
                        <div class="weather__hi-lo">{{ dailyTemperature.high + '°F'  }} /
                            {{ dailyTemperature.low + '°F'  }}</div>
                    </div>
                    <button type="button" @click="forecast = !forecast" class="btn btn-primary btn-lg border border-dark mt-5">7-Day Forecast</button>
                </section>
                <forecast
                    :locationName= location
                    :currentTemperature="currentTemperature"
                    :daily="daily"
                    :key="componentKey"
                    v-if="!forecast"/>
            </main>
        </div>
    </div>
</template>

<script>
import places from 'places.js';

export default {
    props:['componentKey'],
    mounted() {
        this.fetchWeather();
        Fire.$on('dailyForecast', () => {
            this.forecast = true
        });
        const placesAutocomplete = places({
            appId: 'pl8C4GU8WLCX',
            apiKey: '73537beb0b92ba86a681e26605eedc50',
            container: document.querySelector('#address')
        }).configure({
            type: 'city',
            aroundLatLngViaIP: false,
        });
        const $address = document.querySelector('#address-value')
        placesAutocomplete.on('change', (e) => {
            $address.textContent = e.suggestion.value
            this.location.name = `${e.suggestion.name}, ${e.suggestion.administrative}`
            this.location.lat = e.suggestion.latlng.lat
            this.location.lon = e.suggestion.latlng.lng
        });
        placesAutocomplete.on('clear', function () {
            $address.textContent = 'none';
        });
    },
    watch: {
        location: {
            handler(newValue,oldValue) {
                this.fetchWeather();
                this.componentKey++
            },
            deep:true
        }
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
            },
            currentTemperature: {
                actual: '',
                feels: '',
                icon: '',
                description: '',
                time: ''
            },
            dailyTemperature: {
                high: '' ,
                low: ''
            }
        }
    },
    methods: {
        fetchWeather() {
            let uri = `/api/weather?lat=${this.location.lat}&lon=${this.location.lon}&exclude=minutely,hourly,alerts&units=imperial`;
            axios.get(uri).then(response => {
                this.currentTemperature.actual = Math.round(response.data.current.temp);
                this.currentTemperature.feels = Math.round(response.data.current.feels_like);
                this.currentTemperature.description = response.data.current.weather[0].description;
                this.currentTemperature.icon = response.data.daily[0].weather[0].icon;
                this.currentTemperature.time = response.data.current.dt;

                this.dailyTemperature.high = Math.round(response.data.daily[0].temp.max);
                this.dailyTemperature.low = Math.round(response.data.daily[0].temp.min);

                this.daily = response.data;
                this.conditions = response.data.daily[0].weather[0].main;

                switch (this.conditions) {
                    case "Clouds":
                        this.image = {backgroundImage: "url(/img/cloudy.jpg)"}
                        break;
                    case "Thunderstorm":
                        this.image = {backgroundImage: "url(/img/thunderstorm.jpg)"}
                        break;
                    case "Drizzle":
                        this.image = {backgroundImage: "url(/img/drizzle.jpg)"}
                        break;
                    case "Rain":
                        this.image = {backgroundImage: "url(/img/rain.jpg)"}
                        break;
                    case "Snow":
                        this.image = {backgroundImage: "url(/img/snow.jpg)"}
                        break;
                    case "Clear":
                        this.image = {backgroundImage: "url(/img/clear.jpg)"}
                        break;
                    case "Fog":
                        this.image = {backgroundImage: "url(/img/fog.jpg)"}
                        break;
                    case "Tornado":
                        this.image = {backgroundImage: "url(/img/tornado.jpg)"}
                        break;
                    default:
                        this.image = {backgroundImage: "url(/img/cloudy.jpg)"}
                        break;
                }
            })
            .catch((err) => {
                Fire.$emit('Failureflash',{
                    message: "An issue updating your weather has occurred. Please try again at a later time."
                });
            })
        },
        getDate(timestamp) {
            let newDate = new Date(timestamp * 1000)
            let days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']
            let months =['January', 'February' , 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October','November', 'December']
            let day =days[newDate.getDay()];
            let date = newDate.getDate();
            let month = months[newDate.getMonth()];
            let year = newDate.getFullYear();

            return `${day}, ${month} ${date}, ${year}`
        }
    },
}
</script>
