<template>
    <span>{{formatted()}}</span>
</template>

<script>
import moment from 'moment';

export default {
    name: 'date-time-component',
    props: ['value', 'format'],
    methods: {
        formatted() {
            return moment(this.value).format(this.format);
        }
    }
}
</script>