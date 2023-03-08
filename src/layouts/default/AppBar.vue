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
      <v-menu>
        <template v-slot:activator="{ props }">
          <v-btn icon="mdi-account" v-bind="props"></v-btn>
        </template>
        <v-list class="pa-0 my-2">
          <v-list-item
            v-for="(item, index) in menuItems"
            :key="index"
            :value="index"
            :title="item.title"
            @click="navigate(item.code)"
          >
          </v-list-item>
        </v-list>
      </v-menu>
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

    const menuItems = [
      { title: "Setting", code: 1 },
      { title: "Infomation", code: 2 },
      { title: "Logout", code: 3 },
    ];

    return {
      isSidebarOpen,
      menuItems,
      theme,
      toggleSidebar,
      toggleTheme: () => {
        theme.global.name.value = theme.global.current.value.dark
          ? "light"
          : "dark";
      },
    };
  },
  methods: {
    navigate(action: number) {
      switch (action) {
        case 1:
          console.log("Action " + 1);
          break;
        case 2:
          console.log("Action " + 2);
          break;
        case 3:
          console.log("Action " + 3);
          localStorage.removeItem("VueisLogin");
          setTimeout(() => {
            location.reload();
          }, 1000);
          break;
        default:
          break;
      }
    },
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
