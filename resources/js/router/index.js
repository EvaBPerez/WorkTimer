import { createRouter, createWebHistory } from 'vue-router';
const router = [

    {
        path: '/my_projects',
        component: require('../components/MyProjects.vue').default
    },

    {
        path: '/homeworks/:id',
        name: 'homeworks',
        props: true,
        component: require('../components/MyHomeworks.vue').default
    },

    {
        path: '/history',
        component: require('../components/History.vue').default
    },

    {
        path: '/users_list',
        component: require('../components/UsersList.vue').default
    },

    {
        path: '/create_user',
        component: require('../components/CreateUser.vue').default
    },

    {
        path: '/project_analitic/:id',
        name: 'project_analitic',
        props: true,
        component: require('../components/ProjectAnalitic.vue').default
    },

    {
        path: '/homework_analitic/:id',
        name: 'homework_analitic',
        props: true,
        component: require('../components/HomeworkAnalitic.vue').default
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
        path: '/signup',
        component: require('../components/Signup.vue').default
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
        component: require('../components/TemplateLoginSignup.vue').default
    },

    {
        path: '/edit_project/:ids',
        name: 'edit_project',
        props: true,
        component: require('../components/EditProject.vue').default
    },

    {
        path: '/edit_user_admin/:id',
        name: 'edit_user_admin',
        props: true,
        component: require('../components/SettingAdmin.vue').default
    },

    {
        path: '/edit_homework/:ids',
        name: 'edit_homework',
        props: true,
        component: require('../components/EditHomework.vue').default
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