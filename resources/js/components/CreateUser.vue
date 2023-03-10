<template>
    <div v-if="getToken.type == 1">
        <template_setting :template_object="template_setting"></template_setting>   
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
import Axios from 'axios'
    import template_setting from './TemplateLoginSignup.vue'

export default {

    beforeCreate() {
        Axios.get('/token')
            .then((res) => {
                this.user = res.data;
            },
            (error) => {
                console.log(error.response.data);
            })
    },

    components: {template_setting},

    data() {
        return {
            template_setting: {
                user_rol: 'Rol de usuario',
                title: 'Crear usuario',
                user_name: 'Nombre de usuario:',
                input_email: 'Email:',
                first_password: 'Contraseña:',
                second_password: 'Confirma la contraseña:',
            },

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