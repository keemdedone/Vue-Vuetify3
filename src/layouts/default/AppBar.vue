<template>
  <v-app-bar>
    <v-app-bar-title>
      <router-link to="home" class="text-decoration-none text-primary">
        <h1 class="ms-6">Vision</h1>
      </router-link>
    </v-app-bar-title>
    <template v-slot:append>
      <v-btn icon="mdi-white-balance-sunny" @click="toggleTheme"></v-btn>
      <v-btn icon="mdi-magnify"></v-btn>
      <v-btn icon="mdi-account"></v-btn>
    </template>
  </v-app-bar>
</template>

<script lang="ts">
import { useTheme } from "vuetify";

export default {
  setup() {
    const theme = useTheme();
    return {
      theme,
      toggleTheme: () => {
        theme.global.name.value = theme.global.current.value.dark
          ? "light"
          : "dark";
      },
    };
  },
};
</script>
