<template>
    <v-app-bar :elevation="2">
        <template v-slot:prepend>
            <v-app-bar-nav-icon></v-app-bar-nav-icon>
        </template>

        <v-app-bar-title>Application Bar</v-app-bar-title>
        <template>
            <v-container
                style="height: 300px"
                fluid
            >
                <v-row justify="center">
                <v-menu min-width="200px">
                    <template v-slot:activator="{ props }">
                    <v-btn
                        icon
                        v-bind="props"
                    >
                        <v-avatar
                        color="brown"
                        size="large"
                        >
                        <span class="text-h5">{{ user.initials }}</span>
                        </v-avatar>
                    </v-btn>
                    </template>
                    <v-card>
                    <v-card-text>
                        <div class="mx-auto text-center">
                        <v-avatar
                            color="brown"
                        >
                            <span class="text-h5">{{ user.initials }}</span>
                        </v-avatar>
                        <h3>{{ user.fullName }}</h3>
                        <p class="text-caption mt-1">
                            {{ user.email }}
                        </p>
                        <v-divider class="my-3"></v-divider>
                        <v-btn
                            variant="text"
                            rounded
                        >
                            Edit Account
                        </v-btn>
                        <v-divider class="my-3"></v-divider>
                        <v-btn
                            variant="text"
                            rounded
                        >
                            Disconnect
                        </v-btn>
                        </div>
                    </v-card-text>
                    </v-card>
                </v-menu>
                </v-row>
            </v-container>
        </template>
        <template v-slot:append>
          <v-btn icon="mdi-logout" @click="handleLogout"></v-btn>
          <span>logout</span>
        </template>
    </v-app-bar>
</template>
<script setup>
import router from '../../router';
import useAuthStore from '../../store/useAuth';

const auth = useAuthStore()
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