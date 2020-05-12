<template>
    <div v-if="dailySingle" class="d-flex justify-content-around">
        <div v-for="(day, index) in dailySingle" :key="index" class="text-center">
            <DateTimeComponent :value="new Date(day.dt * 1000)" :format="'ddd'" />
            <WeatherIconComponent :icon="day.weather[0].icon" :text="day.weather[0].description"/>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
import DateTimeComponent from './DateTimeComponent';
import WeatherIconComponent from './WeatherIconComponent';

export default {
    name: 'daily-forecast-component',
    components: {
        DateTimeComponent,
        WeatherIconComponent,
    },
    props: ['forecasts'],
    data: function () {
        return {
            dailyChunk: [],
            dailySingle: [],
        };
    },
    mounted() {
        // These logic relies so much on the API's data format
        // I'm crossing my finger hoping they will not change
        // while someone checks my codes T_T
        this.dailyChunk = this.prepareDailyChunk();
        this.dailySingle = this.prepareDailySingle();
    },
    methods: {
        prepareDailyChunk() {
            let res = [];
            let currentSelected = this.getFirstDay();

            for (let i = 0; i < 5; i++) {
                res[i] = [];
                let filtered = this.forecasts.filter(item => {
                    const dt = new Date(parseInt(item.dt) * 1000);
                    return moment(dt).format('LL') == currentSelected.format('LL');
                });
                res[i].push(filtered);
                currentSelected = currentSelected.add(1, 'days');
            }
            return res;
        },
        /**
         * Prepares an array from the list based on the user's current time
         */
        prepareDailySingle() {
            let res = [];
            let currentSelected = this.getFirstDay();

            for (let i = 0; i < 5; i++) {
                res[i] = this.forecasts.find(item => {
                    const dt = new Date(parseInt(item.dt) * 1000);
                    return moment(dt).format('LLL') == currentSelected.format('LLL');
                });
                currentSelected = currentSelected.add(1, 'days');
            }

            return res;
        },
        getFirstDay() {
            return moment(new Date(parseInt(this.forecasts[0].dt) * 1000));
        },
    }
}
</script>

<style scoped>

</style>