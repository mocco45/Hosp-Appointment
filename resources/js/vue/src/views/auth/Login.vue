<template>
<v-form v-model="valid">
    <v-container class="fill-height d-flex" style="min-height: 100vh;">
        <v-row class="justify-center align-center" style="width: 100%;">
            <v-col class="border-md bg-white" cols="3" style="height: 300px;">

            </v-col>
            <v-col class="border-md bg-white" cols="4" style="height: 300px;">
                <div class="text-h4 text-center">
                    LOGIN
                </div>
                <v-text-field label="Email" type="email" variant="underlined" prepend-icon="mdi-email" icon-color="indigo-lighten-1"></v-text-field>
                <v-text-field label="Password" type="password" variant="underlined" prepend-icon="mdi-lock" icon-color="indigo-darken-1"></v-text-field>
                <div class="d-flex justify-space-between">
                    <div>
                        <v-checkbox-btn color="primary">
                            <template #label>
                                <span class="text-caption text-black">Remember Me</span>
                            </template>
                        </v-checkbox-btn>
                    </div>
                    <div class="d-flex justify-center align-center">
                        <p class="text-caption">Don't have account?</p><a class="text-caption" href="/register">Register</a>
                    </div>
                </div>
                <div class="d-flex justify-center mt-2">
                    <v-btn class="bg-green-lighten-1" elevation="4" :loading="loading" @click="load" >login</v-btn>
                </div>
            </v-col>
        </v-row>
    </v-container>
</v-form>
</template>
<script setup>
  import { ref } from 'vue'

  const loading = ref(false)
  function load () {
    loading.value = true
    setTimeout(() => (loading.value = false), 3000)
  }
</script>