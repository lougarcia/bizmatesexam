<template>
    <div class="city p-1" v-if="city" @click="$emit('select-city', {weatherData})">
        <div class="p-1 tools text-right" style="color:white">
            <fa-icon class="icon" :icon="['fas', 'redo-alt']" @click.stop="refreshCity()" />
            <fa-icon class="ml-1 icon" :icon="['far', 'trash-alt']" @click.stop="deleteCity()"/>
        </div>
        <h3 class="px-3 pt-1 mb-0">{{city.name}}</h3>
        <div class="p-3" v-if="weatherData">
            <div class="mb-2">
                <div class="d-flex justify-content-around">
                    <div class="temp flex-fill mr-2 text-center">
                        <TemperatureComponent :value="currentWeather.main.temp" :convertTo="'c'"/>
                    </div>
                    <div class="forecast flex-fill align-self-stretch text-center">
                        <WeatherIconComponent :icon="currentWeather.weather[0].icon" :text="currentWeather.weather[0].description"/>
                    </div>
                </div>
            </div>
            <div class="sun p-1">
                <fa-icon class="icon" :icon="['fas', 'sun']"/>
                <DateTimeComponent :value="new Date(weatherData.city.sunrise * 1000)" :format="'LT'"/> -
                <DateTimeComponent :value="new Date(weatherData.city.sunset * 1000)" :format="'LT'"/>
            </div>
        </div>
        <div v-else>Please wait...</div>
    </div>
</template>

<script>
import axios from 'axios';
import WeatherIconComponent from './WeatherIconComponent';
import TemperatureComponent from './TemperatureComponent';
import DateTimeComponent from './DateTimeComponent';

export default {
    name: 'city-component',
    components: {
        WeatherIconComponent,
        TemperatureComponent,
        DateTimeComponent,
    },
    props: ['city'],
    data: function () {
        return {
            weatherData: null,
            venues: [],
        };
    },
    created() {
        axios.get(`/openweathermap/${this.city.name}/${this.city.country}`)
            .then((response) => {
                this.weatherData = response.data;
                this.currentWeather = this.setCurrentWeather();
            });
    },
    methods: {
        setCurrentWeather() {
            // returns the first matching weather data
            // based on current user time
            let idx = this.weatherData.list.findIndex((data) => {
                return data.dt * 1000 > new Date().getTime();
            });

            // use previous item because it best represents
            // the user's current time
            idx = idx > 0 ? idx-1 : 0;

            return this.weatherData.list[idx];
        },
        refreshCity() {
            alert('refresh');
        },
        deleteCity() {
            alert('delete');
        }
    },
}
</script>

<style scoped>
.city {
    background-color: #023;
    cursor: pointer;
    background: linear-gradient(135deg,  #006273 0%,#002233 100%);
}

h3 {
    color: #fff;
    font-size: 2em;
}

.tools .icon {
    padding: 2px;
    border: 1px solid #fff;
    font-size: 1.6em;
    min-width: 1.2em;
    opacity: 0.4;
}

.tools .icon:hover {
    opacity: 0.8;
}

.sun {
    color: #fff;
    font-size: 1em;
}

.sun .icon {
    font-size: 1.6em;
    vertical-align: middle;
}

.sun >>> span {
    vertical-align: middle;
}

.temp >>> span {
    color: #fff;
    font-size: 5em;
}

.temp >>> sup {
    font-size: 0.5em;
}

.forecast >>> .icon-desc {
    margin-top: -1em;
    text-transform: capitalize;
    color: #fff;
}
</style>