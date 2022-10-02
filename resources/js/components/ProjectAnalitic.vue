<template>
    <div class="container">
        <div class="row">
            <div class="col-6" style="padding-top: 0.4rem;">
                <p class="my_title">Analítica: {{project.name}}</p>
            </div>

            <div class="col-6" style="text-align: right; padding-top: 0.4rem;">
                <router-link :to="{name: 'homeworks', params: {id: this.project.id}}"
                    class="btn_new add_button">
                    <span style="text-decoration: none; color: black;">Ver tareas</span>
                </router-link>
            </div>
        </div>
    </div>

        <template_project :project="this.project"></template_project>


</template>

<script>
    import Axios from 'axios';
    import template_project from './TemplateProjectAnalitic.vue';

export default {
    components: {template_project},

    props: ['id'],

    beforeCreate() {
        Axios.get(`/edit/${this.id}`)
            .then((res) => {
                this.project = (res.data[0])? res.data[0] : res.data;
            })
    },

    data() {
        return {
            project: []
        }
    }
}
</script>

<style>

</style>