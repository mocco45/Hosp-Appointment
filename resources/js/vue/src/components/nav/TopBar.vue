<template>
  <v-app-bar :elevation="2">
    <template v-slot:prepend>
      <v-app-bar-nav-icon></v-app-bar-nav-icon>
    </template>

    <v-app-bar-title>Application Bar</v-app-bar-title>

    <!-- ✅ move avatar directly here -->
    <v-spacer></v-spacer>

    <v-menu min-width="200px">
      <template v-slot:activator="{ props }">
        <v-btn icon v-bind="props">
          <v-avatar color="brown" size="large">
            <span class="text-h5">{{ user.initials }}</span>
          </v-avatar>
        </v-btn>
      </template>

      <v-card>
        <v-card-text>
          <div class="mx-auto text-center">
            <v-avatar color="brown">
              <span class="text-h5">{{ user.initials }}</span>
            </v-avatar>
            <h3>{{ user.fullName }}</h3>
            <p class="text-caption mt-1">
              {{ user.email }}
            </p>

            <v-divider class="my-3"></v-divider>
            <v-btn variant="text" rounded>
              Edit Account
            </v-btn>

            <v-divider class="my-3"></v-divider>
            <v-btn icon="mdi-logout" @click="handleLogout"></v-btn>
          </div>
        </v-card-text>
      </v-card>
    </v-menu>
  </v-app-bar>
</template>

<script setup>
import { computed } from 'vue';
import router from '../../router';
import useAuthStore from '../../store/useAuth';

const auth = useAuthStore()
const userData = computed(() => auth.user)
const nameParts = userData.value.name.trim().split(' ')
const initials = nameParts.length >= 2 ? nameParts[0][0] + nameParts[1][0] : nameParts[0][0]
const user = {
    initials: initials,
    fullName: userData.value.name,
    email: userData.value.email
}
const handleLogout = async () => {
    try{
        await auth.logout()
        router.push('/')
    }catch(error){
        console.error(error);
        alert(error.response?.data?.message)
        
    }
}


</script>