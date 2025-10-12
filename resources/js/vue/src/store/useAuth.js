import { defineStore } from "pinia";
import apiClient from "../axios";

const useAuthStore = defineStore('auth', {
    state: () => ({
        isLoading: false,
        role: localStorage.getItem('role') ?? null,
    }),
    actions: {
        async login(credentials){
            const response = await apiClient.post('/login', credentials)
            const {access, role} = response.data
            localStorage.setItem('access', access)
            localStorage.setItem('role', role)
            this.role = role
            
        },
        async register(data){
            await apiClient.post('/register', data)
        },
        async logout(){
            localStorage.clear('access')
            localStorage.clear('role')
            this.role = null
        }
    }
})

export default useAuthStore