import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/views/Welcome.vue'
import About from '@/views/Dashboard.vue'

const routes = [
    { path: '/', name: 'Welcome', component: Home },
    { path: '/dashboard', name: 'Dashboard', component: About },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router