<template>
    <div class="container">
        <div class="row">
            <div class="col-6" style="padding-top: 0.4rem;">
                <p class="my_title">Analítica: {{proyect.name}}</p>
            </div>

            <div class="col-6" style="text-align: right; padding-top: 0.4rem;">
                <router-link :to="{name: 'homeworks', params: {id: this.proyect.id}}"
                    class="btn_new add_button">
                    <span style="text-decoration: none; color: black;">Ver tareas</span>
                </router-link>
            </div>
        </div>
    </div>

        <template_proyect :proyect="this.proyect"></template_proyect>


</template>

<script>
    import Axios from 'axios';
    import template_proyect from './TemplateProyectAnalitic.vue';

export default {
    components: {template_proyect},

    props: ['id'],

    beforeCreate() {
        Axios.get(`/edit/${this.id}`)
            .then((res) => {
                this.proyect = (res.data[0])? res.data[0] : res.data;
            })
    },

    data() {
        return {
            proyect: []
        }
    }
}
</script>

<style>

</style>