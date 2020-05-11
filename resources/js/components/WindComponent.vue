<template>
    <div class="wind p-1">
        <fa-icon title="Wind" class="icon" :icon="['fas', 'wind']"/>
        <span class="ml-1">{{wind.speed}} m/s {{getCardinal(wind.deg)}}</span>
    </div>    
</template>

<script>
export default {
    name: 'wind-component',
    props: ['wind'],
    methods: {
        // convert degrees to cardinal directions
        // i.e: N, E, SE, NW
        // source: https://gist.github.com/basarat/4670200
        getCardinal(deg) {
            const degreePerDirection = 360 / 8;
            const offsetAngle = deg + degreePerDirection / 2;
            return (offsetAngle >= 0 * degreePerDirection && offsetAngle < 1 * degreePerDirection) ? "N"
                : (offsetAngle >= 1 * degreePerDirection && offsetAngle < 2 * degreePerDirection) ? "NE"
                : (offsetAngle >= 2 * degreePerDirection && offsetAngle < 3 * degreePerDirection) ? "E"
                : (offsetAngle >= 3 * degreePerDirection && offsetAngle < 4 * degreePerDirection) ? "SE"
                : (offsetAngle >= 4 * degreePerDirection && offsetAngle < 5 * degreePerDirection) ? "S"
                : (offsetAngle >= 5 * degreePerDirection && offsetAngle < 6 * degreePerDirection) ? "SW"
                : (offsetAngle >= 6 * degreePerDirection && offsetAngle < 7 * degreePerDirection) ? "W"
                : "NW";
        }
    }
}
</script>

<style scoped>

</style>