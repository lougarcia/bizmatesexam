<template>
    <div>
        <div class="row" :class="{'hide': selected_city}">
            <div class="col col-6 mb-5" v-for="city in cities" :key="city.id">
                <CityComponent :city="city" v-on:select-city="setSelectedCity($event, city)"/>
            </div>
        </div>
        <div v-if="selected_city">
            <ViewCityComponent :city="selected_city" v-on:close-selected-city="selected_city=null" />
        </div>
    </div>
</template>

<script>
import CityComponent from './CityComponent';
import ViewCityComponent from './ViewCityComponent';

export default {
    name: 'home-component',
    components: {
        CityComponent,
        ViewCityComponent
    },
    data: function () {
        return {
            cities: [
                { id: 1, name: 'Tokyo', img: 'tokyo.jpg', country: 'jp'},
                { id: 2, name: 'Yokohama', img: 'yokohama.jpg', country: 'jp'},
                { id: 3, name: 'Kyoto', img: 'kyoto.jpg', country: 'jp'},
                { id: 4, name: 'Osaka', img: 'osaka.jpg', country: 'jp'},
                { id: 5, name: 'Sapporo', img: 'sapporo.jpg', country: 'jp'},
                { id: 6, name: 'Nagoya', img: 'nagoya.jpg', country: 'jp'},
            ],
            selected_city: false,
        };
    },
    mounted() {
        
    },
    created() {
        
    },
    methods: {
        setSelectedCity(data, city) {
            this.selected_city = {...city, ...data};
        }
    }
}
</script>

<style scoped>

.hide {
    display: none;
}

@media (min-width: 1px) and (max-width: 767px) {
    .col-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .mb-5 {
        margin-bottom: 1rem !important;
    }
}
</style>