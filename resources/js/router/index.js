import { createRouter, createWebHistory } from 'vue-router';
const router = [
    {
        path: '/',
        component: require('../components/Tutorial.vue').default
    },

    {
        path: '/my_proyects',
        component: require('../components/MyProyects.vue').default
    },
]


export default createRouter({
    history: createWebHistory('/'),
    routes: router
})