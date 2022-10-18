<template>
    <div v-if="getToken.length != 0">
        <div class="container">
            <div class="row">
                <div class="col-6" style="padding-top: 0.4rem;">
                    <p class="my_title">Analítica: {{homework.name}}</p>
                </div>
            </div>
        </div>
        
        <template_homework :homework="this.homework"></template_homework>

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
    import template_homework from './TemplateHomeworkAnalitic.vue';

export default {
    components: {template_homework},

    props: ['id'],

    beforeCreate() {
        Axios.get(`/edit_h/${this.id}`)
            .then((res) => {
                this.homework = (res.data[0])? res.data[0] : res.data;
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
            homework: [],
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