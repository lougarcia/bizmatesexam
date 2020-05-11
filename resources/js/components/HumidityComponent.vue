<template>
    <div class="humidity p-1">
        <fa-icon title="Humidity" class="icon" :icon="['fas', 'water']"/>
        <span class="ml-1">{{humidity}} g/m<sup>3</sup></span>
    </div>    
</template>

<script>
export default {
    name: 'humidity-component',
    props: ['humidity'],
}
</script>

<style scoped>

</style>