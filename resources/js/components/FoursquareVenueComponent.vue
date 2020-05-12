<template>
    <div>
        <h4 class="title">{{venue.name}}</h4>
        <div class="address">{{venue.location.formattedAddress.join(', ')}}</div>
        <div class="photos row" v-if="photos.length">
            <img class="col-3" width="100%" v-for="photo in photos" :key="photo.id" :src="photo.prefix + photo.suffix" />
        </div>
    </div>
</template>

<script>
import Axios from 'axios';

export default {
    name: 'foursquare-venue-component',
    props: ['venue'],
    data() {
        return {
            photos: [],
        };
    },
    created() {
        Axios.get(`/foursquare/photos/${this.venue.id}`)
            .then((response) => {
                console.log(response.data);
                if (response.data.meta.code == 200) {
                    this.photos = response.data.response.photos.items;
                }
            });
    },
    methods: {
    },
}
</script>

<style scoped>

</style>