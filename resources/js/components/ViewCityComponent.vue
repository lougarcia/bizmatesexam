<template>
    <div class="wrap p-4">
        <a @click="$emit('close-selected-city')">Close</a>
        <h3>{{city.name}}</h3>
        <div v-if="currentWeather" class="d-flex justify-content-around">
            <div class="flex-fill mr-2 text-center">
                <TemperatureComponent class="temp" :value="currentWeather.main.temp" :convertTo="'c'"/>
            </div>
            <div class="flex-fill mr-2 align-self-stretch text-center">
                <WeatherIconComponent :icon="currentWeather.weather[0].icon" :text="currentWeather.weather[0].description"/>
            </div>
            <div class="flex-fill align-self-stretch">
                <div class="sun p-1">
                    <fa-icon class="icon" :icon="['fas', 'sun']"/>
                    <span class="ml-1 sun-info">
                        <DateTimeComponent :value="new Date(city.weatherData.city.sunrise * 1000)" :format="'LT'"/> -
                        <DateTimeComponent :value="new Date(city.weatherData.city.sunset * 1000)" :format="'LT'"/>
                    </span>
                </div>
                <WindComponent :wind="currentWeather.wind"/>
                <HumidityComponent :humidity="currentWeather.main.humidity"/>
            </div>
        </div>
        <DailyForecastComponent :forecasts="city.weatherData.list"/>
        <FoursquareComponent/>
    </div>
</template>

<script>
import WindComponent from './WindComponent';
import HumidityComponent from './HumidityComponent';
import DailyForecastComponent from './DailyForecastComponent';
import WeatherIconComponent from './WeatherIconComponent';
import DateTimeComponent from './DateTimeComponent';
import TemperatureComponent from './TemperatureComponent';
import FoursquareComponent from './FoursquareComponent';

export default {
    name: 'view-city-component',
    components: {
        WindComponent,
        HumidityComponent,
        DailyForecastComponent,
        WeatherIconComponent,
        DateTimeComponent,
        TemperatureComponent,
        FoursquareComponent,
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
    }
}
</script>

<style scoped>
.wrap {
    background-color: #023;
    background: linear-gradient(135deg,  #006273 0%,#002233 100%);
    color: #fff;
}

.wrap >>> .icon-desc {
    margin-top: -1em;
}

.temp {
    color: #fff;
    font-size: 5em;
}

.temp sup {
    font-size: 0.5em;
}

</style>