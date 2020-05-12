<template>
    <span>{{converted}}<sup>&deg;{{unit}}</sup></span>
</template>

<script>
// accepts default unit in Kelvin
export default {
    name: 'temparature-component',
    props: ['value', 'convertTo'],
    data: function () {
        return {
            converted: null,
            unit: 'k',
        }
    },
    created() {
        if(this.convertTo == 'c') {
            this.converted = this.toCelcius(this.value);
            this.unit = 'c';
        }
    },
    methods: {
        toCelcius(num) {
            return parseInt(num - 273.15);
        },
    }
}
</script>

<style scoped>
sup {
    text-transform: uppercase;
}
</style>