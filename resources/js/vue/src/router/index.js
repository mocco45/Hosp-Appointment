import { createRouter, createWebHistory } from "vue-router"
import AdminLayout from "../layout/AdminLayout.vue"
import MainLayout from "../layout/MainLayout.vue"

const routes = [
    {
        path: '/',
        component: () => import('../views/auth/Login.vue')
    },
    {
        path: '/register',
        component: () => import('../views/auth/Register.vue')
    },
    {
        path: "/admin",
        component: AdminLayout,
        meta: {requiresAuth: true, role: 'admin'},
        children: [
            {
                path: 'dashboard',
                component: () => import('../views/dashboard/AdminDashboard.vue')
            }
        ]
    },
    {
        path: "/doctor",
        component: MainLayout,
        meta: {requiresAuth: true, role: 'doctor'},
        children: [
            {
                path: 'dashboard',
                name: 'doctor.dashboard',
                component: () => import('../views/dashboard/DoctorDashboard.vue')
            }
        ]
    },
    {
        path: "/nurse",
        component: MainLayout,
        meta: {requiresAuth: true, role: 'nurse'},
        children: [
            {
                path: 'dashboard',
                component: () => import('../views/dashboard/NurseDashboard.vue')
            }
        ]
    },
    {
        path: "/patient",
        component: MainLayout,
        meta: {requiresAuth: true, role: 'patient'},
        children: [
            {
                path: 'dashboard',
                component: () => import('../views/dashboard/PatientDashboard.vue')
            }
        ]
    }
]

const router = createRouter({
    routes: routes,
    history: createWebHistory()
})

router.beforeEach((to,from,next) => {

    const token = localStorage.getItem('access')
    const role = localStorage.getItem('role')
    
    if(to.meta.requiresAuth && !token){
        next('/')
    }
    else if(to.meta.role && to.meta.role !== role){
        next('/unauthorized')
    }else{
        next()
    }

})

export default router