<template>
  <v-app-bar>
    <v-btn
      icon="mdi-menu"
      size="48"
      class="menu-open"
      @click="toggleSidebar"
    ></v-btn>
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
import { ref } from "vue";

export default {
  setup(props, { emit }) {
    const theme = useTheme();
    const isSidebarOpen = ref(false);

    const toggleSidebar = () => {
      isSidebarOpen.value = !isSidebarOpen.value;
      emit("toggle-sidebar", isSidebarOpen.value);
    };
    return {
      theme,
      isSidebarOpen,
      toggleSidebar,
      toggleTheme: () => {
        theme.global.name.value = theme.global.current.value.dark
          ? "light"
          : "dark";
      },
    };
  },
};
</script>

<style lang="scss" scoped>
.menu-open {
  display: none;
}

@media screen and (max-width: 1280px) {
  .menu-open {
    display: block;
  }
}
</style>
