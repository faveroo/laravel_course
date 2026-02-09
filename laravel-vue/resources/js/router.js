import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/test',
        component: () => import('./Pages/TestRoute.vue')
    },
    {
        path: '/',
        component: () => import('./Pages/HomeRoute.vue')
    }
];

export default createRouter({
    history: createWebHistory(),
    routes,
})