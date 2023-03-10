<template>

    <template_login :template_object="template_login"></template_login>

</template>

<script>
    import template_login from './TemplateLoginSignup.vue';

export default {
    components: {template_login},

    data() {
        return {
            template_login: {
                title: 'Iniciar sesión',
                email_enter: 'Email:',
                first_password: 'Contraseña:', 
                first_subtext: '¿No estás registrado?',
                second_subtext: 'Regístrate aquí'
                }
        }
    }

}
</script>

<style>

</style>