<template>
  <ResponsiveContainer width="100%" height="100%">
    <BarChart :data="data">
      <CartesianGrid strokeDasharray="3 3" />
      <XAxis dataKey="month" />
      <YAxis />
      <Tooltip />
      <Legend />
      <Bar dataKey="appointments" name="Appointments" fill="#1976d2" radius="[8,8,0,0]" />
    </BarChart>
  </ResponsiveContainer>
</template>

<script setup>
import { defineProps } from 'vue'
import { BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from 'recharts'

defineProps({
  data: {
    type: Array,
    required: true
  }
})
</script>
