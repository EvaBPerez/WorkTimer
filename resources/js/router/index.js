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
        path: '/footer',
        component: require('../components/Footer.vue').default
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