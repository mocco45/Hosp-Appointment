<template>
  <v-container fluid class="py-6">
    <!-- 👋 Welcome -->
    <v-row>
      <v-col>
        <h2 class="font-semibold text-xl mb-1">Welcome, {{ patient.name }}</h2>
        <p class="text-gray-500">Your Health Overview</p>
      </v-col>
    </v-row>

    <!-- 🧾 Stats -->
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
          <h3 class="font-semibold mb-3">Your Upcoming Appointments</h3>
          <v-data-table
            :headers="headers"
            :items="appointments"
            density="comfortable"
            hide-default-footer
          >
            <template #item.status="{ item }">
              <v-chip
                :color="item.status === 'Confirmed' ? 'green' : 'orange'"
                size="small"
                variant="flat"
              >
                {{ item.status }}
              </v-chip>
            </template>
          </v-data-table>
        </v-card>
      </v-col>

      <!-- 🫀 Health Progress -->
      <v-col cols="12" md="4">
        <v-card elevation="3" class="pa-4 h-full">
          <h3 class="font-semibold mb-3">Health Summary</h3>
          <div style="height: 250px;">
            <PieChart :data="conditionData" />
          </div>
        </v-card>
      </v-col>
    </v-row>

    <!-- 💊 Prescriptions -->
    <v-row>
      <v-col>
        <v-card elevation="3" class="pa-4">
          <h3 class="font-semibold mb-3">Recent Prescriptions</h3>
          <v-list>
            <v-list-item
              v-for="(rx, i) in prescriptions"
              :key="i"
              :title="rx.medicine"
              :subtitle="rx.instructions"
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

const patient = ref({
  name: 'Michael Kim',
})

const stats = ref([
  { title: 'Appointments', value: 3, icon: 'mdi-calendar' },
  { title: 'Prescriptions', value: 5, icon: 'mdi-pill' },
  { title: 'Tests Done', value: 12, icon: 'mdi-flask-outline' },
  { title: 'Doctors Seen', value: 4, icon: 'mdi-account-heart' },
])

const headers = [
  { title: 'Doctor', key: 'doctor' },
  { title: 'Date', key: 'date' },
  { title: 'Time', key: 'time' },
  { title: 'Status', key: 'status' },
]

const appointments = ref([
  { doctor: 'Dr. Emily Carter', date: 'Oct 15', time: '10:00 AM', status: 'Confirmed' },
  { doctor: 'Dr. Smith', date: 'Oct 18', time: '02:00 PM', status: 'Pending' },
])

const prescriptions = ref([
  { medicine: 'Ibuprofen 200mg', instructions: '1 tablet after meals', date: 'Oct 12' },
  { medicine: 'Cough Syrup', instructions: '10ml twice daily', date: 'Oct 10' },
])

const conditionData = [
  { role: 'Normal', count: 60 },
  { role: 'Follow-up', count: 25 },
  { role: 'Critical', count: 15 },
]
</script>
