<template>
    <div class="p-4 border">
        <a @click="$emit('close-selected-city')">Close</a>
        <h3>{{city.name}}</h3>
        <div v-if="currentWeather" class="d-flex justify-content-around">
            <div class="temp flex-fill mr-2">
                <div class="text-center">
                    <span class="temp-val">{{this.toCelcius(currentWeather.main.temp)}}<sup class="temp-unit">&deg;C</sup></span>
                </div>
            </div>
            <div class="forecast flex-fill mr-2 align-self-stretch">
                <div class="text-center">
                    <img :src="iconLink(currentWeather.weather[0].icon)" :title="currentWeather.weather[0].description" />
                    <div class="forecast-desc">{{currentWeather.weather[0].description}}</div>
                </div>
            </div>
            <div class="flex-fill align-self-stretch">
                <div class="sun p-1">
                    <fa-icon class="icon" :icon="['fas', 'sun']"/>
                    <span class="ml-1 sun-info">{{this.toTime(city.weatherData.city.sunrise)}} - {{this.toTime(city.weatherData.city.sunset)}}</span>
                </div>
                <WindComponent :wind="currentWeather.wind"/>
                <HumidityComponent :humidity="currentWeather.main.humidity"/>
            </div>
        </div>
        <div class="d-flex justify-content-around">
            <DailyForecastComponent :forecasts="city.weatherData.list"/>
        </div>
    </div>
</template>

<script>
import WindComponent from './WindComponent';
import HumidityComponent from './HumidityComponent';
import DailyForecastComponent from './DailyForecastComponent';

export default {
    name: 'view-city-component',
    components: {
        WindComponent,
        HumidityComponent,
        DailyForecastComponent,
    },
    props: ['city'],
    data: function () {
        return {
            currentWeather: null
        };
    },
    mounted() {
        this.currentWeather = this.setCurrentWeather();
    },
    methods: {
        toTime(secs) {
            const dt = new Date(secs * 1000);
            let time = this.formatHour(dt.getHours()) + ':' + this.addZero(dt.getMinutes());
            let ampm = (dt.getHours() >= 12) ? ' PM' : ' AM';
            return time + ampm;
        },
        addZero(num) {
            return num < 10 ? '0' + num : num;
        },
        formatHour(num) {
            return num > 12 ? num - 12 : num
        },
        setCurrentWeather() {
            console.log(this.city);
            // returns the first matching weather data
            // based on current user time
            let idx = this.city.weatherData.list.findIndex((data) => {
                return data.dt * 1000 > new Date().getTime();
            });

            // use previous item because it best represents
            // the user's current time
            idx = idx > 0 ? idx-1 : 0;

            return this.city.weatherData.list[idx];
        },
        toCelcius(num) {
            return parseInt(num - 273.15);
        },
        iconLink(code) {
            return 'http://openweathermap.org/img/wn/' + code + '@2x.png';
        },
    }
}
</script>

<style scoped>

</style>