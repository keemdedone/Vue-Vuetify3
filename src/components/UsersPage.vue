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
            <tr v-for="(user, index) in users" :key="index">
              <td>{{ user.uID }}</td>
              <td>{{ user.uUserName }}</td>
              <td>{{ user.uLevel }}</td>
              <td>
                <v-btn
                  class="px-3"
                  variant="tonal"
                  min-width="28"
                  :color="
                    user.uActive !== 0 ? 'green-lighten-1' : 'red-darken-1'
                  "
                >
                  <v-icon
                    size="22"
                    :icon="
                      user.uActive !== 0
                        ? 'mdi-toggle-switch-off'
                        : 'mdi-toggle-switch-outline'
                    "
                  ></v-icon>
                </v-btn>
              </td>
              <td style="min-width: 240px">
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
  <UsersDialog
    :dialogOpen="showDialog.open"
    :dialogID="showDialog.id"
    @close="onDialogClose"
  />
</template>

<script lang="ts">
import { User } from "../model/type";
import { getUsers } from "../services/data";
import UsersDialog from "./UsersDialog.vue";

export default {
  components: {
    UsersDialog,
  },
  data() {
    const base: string = "http://localhost/my-vue-vuetify-server/";
    let users: User[] = [];
    return {
      users,
      base,
      showDialog: {
        open: false,
        id: 0,
      },
    };
  },
  mounted() {
    this.getUsers();
  },
  methods: {
    onOpenDialog(id: number): any {
      // console.log("on open");
      this.showDialog.id = id;
      this.showDialog.open = true;
    },
    onDialogClose() {
      // console.log("on close");
      this.showDialog.id = 0;
      this.showDialog.open = false;
    },
    getUsers() {
      getUsers().then((data: User[]) => {
        this.users = data;
      });
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
  margin: auto 8px;

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
    $green: rgba(112, 255, 117, 0.4);
    $purple: rgba(187, 134, 243, 0.4);
    $red: rgba(244, 67, 54, 0.4);
    $yellow: rgba(251, 141, 0, 0.4);
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
