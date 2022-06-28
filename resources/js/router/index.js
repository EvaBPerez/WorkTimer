import { createRouter, createWebHistory } from 'vue-router';
const router = [

    {
        path: '/my_proyects',
        component: require('../components/MyProyects.vue').default
    },

    {
        path: '/homeworks/:id',
        name: 'homeworks',
        props: true,
        component: require('../components/MyHomeworks.vue').default
    },

    {
        path: '/proyect_analitic/:id',
        name: 'proyect_analitic',
        props: true,
        component: require('../components/ProyectAnalitic.vue').default
    },

    {
        path: '/footer',
        component: require('../components/Footer.vue').default
    },

    {
        path: '/login',
        component: require('../components/Login.vue').default
    },

    {
        path: '/singup',
        component: require('../components/Singup.vue').default
    },

    {
        path: '/setting',
        component: require('../components/Setting.vue').default
    },

    {
        path: '/delete/:ids',
        name: 'delete',
        props: true,
        component: require('../components/Delete.vue').default
    },

    {
        path: '/template_object/:template_object',
        name: 'template_object',
        props: true,
        component: require('../components/TemplateLoginSingup.vue').default
    },

    {
        path: '/edit_proyect/:ids',
        name: 'edit_proyect',
        props: true,
        component: require('../components/Edit.vue').default
    },

    {
        path: '/',
        component: require('../components/Tutorial.vue').default
    }
]


export default createRouter({
    history: createWebHistory('/'),
    routes: router
})