<template>
    <div class="container_fluid_new">
        <div v-for="id in getIds" :homework="id">
            <homework :homework.sync="id"></homework>
        </div>
        </div>
</template>

<script>
import homework from './Homework.vue'
import Axios from 'axios';

export default {
    components: {homework},

    beforeCreate() {
        Axios.get(`/homeworks/${this.id}`)
            .then(res => {
                this.ids = res.data;
            },
            (error) => {
                console.log(error.response.data);
            })
    },

    props: ["id"],

    data() {
        return {
            ids: []
        }
    }, 

    computed: {
        getIds() {
            return this.ids;
        }
    }
}
</script>

<style>

</style>