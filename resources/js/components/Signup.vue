<template>
    
    <template_signup :template_object="template_signup"></template_signup>

</template>

<script>
    import template_signup from './TemplateLoginSignup.vue'

export default {
    components: {template_signup},

    data() {
        return {
            template_signup: {
                title: 'Registrarse',
                user_name: 'Nombre de usuario:',
                input_email: 'Email:',
                first_password: 'Contraseña:',
                second_password: 'Confirma la contraseña:',
                first_subtext: '¿Ya tienes cuenta?',
                second_subtext: 'Inicia sesión aquí'
            }
        }
    }

}
</script>

<style>

</style>