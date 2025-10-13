<template>
  <v-container fluid class="py-6">
    <!-- 🧑‍⚕️ Welcome Header -->
    <v-row>
      <v-col>
        <h2 class="font-semibold text-xl mb-1">Welcome back, Dr. {{ doctor.name }}</h2>
        <p class="text-gray-500">Today is {{ today }}</p>
      </v-col>
    </v-row>

    <!-- 📊 Stats Cards -->
    <v-row class="my-4" dense>
      <v-col v-for="(card, i) in stats" :key="i" cols="12" sm="6" md="3">
        <v-card class="pa-4" elevation="2">
          <v-icon size="40" color="primary">{{ card.icon }}</v-icon>
          <h3 class="mt-2 text-lg font-semibold">{{ card.title }}</h3>
          <p class="text-2xl font-bold">{{ card.value }}</p>
        </v-card>
      </v-col>
    </v-row>

    <!-- 📅 Upcoming Appointments -->
    <v-row class="my-6">
      <v-col cols="12" md="8">
        <v-card elevation="3" class="pa-4">
          <h3 class="font-semibold mb-3">Upcoming Appointments</h3>
          <v-data-table
            :headers="headers"
            :items="appointments"
            density="comfortable"
            hide-default-footer
          >
            <template #item.status="{ item }">
              <v-chip
                :color="item.status === 'Pending' ? 'orange' : 'green'"
                size="small"
                variant="flat"
              >
                {{ item.status }}
              </v-chip>
            </template>
          </v-data-table>
        </v-card>
      </v-col>

      <!-- 🧠 Patient Condition Chart -->
      <v-col cols="12" md="4">
        <v-card elevation="3" class="pa-4 h-full">
          <h3 class="font-semibold mb-3">Patient Condition Summary</h3>
          <div style="height: 250px;">
            <PieChart :data="conditionData" />
          </div>
        </v-card>
      </v-col>
    </v-row>

    <!-- 💊 Recent Prescriptions -->
    <v-row>
      <v-col>
        <v-card elevation="3" class="pa-4">
          <h3 class="font-semibold mb-3">Recent Prescriptions</h3>
          <v-list>
            <v-list-item
              v-for="(rx, i) in prescriptions"
              :key="i"
              :title="rx.patient"
              :subtitle="`Medication: ${rx.medicine}`"
            >
              <template #append>
                <v-chip color="blue" size="small">{{ rx.date }}</v-chip>
              </template>
            </v-list-item>
          </v-list>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref } from 'vue'
import PieChart from '../../components/charts/PieChart.vue'

const doctor = ref({
  name: 'Emily Carter',
})

const today = new Date().toLocaleDateString('en-US', {
  weekday: 'long',
  year: 'numeric',
  month: 'long',
  day: 'numeric'
})

const stats = ref([
  { title: 'Total Patients', value: 84, icon: 'mdi-account-group' },
  { title: 'Today’s Appointments', value: 12, icon: 'mdi-calendar-check' },
  { title: 'Pending Results', value: 5, icon: 'mdi-flask-outline' },
  { title: 'Prescriptions', value: 8, icon: 'mdi-pill' },
])

const headers = [
  { title: 'Patient', key: 'name' },
  { title: 'Time', key: 'time' },
  { title: 'Department', key: 'department' },
  { title: 'Status', key: 'status' },
]

const appointments = ref([
  { name: 'John Doe', time: '09:00 AM', department: 'Cardiology', status: 'Pending' },
  { name: 'Mary Jane', time: '10:30 AM', department: 'Dermatology', status: 'Done' },
  { name: 'Samuel Kim', time: '11:00 AM', department: 'Neurology', status: 'Pending' },
])

const prescriptions = ref([
  { patient: 'John Doe', medicine: 'Amoxicillin 500mg', date: 'Oct 10' },
  { patient: 'Mary Jane', medicine: 'Vitamin D 1000 IU', date: 'Oct 11' },
  { patient: 'Samuel Kim', medicine: 'Paracetamol 500mg', date: 'Oct 12' },
])

const conditionData = [
  { role: 'Normal', count: 40 },
  { role: 'Critical', count: 10 },
  { role: 'Follow-up', count: 30 },
]
</script>
