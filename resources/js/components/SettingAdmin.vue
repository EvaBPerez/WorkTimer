<template>
    <div>
        <template_setting :template_object="template_setting"></template_setting>   
    </div>
</template>

<script>
    import template_setting from './TemplateLoginSingup.vue'

export default {
    components: {template_setting},
    props: ['id'],

    data() {
        return {
            template_setting: {
                data_user: this.id,
                user_rol: 'Rol de usuario',
                title: 'Editar usuario',
                user_name: 'Nombre de usuario:',
            }
        }
    }
}
</script>

<style>

</style>