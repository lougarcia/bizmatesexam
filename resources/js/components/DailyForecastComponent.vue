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
        prepareDaily() {
            console.log(moment(this.getFirstDay()).format('LL'));
        },
        getFirstDay() {
            return new Date(parseInt(this.forecasts[0].dt) * 1000);
        },
    }
}
</script>

<style scoped>

</style>