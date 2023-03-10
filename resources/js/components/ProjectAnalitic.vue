<template>
    <div v-if="getToken.length != 0">
    
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
    
    </div>
    
    <div v-else>
        <h4 class="privilege_error">
            <samp><i class="bi bi-exclamation-triangle" style="color: #ff0000;"></i></samp>
            Parece ser que no tiene los privilegios necesarios para acceder.
            <samp><i class="bi bi-exclamation-triangle" style="color: #ff0000;"></i></samp>
        </h4>
    </div>

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
            
        Axios.get('/token')
            .then((res) => {
                this.user = res.data;
            },
            (error) => {
                console.log(error.response.data);
            })
    },

    data() {
        return {
            project: [],
            user: []
        }
    },

    computed: {
        getToken() {
            return (this.user[0])? this.user[0]: this.user;
        }
    }
}
</script>

<style>

</style>