<template>
    <div class="pt-4">
        <div class="brand text-center mb-3">
            <fa-icon class="icon" :icon="['fab', 'foursquare']" size="3x"/>
            <span class="ml-1">FOURSQUARE</span>
        </div>
        <FoursquareVenueComponent class="venue p-4 mb-2 border bg-light" v-for="venue in venues" :venue="venue" :key="venue.id"/>
        <div class="preload text-center p-4" v-if="!venues.length">
            Loading... Please wait....
        </div>
    </div>
</template>

<script>
import Axios from 'axios';
import FoursquareVenueComponent from './FoursquareVenueComponent';

export default {
    name: 'foursquare-component',
    components: {
        FoursquareVenueComponent,
    },
    props: ['query'],
    data() {
        return {
            fs_data: null,
            venues: [],
        };
    },
    created() {
        Axios.get(`/foursquare/${this.query}`)
            .then((response) => {
                this.fs_data = response.data;
                this.venues = response.data.response.venues;
            });
    },
    methods: {
    },
}
</script>

<style scoped>
.brand {
    color: #fff;
}

.brand span {
    font-size: 2em;
    font-weight: bold;
}

.venue >>> * {
    color: #333;
}

.preload {
    color: #fff;
    font-weight: bold;
    opacity: 60%;
}
</style>