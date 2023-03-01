<template>
  <div class="container open">
    <v-card>
      <v-layout>
        <v-main style="min-height: 100vh; user-select: none">
          <v-navigation-drawer>
            <v-list nav mandatory>
              <v-list-item
                color="primary"
                prepend-icon="mdi-home"
                value="home"
                :active="currentRoute == 'home'"
                @click="navigate('home')"
              >
                <span class="text-body-2">Home</span>
              </v-list-item>
              <v-list-item
                color="red"
                prepend-icon="mdi-calendar"
                value="calendar"
                :active="currentRoute == 'calendar'"
                @click="navigate('calendar')"
              >
                <span class="text-body-2">Calendar</span>
              </v-list-item>
              <v-list-item
                color="orange-darken-2"
                prepend-icon="mdi-account"
                value="users"
                :active="currentRoute == 'users'"
                @click="navigate('users')"
              >
                <span class="text-body-2">Users</span>
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
  watch: {
    $route(to) {
      this.currentRoute = to.name.toLowerCase();
    },
  },
};
</script>

<style lang="scss">
.container {
  position: absolute;
  width: 180px;
  top: 64px;
  left: 0;
  z-index: 2;
  overflow: hidden;
  transition: width 0.5s ease;
}
</style>
