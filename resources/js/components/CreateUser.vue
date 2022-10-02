<template>
    <div>
        <template_setting :template_object="template_setting"></template_setting>   
    </div>
</template>

<script>
    import template_setting from './TemplateLoginSignup.vue'

export default {
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
            }
        }
    }
}
</script>

<style>

</style>