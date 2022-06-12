<template>
    
    <template_singup :template_object="template_singup"></template_singup>

</template>

<script>
    import template_singup from './TemplateLoginSingup.vue'

export default {
    components: {template_singup},

    data() {
        return {
            template_singup: {
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