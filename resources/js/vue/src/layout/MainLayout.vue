<template>
  <v-app>
    <div class="d-flex flex-column">
      <TopBar />
      <router-view />
    </div>
  </v-app>
</template>

<script setup>
import TopBar from '../components/nav/TopBar.vue';


</script>