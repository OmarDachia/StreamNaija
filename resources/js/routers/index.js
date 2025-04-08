import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/views/Welcome.vue'
import About from '@/views/Dashboard.vue'
import Video from '@/views/Video.vue'

const routes = [
    { path: '/', name: 'Home', component: Home },
    { path: '/video', name: 'Video', component: Video },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router