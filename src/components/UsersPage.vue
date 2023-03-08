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
                  class="menu-btn"
                  variant="flat"
                  min-width="28"
                  @click="onUpdateActive(user.uID, index)"
                  :color="user.uActive != 1 ? 'green-darken-1' : 'red-darken-1'"
                  :disabled="delayActive[index]"
                >
                  <template v-if="!delayActive[index]">
                    <v-icon
                      size="22"
                      :icon="
                        user.uActive != 1
                          ? 'mdi-toggle-switch-off'
                          : 'mdi-toggle-switch-outline'
                      "
                    ></v-icon>
                  </template>
                  <template v-else>
                    <v-progress-circular
                      size="22"
                      indeterminate
                    ></v-progress-circular>
                  </template>
                </v-btn>
              </td>
              <td style="min-width: 240px">
                <v-btn
                  variant="flat"
                  min-width="28"
                  class="menu-btn"
                  color="green-darken-1"
                  @click="onOpenDialog(2, user.uID)"
                  :disabled="user.uActive == 1"
                >
                  <v-icon size="22" icon="mdi-magnify"></v-icon>
                </v-btn>
                <v-btn
                  variant="flat"
                  min-width="28"
                  class="menu-btn"
                  color="blue-darken-1"
                  :disabled="user.uActive == 1"
                  @click="onOpenDialog(3, user.uID)"
                >
                  <v-icon size="22" icon="mdi-pencil"></v-icon>
                </v-btn>
                <v-btn
                  variant="flat"
                  min-width="28"
                  class="menu-btn"
                  color="red-darken-1"
                  :disabled="user.uActive == 1"
                  @click="onOpenDialog(4, user.uID)"
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
    :dialogUserID="showDialog.userID"
    @close="onDialogClose"
    @refresh="onDataRefresh"
  />
</template>

<script lang="ts">
import { User } from "../model/type";
import { getUsers, updateActive } from "../services/data";
import UsersDialog from "./UsersDialog.vue";

export default {
  components: {
    UsersDialog,
  },
  data() {
    const base: string = "http://localhost/my-vue-vuetify-server/";
    let users: User[] = [];
    let delayActive: boolean[] = [];
    return {
      delayActive,
      users,
      base,
      showDialog: {
        open: false,
        id: 0,
        userID: 0,
      },
    };
  },
  mounted() {
    this.onGetUsers();
  },
  methods: {
    onOpenDialog(id: number, uID?: number): any {
      if (uID && uID !== 0) {
        this.showDialog.userID = uID;
      }
      this.showDialog.id = id;
      this.showDialog.open = true;
    },
    onDialogClose() {
      this.showDialog.id = 0;
      this.showDialog.open = false;
    },
    onDataRefresh() {
      this.onGetUsers();
    },
    onGetUsers() {
      getUsers().then((data: User[]) => {
        this.users = data;
        this.delayActive = new Array(this.users.length).fill(false);
      });
    },
    async onUpdateActive(id: number, index: number) {
      this.delayActive[index] = true;
      this.users = await Promise.all(
        this.users.map(async (data) => {
          if (data.uID == id) {
            const active = data.uActive == 0 ? 1 : 0;
            const res = await updateActive(id, active);
            if (res) {
              setTimeout(() => {
                this.delayActive[index] = false;
              }, 1000);
              return { ...data, uActive: active };
            } else {
              return data;
            }
          } else {
            return data;
          }
        })
      );
    },
  },
};
</script>

<style scoped lang="scss">
@import "../styles/UsersPage.scss";
</style>
