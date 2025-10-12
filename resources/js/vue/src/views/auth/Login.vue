<template>
<v-form ref="form" v-model="valid" @submit.prevent="handleLogin">
    <v-container class="fill-height d-flex" style="min-height: 100vh;">
        <v-row class="justify-center align-center" style="width: 100%;">
            <v-col class="border-md bg-white" cols="3" style="height: 300px;">

            </v-col>
            <v-col class="border-md bg-white" cols="4" style="height: 300px;">
                <div class="text-h4 text-center">
                    LOGIN
                </div>
                <v-text-field label="Email" type="email" variant="underlined" :rules="emailRules" v-model="email" prepend-icon="mdi-email" icon-color="indigo-lighten-1"></v-text-field>
                <v-text-field label="Password" type="password" variant="underlined" :rules="passwordRules" v-model="password" prepend-icon="mdi-lock" icon-color="indigo-darken-1"></v-text-field>
                <div class="d-flex justify-space-between">
                    <div>
                        <v-checkbox-btn color="primary">
                            <template #label>
                                <span class="text-caption text-black">Remember Me</span>
                            </template>
                        </v-checkbox-btn>
                    </div>
                    <div class="d-flex justify-center align-center">
                        <p class="text-caption">Don't have account?</p><a class="text-caption" href="/register">Register</a>
                    </div>
                </div>
                <div class="d-flex justify-center mt-2">
                    <v-btn class="bg-green-lighten-1" elevation="4" :loading="loading" type="submit" >login</v-btn>
                </div>
            </v-col>
        </v-row>
    </v-container>
</v-form>
</template>
<script setup>
import { ref } from 'vue'
import useAuthStore from '../../store/useAuth'
import router from '../../router'
import { storeToRefs } from 'pinia'

const valid = ref(false)
const form = ref(null)
const loading = ref(false)
const email = ref('')
const password = ref('')
const emailRules = [
    v => !!v || 'Email is required',
    v => /.+@.+\..+/.test(v) || 'Email must be valid'
]

const passwordRules = [
    v => !!v || 'Password is required',
    v => v.length >= 6 || 'Password must be atleast 6 characters' 
]

const auth = useAuthStore()

const handleLogin = async () => {
    const {valid} = await form.value.validate()
    if(!valid) return
    loading.value = true
    const data = {
        'email' : email.value,
        'password' : password.value
    }
    
    try {
        await auth.login(data)
        const {role} = storeToRefs(auth)
        
        switch (role.value) {
            case 'doctor':
                
                router.push({name: 'doctor.dashboard'})
                break;
                
            case 'admin':
                router.push('/admin')
                break;
            
            case 'nurse':
                router.push('/nurse/dashboard')
                break;
                
                case 'patient':
                    router.push('/patient/dashboard')
                    break;
                    
                }
            } catch (error) {
                console.error(error);
                alert(error.response?.data?.message || "Login Failed")
            }finally{
                loading.value = false
            }
        }
</script>