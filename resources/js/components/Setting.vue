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
                title: 'Mis datos',
                user_name: 'Nombre de usuario:',
                input_email: 'Email:',
                old_password: 'Antigua contraseña:',
                first_password: 'Nueva contraseña:',
                second_password: 'Confirma la contraseña:',
                first_subtext: '¿Deseas eliminar tu cuenta?',
                second_subtext: 'Haz clic aquí'
            }
        }
    }
}
</script>

<style>

</style>