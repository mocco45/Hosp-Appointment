<template>
    <v-app>
        <TopBar/>
        <v-main class="ma-4">
            <router-view/>
        </v-main>
    </v-app>
</template>
<script setup>
import TopBar from '../components/nav/TopBar.vue';


</script>