<template>
  <v-row justify="center">
    <!-- Create -->
    <v-dialog
      v-if="id === 1"
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
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  label="Last name*"
                  hint="Fill your last name"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  label="Username*"
                  hint="Fill your username"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  label="Email*"
                  hint="Fill your email"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="Password*"
                  type="password"
                  hint="Fill your password"
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
            @click="onSelectAction(id)"
          >
            <v-icon size="22" icon="mdi-content-save"></v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Read -->
    <v-dialog
      v-if="id === 2"
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
              <v-col cols="9">Null</v-col>
            </v-row>
            <v-row>
              <v-col cols="3 text-right">Username</v-col>
              <v-col cols="9">Null</v-col>
            </v-row>
            <v-row>
              <v-col cols="3 text-right">Email</v-col>
              <v-col cols="9">Null</v-col>
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
      v-if="id === 3"
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
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  label="Last name*"
                  hint="Update your last name"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  label="Username*"
                  hint="Update your username"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field
                  label="Email*"
                  hint="Update your email"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="Password*"
                  type="password"
                  hint="Update your password"
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
            @click="onSelectAction(id)"
          >
            <v-icon size="22" icon="mdi-content-save"></v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script lang="ts">
export default {
  props: ["dialogOpen", "dialogID"],
  data() {
    return {
      open: false,
      id: 0,
      createForm: {
        firstName: null,
        lastName: null,
        username: null,
        email: null,
        password: null,
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
      this.id = id;
    },
  },
  methods: {
    onDialogClose() {
      this.id = 0;
      this.open = false;
      this.$emit("close", true);
    },
    onSelectAction(id: number) {
      console.log(id);
    },
  },
  emits: ["close"],
};
</script>
