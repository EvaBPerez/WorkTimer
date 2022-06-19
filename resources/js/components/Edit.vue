<template>
    <div>
        <template_edit :template_object="template_edit"></template_edit>
    </div>
</template>

<script>
    import template_edit from './TemplateLoginSingup.vue'

export default {
    components: {template_edit},

    props: ['ids'],

    data() {
        return {
            template_edit: {
                title: 'Editar proyecto',
                proyect_name: 'Nombre del proyecto: ',
                color_name: 'Color de la tarjeta: ',
                id: this.ids
            }
        }
    }
}
</script>

<style>

</style>