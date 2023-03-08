<template>
  <div :class="isOpen ? 'container' : 'container open'">
    <v-card>
      <v-layout>
        <v-main style="min-height: 100vh; user-select: none">
          <v-navigation-drawer :rail="isOpen" width="200">
            <v-list nav mandatory>
              <v-list-item
                min-height="36"
                color="primary"
                title="Home"
                value="home"
                :prepend-icon="
                  currentRoute == 'home' ? 'mdi-home' : 'mdi-home-outline'
                "
                :active="currentRoute == 'home'"
                @click="navigate('home')"
              >
              </v-list-item>
              <v-list-item
                min-height="36"
                color="red"
                title="Calendar"
                value="calendar"
                :prepend-icon="
                  currentRoute == 'calendar'
                    ? 'mdi-calendar-blank'
                    : 'mdi-calendar-blank-outline'
                "
                :active="currentRoute == 'calendar'"
                @click="navigate('calendar')"
              >
              </v-list-item>
              <v-list-item
                min-height="36"
                color="orange-darken-2"
                title="Users"
                value="users"
                :prepend-icon="
                  currentRoute == 'users'
                    ? 'mdi-account'
                    : 'mdi-account-outline'
                "
                :active="currentRoute == 'users'"
                @click="navigate('users')"
              >
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
  props: {
    isOpen: Boolean,
  },
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
  // width: 200px;
  top: 64px;
  left: 0;
  z-index: 2;
  overflow: hidden;
  transition: width 0.5s ease;
}

@media screen and (max-width: 1280px) {
  // .container {
  //   width: 0;

  //   &.open {
  //     width: 200px;
  //   }
  // }
}
</style>
