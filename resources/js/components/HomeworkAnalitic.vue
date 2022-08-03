<template>
    <div class="container">
        <div class="row">
            <div class="col-6" style="padding-top: 0.4rem;">
                <p class="my_title">Analítica: {{homework.name}}</p>
            </div>
        </div>
    </div>
    
    <template_homework :homework="this.homework"></template_homework>

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
    },

    data() {
        return {
            homework: []
        }
    },
}
</script>

<style>

</style>