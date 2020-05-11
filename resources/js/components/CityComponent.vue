<template>
    <div>
        <div class="city p-1" v-if="city" @click="$emit('select-city', {weatherData})">
            <div class="p-1 tools text-right" style="color:white">
                <fa-icon class="icon" :icon="['fas', 'redo-alt']" @click.stop="refreshCity()" />
                <fa-icon class="ml-1 icon" :icon="['far', 'trash-alt']" @click.stop="deleteCity()"/>
            </div>
            <h3 class="px-3 pt-1 mb-0">{{city.name}}</h3>
            <div class="p-3" v-if="weatherData">
                <div class="mb-2">
                    <div class="d-flex justify-content-around">
                        <div class="temp flex-fill mr-2">
                            <div class="text-center">
                                <span class="temp-val">{{this.toCelcius(currentWeather.main.temp)}}<sup class="temp-unit">&deg;C</sup></span>
                            </div>
                        </div>
                        <div class="forecast flex-fill align-self-stretch">
                            <div class="text-center">
                                <img :src="iconLink(currentWeather.weather[0].icon)" :title="currentWeather.weather[0].description" />
                                <div class="forecast-desc">{{currentWeather.weather[0].description}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sun p-1">
                    <fa-icon class="icon" :icon="['fas', 'sun']"/>
                    <span class="ml-1 sun-info">{{this.toTime(weatherData.city.sunrise)}} - {{this.toTime(weatherData.city.sunset)}}</span>
                </div>
            </div>
            <div v-else>Please wait...</div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'city-component',
    props: ['city'],
    data: function () {
        return {
            weatherData: null,
            venues: [],
        };
    },
    created() {

    },
    mounted() {
        axios.get(`/openweathermap/${this.city.name}/${this.city.country}`)
            .then((response) => {
                this.weatherData = response.data;
                this.currentWeather = this.setCurrentWeather();
            });
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
        toCelcius(num) {
            return parseInt(num - 273.15);
        },
        iconLink(code) {
            return 'http://openweathermap.org/img/wn/' + code + '@2x.png';
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
    background-size: cover;
    cursor: pointer;
    background: linear-gradient(135deg,  #006273 0%,#002233 100%);
}

h3 {
    color: white;
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
    color: white;
    font-size: 1em;
}

.sun .icon {
    font-size: 1.6em;
    vertical-align: middle;
}

.sun .sun-info {
    vertical-align: middle;
}

.temp {
    color: white;
}

.temp .temp-val {
    font-size: 5em;
}

.temp .temp-unit {
    font-size: 0.5em;
}

.forecast {
    color: white;
}

.forecast-desc {
    margin-top: -1em;
    text-transform: capitalize;
}
</style>