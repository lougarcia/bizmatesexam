<template>
    <div>
        <img class="icon-image" :src="iconLink()" :title="text" />
        <div class="icon-desc">{{text}}</div>
    </div>
</template>

<script>
export default {
    name: 'weather-icon-component',
    props: ['icon', 'text'],
    methods: {
        iconLink() {
            const url = process.env.MIX_OPENWEATHERMAP_ICON_URL;
            return url + this.icon + '@2x.png';
        }
    }
}
</script>