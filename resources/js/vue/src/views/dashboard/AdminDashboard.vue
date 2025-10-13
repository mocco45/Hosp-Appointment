<template>
  <v-container fluid class="pa-6 bg-grey-lighten-4">
    <!-- Header -->
    <h2 class="text-h5 font-weight-bold mb-6">
      🏥 Admin Dashboard
    </h2>

    <!-- Summary Cards -->
    <v-row dense>
      <v-col cols="12" md="3">
        <v-card class="pa-4" elevation="2">
          <v-icon color="primary" size="28">mdi-doctor</v-icon>
          <h3 class="text-h6 mt-2">Total Doctors</h3>
          <p class="text-h5 font-weight-bold">{{ stats.doctors }}</p>
        </v-card>
      </v-col>

      <v-col cols="12" md="3">
        <v-card class="pa-4" elevation="2">
          <v-icon color="success" size="28">mdi-nurse</v-icon>
          <h3 class="text-h6 mt-2">Total Nurses</h3>
          <p class="text-h5 font-weight-bold">{{ stats.nurses }}</p>
        </v-card>
      </v-col>

      <v-col cols="12" md="3">
        <v-card class="pa-4" elevation="2">
          <v-icon color="info" size="28">mdi-account-group</v-icon>
          <h3 class="text-h6 mt-2">Registered Patients</h3>
          <p class="text-h5 font-weight-bold">{{ stats.patients }}</p>
        </v-card>
      </v-col>

      <v-col cols="12" md="3">
        <v-card class="pa-4" elevation="2">
          <v-icon color="warning" size="28">mdi-calendar-check</v-icon>
          <h3 class="text-h6 mt-2">Appointments Today</h3>
          <p class="text-h5 font-weight-bold">{{ stats.appointments }}</p>
        </v-card>
      </v-col>
    </v-row>

    <!-- Charts Section -->
    <v-row class="mt-8" dense>
      <v-col cols="12" md="6">
        <v-card elevation="3" class="pa-4">
          <h3 class="text-h6 mb-2">Monthly Appointments</h3>
          <v-sheet height="300">
            <BarChart :data="chartData" />
          </v-sheet>
        </v-card>
      </v-col>

      <v-col cols="12" md="6">
        <v-card elevation="3" class="pa-4">
          <h3 class="text-h6 mb-2">System Users</h3>
          <v-sheet height="300">
            <PieChart :data="pieData" />
          </v-sheet>
        </v-card>
      </v-col>
    </v-row>

    <!-- User Management Table -->
    <v-card class="mt-8" elevation="3">
      <v-card-title class="text-h6 font-weight-bold">
        👥 Recent Users
      </v-card-title>

      <v-data-table
        :headers="headers"
        :items="users"
        class="elevation-1"
        density="comfortable"
      >
        <template v-slot:item.role="{ item }">
          <v-chip
            :color="getRoleColor(item.role)"
            size="small"
            label
          >
            {{ item.role }}
          </v-chip>
        </template>
      </v-data-table>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref } from 'vue'
import BarChart from '../../components/charts/BarChart.vue'
import PieChart from '../../components/charts/PieChart.vue'

// Dummy Stats
const stats = ref({
  doctors: 12,
  nurses: 20,
  patients: 240,
  appointments: 35,
})

// Chart Data (can later connect to API)
const chartData = ref([
  { month: 'Jan', appointments: 50 },
  { month: 'Feb', appointments: 70 },
  { month: 'Mar', appointments: 65 },
  { month: 'Apr', appointments: 90 },
  { month: 'May', appointments: 80 },
])

const pieData = ref([
  { role: 'Doctors', count: 12 },
  { role: 'Nurses', count: 20 },
  { role: 'Patients', count: 240 },
])

// Table Headers
const headers = [
  { title: 'Full Name', key: 'name' },
  { title: 'Email', key: 'email' },
  { title: 'Role', key: 'role' },
  { title: 'Joined', key: 'joined' },
]

// Dummy Users
const users = ref([
  { name: 'Dr. Grace Peter', email: 'grace@hospital.com', role: 'doctor', joined: '2025-10-01' },
  { name: 'Nurse John Doe', email: 'john@hospital.com', role: 'nurse', joined: '2025-09-25' },
  { name: 'Mary Jane', email: 'mary@hospital.com', role: 'patient', joined: '2025-09-30' },
])

// Role Color Mapping
const getRoleColor = (role) => {
  switch (role) {
    case 'doctor': return 'primary'
    case 'nurse': return 'success'
    case 'patient': return 'info'
    default: return 'grey'
  }
}
</script>

<style scoped>
.v-card {
  border-radius: 16px;
}
</style>
