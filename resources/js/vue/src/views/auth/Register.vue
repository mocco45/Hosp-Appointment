<template>
<v-form>
    <v-container class="d-flex" style="min-height: 100vh">
        <v-row class="justify-center align-center" style="width: 100%">
            <v-col cols="12" sm="8" md="6" lg="5" class="border-md py-8 px-4">
                <div class="text-h4 text-center">
                    Register
                </div>
                <div class="d-flex flex-column align-center">
                    <v-text-field label="Full Name" type="text" v-model="name" variant="underlined" prepend-icon="mdi-account" icon-color="indigo-lighten-1" style="width: 70%;"></v-text-field>
                    <v-text-field label="Email" type="email" v-model="email" variant="underlined" prepend-icon="mdi-email" icon-color="indigo-lighten-1" style="width: 70%;"></v-text-field>
                    <v-text-field label="Phone" type="number" v-model="phone" variant="underlined" prepend-icon="mdi-phone" icon-color="indigo-lighten-1" style="width: 70%;"></v-text-field>
                    <v-select label="Role" v-model="role" variant="underlined" :items="['Doctor','Nurse','Patient']" prepend-icon="mdi-badge-account" icon-color="indigo-lighten-1" style="width: 70%;"></v-select>
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
                    <v-text-field label="Password" type="password" v-model="password" variant="underlined" prepend-icon="mdi-lock" icon-color="indigo-darken-1" style="width: 70%;"></v-text-field>
                    <v-text-field label="Confirm Password" type="password" v-model="cpassword" variant="underlined" prepend-icon="mdi-lock" icon-color="indigo-darken-1" style="width: 70%;"></v-text-field>
                    <div class="d-flex flex-column align-center mt-2">
                        <v-btn class="bg-green-lighten-1" elevation="4" :loading="loading" @click="load" >register</v-btn>
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

const name = ref('')
const email = ref('')
const role = ref('')
const phone = ref('')
const password = ref('')
const speciality = ref('')
const gender = ref('')
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

</script>