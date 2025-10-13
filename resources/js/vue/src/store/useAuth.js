import { defineStore } from "pinia";
import apiClient from "../axios";

const useAuthStore = defineStore('auth', {
    state: () => ({
        isLoading: false,
        role: localStorage.getItem('role') ?? null,
        user: JSON.parse(localStorage.getItem('user')) ?? null,
    }),
    actions: {
        async login(credentials){
            const response = await apiClient.post('/login', credentials)
            const {access, role, user} = response.data
            localStorage.setItem('access', access)
            localStorage.setItem('role', role)
            localStorage.setItem('user', JSON.stringify({
                name: user.name,
                email: user.email,
            }))
            this.role = role
            this.user = {
                name: user.name,
                email: user.email,
            }
            
        },
        async register(data){
            await apiClient.post('/register', data)
        },
        async logout(){
            localStorage.clear('access')
            localStorage.clear('role')
            localStorage.clear('user')
            this.role = null
        }
    }
})

export default useAuthStore