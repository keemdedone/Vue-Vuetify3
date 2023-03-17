<template>
  <v-app>
    <div class="content" v-if="true">
      <AppBar v-on:toggle-sidebar="handleToggleSidebar" />
      <Side :isOpen="isSidebarOpen" />
      <View class="limit-width" />
    </div>
    <div class="auth" v-if="false">
      <Auth v-on:login="handleLoginEvent" />
    </div>
  </v-app>
</template>

<script lang="ts" setup>
import AppBar from "./AppBar.vue";
import View from "./View.vue";
import Side from "./AppSide.vue";
import Auth from "./Auth.vue";
import { ref } from "vue";

const stillLogin = localStorage.getItem("VueisLogin");
const isLogin = stillLogin === "yes" ? ref(true) : ref(false);
const isSidebarOpen = ref(false);

const handleToggleSidebar = (isOpen: boolean) => {
  isSidebarOpen.value = isOpen;
};

const handleLoginEvent = (value: boolean) => {
  if (value === true) {
    localStorage.setItem("VueisLogin", "yes");
    isLogin.value = value;
  }
};
</script>

<style lang="scss">
.limit-width {
  max-width: calc(100% - 200px);
  width: 100%;
  margin-left: auto;
}

@media screen and (max-width: 1280px) {
  .limit-width {
    max-width: 100%;
    margin: auto;
  }
}
</style>
