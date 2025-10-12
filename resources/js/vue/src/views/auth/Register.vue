<template>
<v-form ref="form" v-model="valid" @submit.prevent="handleRegister">
    <v-container class="d-flex" style="min-height: 100vh">
        <v-row class="justify-center align-center" style="width: 100%">
            <v-col cols="12" sm="8" md="6" lg="5" class="border-md py-8 px-4">
                <div class="text-h4 text-center">
                    Register
                </div>
                <div class="d-flex flex-column align-center">
                    <v-text-field label="Full Name" :rules="nameRules" type="text" v-model="name" variant="underlined" prepend-icon="mdi-account" icon-color="indigo-lighten-1" style="width: 70%;" required></v-text-field>
                    <v-text-field label="Email" type="email" :rules="emailRules" v-model="email" variant="underlined" prepend-icon="mdi-email" icon-color="indigo-lighten-1" style="width: 70%;" required></v-text-field>
                    <v-text-field label="Phone" type="number" :rules="phoneRules" v-model="phone" variant="underlined" prepend-icon="mdi-phone" icon-color="indigo-lighten-1" style="width: 70%;" required></v-text-field>
                    <v-select label="Role" v-model="role" variant="underlined" :rules="roleRules" :items="['Doctor','Nurse','Patient']" prepend-icon="mdi-badge-account" icon-color="indigo-lighten-1" style="width: 70%;" required></v-select>
                    <v-combobox v-if="role == 'Doctor'" label="Speciality" placeholder="Select or Add new"  v-model="speciality" variant="underlined" :items="specialist" prepend-icon="mdi-badge-account" icon-color="indigo-lighten-1" style="width: 70%;" clearable></v-combobox>
                    <v-radio-group v-if="role == 'Patient'" label="Gender" style="width: 70%; " inline>
                        <v-radio density="compact" v-model="gender" value="male" color="indigo-darken-2">
                            <template #label>
                                <span class="text-caption text-black">Male</span>
                            </template>
                        </v-radio>
                        <v-radio density="compact" value="female" color="indigo-darken-2" class="ms-4">
                            <template #label>
                                <span class="text-caption text-black">Female</span>
                            </template>
                        </v-radio>
                    </v-radio-group>
                    <v-text-field label="Password" type="password" :rules="passwordRules" v-model="password" variant="underlined" prepend-icon="mdi-lock" icon-color="indigo-darken-1" style="width: 70%;"></v-text-field>
                    <v-text-field label="Confirm Password" type="password" :rules="passwordRules2" v-model="cpassword" variant="underlined" prepend-icon="mdi-lock" icon-color="indigo-darken-1" style="width: 70%;"></v-text-field>
                    <div class="d-flex flex-column align-center mt-2">
                        <v-btn class="bg-green-lighten-1" elevation="4" :loading="loading" type="submit">register</v-btn>
                        <div class="text-caption mt-2">
                            or already have account? <a href="/">login</a>
                        </div>
                    </div>
                </div>
            </v-col>
        </v-row>
    </v-container>
</v-form>
</template>
<script setup>
import { ref } from 'vue';
import useAuthStore from '../../store/useAuth';
import router from '../../router';

const name = ref('')
const email = ref('')
const role = ref('')
const phone = ref('')
const password = ref('')
const cpassword = ref('')
const speciality = ref('')
const gender = ref('')
const form = ref(null)
const valid = ref(false)
const loading = ref(false)
const nameRules = [
    value => !!value || 'Name is required',
    value => value.length <= 30 || 'Name must be atleast 30 characters'
]
const emailRules = [
value => !!value || 'Email is required',
value => /.+@.+\..+/.test(value) || 'invalid email',
]

const phoneRules = [
    v => !!v || 'Phone is required',
    v => /^\d{10,15}$/.test(v) || 'Phone must be 10–15 digits',
]

const passwordRules = [
  v => !!v || 'Password is required',
  v => v.length >= 6 || 'Password must be at least 6 characters',
]

const passwordRules2 = [
  v => v === password.value || 'Passwords do not match'
]

const roleRules = [
    v => !!v || 'Role selection is required'
]
const auth = useAuthStore()
const specialist = [
      "General Practitioner (GP)",
  "Dentist",
  "Cardiologist",
  "Dermatologist",
  "Neurologist",
  "Psychiatrist",
  "Pediatrician",
  "Gynecologist / Obstetrician",
  "Orthopedic Surgeon",
  "Ophthalmologist",
  "ENT Specialist (Ear, Nose & Throat)",
  "Urologist",
  "Endocrinologist",
  "Oncologist (Cancer Specialist)",
  "Pulmonologist (Lung Specialist)",
  "Nephrologist (Kidney Specialist)",
  "Gastroenterologist",
  "Hematologist (Blood Specialist)",
  "Rheumatologist",
  "Physiotherapist",
  "Radiologist",
  "Plastic Surgeon",
  "Anesthesiologist",
  "Allergist / Immunologist",
  "Infectious Disease Specialist",
  "Emergency Medicine Specialist",
  "Pathologist",
  "Ophthalmologist",
  "Neonatologist",
  "Family Medicine Doctor",
  "Sports Medicine Doctor",
  "Public Health Specialist",
  "Geriatrician (Elderly Care)",
  "Nutritionist / Dietitian",
  "Occupational Therapist",
  "Speech Therapist",
  "Podiatrist (Foot Specialist)"
]

const handleRegister = async () => {
    const { valid } = await form.value.validate()
    if(!valid) return
    loading.value = true
    const data = {
        'name' : name.value,
        'email' : email.value,
        'phone' : phone.value,
        'role' : role.value.toLocaleLowerCase(),
        'password' : password.value,
        'password_confirmation' : cpassword.value,
        
    }
    
    if(role.value == 'Doctor' && speciality.value){
        data.speciality = speciality.value
    }else if(role.value == 'Patient' && gender.value){
        data.gender = gender.value
    }
    
    try {
        await auth.register(data)
        router.push('/')
    } catch (error) {
        console.error(error);
        alert(error.response?.data?.message || "Registration Failed")
    }finally {
        loading.value = false
    }
}
</script>