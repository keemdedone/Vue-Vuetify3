<template>
  <v-container class="fill-height">
    <v-responsive class="d-flex align-start text-center fill-height mt-10">
      <div class="table-container" style="max-width: 800px; margin: auto">
        <div class="top text-right my-4">
          <v-btn
            class="menu-btn px-3 mx-0"
            variant="flat"
            min-width="28"
            color="warning"
            @click="onOpenDialog(1)"
          >
            <v-icon size="22" icon="mdi-account-plus"></v-icon>
          </v-btn>
        </div>
        <v-table class="t-border-custom">
          <thead>
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">Name</th>
              <th class="text-center">Level</th>
              <th class="text-center">Acive</th>
              <th class="text-center">Menu</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.name">
              <td>{{ user.id }}</td>
              <td>{{ user.name }}</td>
              <td>{{ user.level }}</td>
              <td>
                <v-btn
                  class="px-3"
                  variant="tonal"
                  min-width="28"
                  :border="true"
                  :color="user.active ? 'success' : 'error'"
                >
                  <v-icon
                    size="22"
                    :icon="
                      user.active
                        ? 'mdi-toggle-switch-off'
                        : 'mdi-toggle-switch-outline'
                    "
                  ></v-icon>
                </v-btn>
              </td>
              <td>
                <v-btn
                  variant="flat"
                  min-width="28"
                  class="menu-btn"
                  color="success"
                  @click="onOpenDialog(2)"
                >
                  <v-icon size="22" icon="mdi-magnify"></v-icon>
                </v-btn>
                <v-btn
                  variant="flat"
                  min-width="28"
                  class="menu-btn"
                  color="primary"
                  @click="onOpenDialog(3)"
                >
                  <v-icon size="22" icon="mdi-pencil"></v-icon>
                </v-btn>
                <v-btn
                  variant="flat"
                  min-width="28"
                  class="menu-btn"
                  color="error"
                  @click="onOpenDialog(4)"
                >
                  <v-icon size="22" icon="mdi-trash-can-outline"></v-icon>
                </v-btn>
              </td>
            </tr>
          </tbody>
        </v-table>
      </div>
    </v-responsive>
  </v-container>
  <UsersDialog :openDialog="showDialog" @close="onDialogClose" />
</template>

<script lang="ts">
import UsersDialog from "./UsersDialog.vue";

export default {
  components: {
    UsersDialog,
  },
  data() {
    let showDialog = false;
    return {
      showDialog,
      users: [
        {
          id: 1,
          name: "Admin",
          active: true,
          level: "5",
        },
        {
          id: 2,
          name: "User",
          active: false,
          level: "2",
        },
        {
          id: 3,
          name: "Visitor",
          active: true,
          level: "0",
        },
      ],
    };
  },
  methods: {
    onOpenDialog(id: number): any {
      this.showDialog = true;
    },
    onDialogClose(close: boolean) {
      this.showDialog = false;
    },
  },
};
</script>

<style scoped lang="scss">
.t-border-custom {
  border: thin solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 5px;
}
.menu-btn {
  padding: 0 12px;
  margin: auto 10px;

  &.v-theme--light {
    $green: rgba(76, 175, 80, 0.5);
    $blue: rgba(33, 150, 243, 0.5);
    $red: rgba(244, 67, 54, 0.5);
    $yellow: rgba(251, 141, 0, 0.5);
    &.bg-success {
      filter: drop-shadow(0 0 2px $green) drop-shadow(0 0 5px $green)
        drop-shadow(0 0 15px $green);
    }

    &.bg-primary {
      filter: drop-shadow(0 0 2px $blue) drop-shadow(0 0 5px $blue)
        drop-shadow(0 0 15px $blue);
    }

    &.bg-error {
      filter: drop-shadow(0 0 2px $red) drop-shadow(0 0 5px $red)
        drop-shadow(0 0 15px $red);
    }

    &.bg-warning {
      filter: drop-shadow(0 0 2px $yellow) drop-shadow(0 0 5px $yellow)
        drop-shadow(0 0 15px $yellow);
    }
  }

  &.v-theme--dark {
    $green: rgba(112, 255, 117, 0.3);
    $purple: rgba(187, 134, 243, 0.3);
    $red: rgba(244, 67, 54, 0.3);
    $yellow: rgba(251, 141, 0, 0.3);
    &.bg-success {
      filter: drop-shadow(0 0 2px $green) drop-shadow(0 0 5px $green)
        drop-shadow(0 0 15px $green);
    }

    &.bg-primary {
      filter: drop-shadow(0 0 2px $purple) drop-shadow(0 0 5px $purple)
        drop-shadow(0 0 15px $purple);
    }

    &.bg-error {
      filter: drop-shadow(0 0 2px $red) drop-shadow(0 0 5px $red)
        drop-shadow(0 0 15px $red);
    }

    &.bg-warning {
      filter: drop-shadow(0 0 2px $yellow) drop-shadow(0 0 5px $yellow)
        drop-shadow(0 0 15px $yellow);
    }
  }
}
</style>
