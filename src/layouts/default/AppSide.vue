<template>
  <div class="container">
    <v-card>
      <v-layout>
        <v-main style="min-height: 100vh; user-select: none">
          <v-navigation-drawer>
            <v-list nav mandatory>
              <v-list-item
                min-height="36"
                color="primary"
                prepend-icon="mdi-home"
                value="home"
                :active="currentRoute == 'home'"
                @click="navigate('home')"
              >
                <span class="text-uppercase text-body-2">Home</span>
              </v-list-item>
              <v-list-item
                min-height="36"
                color="red"
                prepend-icon="mdi-calendar"
                value="calendar"
                :active="currentRoute == 'calendar'"
                @click="navigate('calendar')"
              >
                <span class="text-uppercase text-body-2">Calendar</span>
              </v-list-item>
              <v-list-item
                min-height="36"
                color="orange-darken-2"
                prepend-icon="mdi-account"
                value="users"
                :active="currentRoute == 'users'"
                @click="navigate('users')"
              >
                <span class="text-uppercase text-body-2">Users</span>
              </v-list-item>
            </v-list>
          </v-navigation-drawer>
        </v-main>
      </v-layout>
    </v-card>
  </div>
</template>

<script lang="ts">
export default {
  data() {
    return {
      currentRoute: "home",
    };
  },
  methods: {
    navigate(route: string) {
      this.$router.push({ path: `/${route}` });
      this.currentRoute = route;
    },
  },
  mounted() {
    if (this.$route.name) {
      this.currentRoute = String(this.$route.name).toLowerCase();
    } else {
      this.currentRoute = "home";
    }
  },
  watch: {
    $route(to) {
      this.currentRoute = to.name.toLowerCase();
    },
  },
  emits: ["update:isSidebarOpen"],
};
</script>

<style lang="scss" scoped>
.letter-spacing {
  letter-spacing: 2px;
}

.container {
  position: absolute;
  width: 200px;
  top: 64px;
  left: 0;
  z-index: 2;
  overflow: hidden;
  transition: width 0.5s ease;
}

@media screen and (max-width: 1280px) {
  .container {
    width: 0;

    &.open {
      width: 200px;
    }
  }
}
</style>
