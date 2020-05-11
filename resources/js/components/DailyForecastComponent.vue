<template>
    <div>
        <div v-if="daily">
            <div v-for="(day, index) in daily" :key="index">
                {{day}}
            </div>
        </div>
    </div>    
</template>

<script>
import moment from 'moment';

export default {
    name: 'daily-forecast-component',
    props: ['forecasts'],
    data: function () {
        return {
            daily: null
        };
    },
    mounted() {
        this.prepareDaily();
    },
    methods: {
        chunk (arr, len) {

            var chunks = [],
                i = 0,
                n = arr.length;

            while (i < n) {
            chunks.push(arr.slice(i, i += len));
            }

            return chunks;
        },
        prepareDaily() {
            // console.log(moment(this.getFirstDay()).format('LL'));
            // for (let i = 1; i <= 5; i++) {
                
            // }
            this.daily = this.chunk(this.forecasts, 8);

            console.log(this.daily);
            this.daily.map((day) => {
                day.map((hours) => {
                    console.log(moment(hours.dt * 1000).format('LLLL'));
                });
            });
        },
        // Is this always a Monday?
        getFirstDay() {
            return new Date(parseInt(this.forecasts[0].dt) * 1000);
        },
    }
}
</script>

<style scoped>

</style>