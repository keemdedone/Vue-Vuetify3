<template>
  <v-row justify="center">
    <!-- Create -->
    <v-dialog
      v-if="selectedDialog === 1"
      v-model="open"
      width="1024"
      @close="onDialogClose()"
      persistent
    >
      <v-card>
        <v-card-title class="text-center mt-4">
          <span class="text-h5">User Create</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="6">
                <v-text-field
                  label="First name*"
                  hint="Fill your first name"
                  v-model="createForm.firstName"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  label="Last name*"
                  hint="Fill your last name"
                  v-model="createForm.lastName"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  label="Username*"
                  hint="Fill your username"
                  v-model="createForm.username"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  label="Email*"
                  hint="Fill your email"
                  v-model="createForm.email"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="Password*"
                  type="password"
                  hint="Fill your password"
                  v-model="createForm.password"
                  required
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions class="justify-center">
          <v-btn color="red-darken-1" variant="tonal" @click="onDialogClose()">
            <v-icon size="22" icon="mdi-close"></v-icon>
          </v-btn>
          <v-btn color="blue-darken-1" variant="tonal" @click="onCreateUser()">
            <v-icon size="22" icon="mdi-content-save"></v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Read -->
    <v-dialog
      v-if="selectedDialog === 2 && userID !== 0"
      v-model="open"
      width="800"
      @close="onDialogClose()"
      persistent
    >
      <v-card>
        <v-card-title class="text-center mt-4">
          <span class="text-h5">User Information</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="3 text-right">First - Lastname</v-col>
              <v-col cols="9">
                {{ userInformation.firstName + " " + userInformation.lastName }}
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="3 text-right">Username</v-col>
              <v-col cols="9">{{ userInformation.username }}</v-col>
            </v-row>
            <v-row>
              <v-col cols="3 text-right">Email</v-col>
              <v-col cols="9">{{ userInformation.email }}</v-col>
            </v-row>
            <v-row>
              <v-col cols="3 text-right">Photo</v-col>
              <v-col cols="9">Null</v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions class="justify-center">
          <v-btn
            color="red-darken-1"
            variant="tonal"
            icon
            @click="onDialogClose()"
          >
            <v-icon size="22" icon="mdi-close"></v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Update -->
    <v-dialog
      v-if="selectedDialog === 3 && userID !== 0"
      v-model="open"
      width="1024"
      @close="onDialogClose()"
      persistent
    >
      <v-card>
        <v-card-title class="text-center mt-4">
          <span class="text-h5">User Update</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="6">
                <v-text-field
                  label="First name*"
                  hint="Update your first name"
                  v-model="updateForm.firstName"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  label="Last name*"
                  hint="Update your last name"
                  v-model="updateForm.lastName"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  label="Username*"
                  hint="Update your username"
                  v-model="updateForm.username"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  label="Email*"
                  hint="Update your email"
                  v-model="updateForm.email"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="Password*"
                  type="password"
                  hint="Update your password"
                  v-model="updateForm.password"
                  required
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions class="justify-center">
          <v-btn color="red-darken-1" variant="tonal" @click="onDialogClose()">
            <v-icon size="22" icon="mdi-close"></v-icon>
          </v-btn>
          <v-btn
            color="blue-darken-1"
            variant="tonal"
            @click="onUpdateUser(userID)"
          >
            <v-icon size="22" icon="mdi-content-save"></v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Delete -->
    <v-dialog
      v-if="selectedDialog === 4 && userID !== 0"
      v-model="open"
      width="400"
      @close="onDialogClose()"
      persistent
    >
      <v-card>
        <v-card-text>
          <v-card-title class="text-center mt-4">
            <span>Delete {{ userInformation.username }} ?</span>
          </v-card-title>
          <v-container>
            <v-card-actions class="justify-center">
              <v-btn
                color="red-darken-1"
                variant="tonal"
                @click="onDialogClose()"
              >
                <v-icon size="22" icon="mdi-close"></v-icon>
              </v-btn>
              <v-btn
                color="blue-darken-1"
                variant="tonal"
                @click="onDeleteUser(userID)"
              >
                <v-icon size="22" icon="mdi-check"></v-icon>
              </v-btn>
            </v-card-actions>
          </v-container>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script lang="ts">
import { User } from "@/model/type";
import { createUser, getUser, updateUser, deleteUser } from "../services/data";

export default {
  props: ["dialogOpen", "dialogID", "dialogUserID"],
  data() {
    return {
      open: false,
      selectedDialog: 0,
      userID: 0,
      userInformation: {
        firstName: "",
        lastName: "",
        username: "",
        email: "",
        password: "",
      },
      createForm: {
        firstName: "",
        lastName: "",
        username: "",
        email: "",
        password: "",
      },
      updateForm: {
        firstName: "",
        lastName: "",
        username: "",
        email: "",
        password: "",
      },
    };
  },
  watch: {
    dialogOpen(open: boolean) {
      if (open) {
        this.open = true;
      }
    },
    dialogID(id: number) {
      this.selectedDialog = id;
    },
    dialogUserID(uID: number) {
      this.userID = uID;
      this.onGetUser(uID);
    },
  },
  methods: {
    onDialogClose() {
      this.selectedDialog = 0;
      this.open = false;
      this.$emit("close", true);
    },
    onGetUser(id: number) {
      getUser(id).then((data: User) => {
        this.updateForm = { ...this.updateForm, ...data };
        this.userInformation = { ...this.updateForm, ...data };
      });
    },
    onCreateUser() {
      const forms = this.createForm;
      createUser(
        forms.firstName,
        forms.lastName,
        forms.username,
        forms.email,
        forms.password
      ).then((res: boolean) => {
        if (res === true) {
          this.onDialogClose();
          this.$emit("refresh", true);
        }
      });
    },
    onUpdateUser(id: number) {
      const forms = this.updateForm;
      updateUser(
        id,
        forms.firstName,
        forms.lastName,
        forms.username,
        forms.email,
        forms.password
      ).then((res: boolean) => {
        if (res === true) {
          this.onDialogClose();
          this.$emit("refresh", true);
        }
      });
    },
    onDeleteUser(id: number) {
      deleteUser(id).then((res) => {
        if (res === true) {
          this.onDialogClose();
          this.$emit("refresh", true);
        }
      });
    },
  },
  emits: ["close", "refresh"],
};
</script>
