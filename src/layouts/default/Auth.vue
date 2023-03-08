<template>
  <v-container class="fill-height h-screen">
    <v-responsive class="d-flex align-center text-center fill-height">
      <div
        class="form-container mx-auto overflow-hidden"
        :class="{ fillHight: formType }"
      >
        <!-- LOGIN -->
        <v-card
          class="form-card mx-auto px-2 py-4"
          :class="{ slide: formType }"
          variant="tonal"
        >
          <div class="form-input">
            <h1 class="mb-4 text-h2">Login</h1>
            <v-form @submit.prevent="onLogin">
              <v-container>
                <v-row>
                  <v-col cols="12">
                    <v-text-field
                      variant="outlined"
                      label="Username"
                      v-model="loginForm.username"
                      :hide-details="true"
                      :rules="rules"
                      required
                    ></v-text-field>
                  </v-col>

                  <v-col cols="12">
                    <v-text-field
                      type="password"
                      variant="outlined"
                      label="Password"
                      v-model="loginForm.password"
                      :hide-details="true"
                      :rules="rules"
                      required
                    ></v-text-field>
                  </v-col>

                  <v-col cols="12">
                    <v-btn block class="py-6" color="primary" type="submit"
                      >Sing in</v-btn
                    >

                    <hr class="my-6" style="border-color: gray" />

                    <v-btn
                      class="py-6 d-flex mx-auto"
                      color="success"
                      @click="formType = true"
                      >Create new account</v-btn
                    >
                  </v-col>
                </v-row>
              </v-container>
            </v-form>
          </div>
        </v-card>
        <!-- END LOGIN -->

        <!-- REGISTER -->
        <v-card
          class="form-card mx-auto px-2 py-4"
          :class="{ slide: formType }"
          variant="tonal"
        >
          <div class="form-input">
            <h1 class="mb-4 text-h2">Register</h1>
            <v-form @submit.prevent="onCreateUser">
              <v-container>
                <v-row>
                  <v-col cols="6">
                    <v-text-field
                      label="First name*"
                      hint="Fill your first name"
                      v-model="createForm.firstName"
                      :rules="rules"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="6">
                    <v-text-field
                      label="Last name*"
                      hint="Fill your last name"
                      v-model="createForm.lastName"
                      :rules="rules"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="6">
                    <v-text-field
                      label="Username*"
                      hint="Fill your username"
                      v-model="createForm.username"
                      :rules="rules"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="6">
                    <v-text-field
                      label="Email*"
                      hint="Fill your email"
                      v-model="createForm.email"
                      :rules="rules"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Password*"
                      type="password"
                      hint="Fill your password"
                      v-model="createForm.password"
                      :rules="rules"
                      required
                    ></v-text-field>
                  </v-col>

                  <v-col cols="12">
                    <v-btn block class="py-6" color="primary" type="submit"
                      >Sing up</v-btn
                    >

                    <hr class="my-6" style="border-color: gray" />

                    <v-btn
                      class="py-6 d-flex mx-auto"
                      color="success"
                      @click="formType = false"
                      >Already have account ?</v-btn
                    >
                  </v-col>
                </v-row>
              </v-container>
            </v-form>
          </div>
        </v-card>
        <!-- END REGISTER -->
      </div>
    </v-responsive>
  </v-container>

  <!-- SNACKBAR MASSAGE -->
  <v-snackbar v-model="snackbar" :timeout="timeout">
    {{ text }}
    <template v-slot:actions>
      <v-btn color="blue" variant="text" @click="snackbar = false">
        Close
      </v-btn>
    </template>
  </v-snackbar>
  <!-- END SNACKBAR MASSAGE -->
</template>

<script lang="ts">
import { createUser, login } from "../../services/data";
export default {
  data() {
    return {
      formType: false,
      snackbar: false,
      validate: false,
      timeout: 3000,
      text: this.formType
        ? "User Create Complete !"
        : "Your username or password invalid...",
      createForm: {
        firstName: "",
        lastName: "",
        username: "",
        email: "",
        password: "",
      },
      loginForm: { username: "", password: "" },
      rules: [
        (value: string) => {
          if (value !== "" && value != undefined && value != null) {
            return true;
          }
          return "Plase fill this infomation.";
        },
      ],
    };
  },
  methods: {
    onCreateUser() {
      const forms = this.createForm;
      if (
        forms.firstName !== "" &&
        forms.lastName !== "" &&
        forms.username !== "" &&
        forms.password !== "" &&
        forms.email !== ""
      ) {
        createUser(
          forms.firstName,
          forms.lastName,
          forms.username,
          forms.email,
          forms.password
        ).then((res: boolean) => {
          if (res === true) {
            this.snackbar = true;
            setTimeout(() => {
              this.rules = [];
              this.createForm = {
                firstName: "",
                lastName: "",
                username: "",
                email: "",
                password: "",
              };
              this.formType = false;
            }, 1000);
          }
        });
      }
    },
    onLogin() {
      const forms = this.loginForm;
      if (forms.username !== "" && forms.password !== "") {
        login(forms.username, forms.password).then((res: boolean) => {
          if (res === true) {
            console.log("login complete!");
            this.$emit("login", res);
          } else {
            this.snackbar = true;
          }
        });
      }
    },
  },
  emits: ["login"],
};
</script>

<style lang="scss">
.form-container {
  max-width: 500px;
  height: 450px;
  position: relative;
  transition: height 0.5s ease 1s;
}

.fillHight {
  height: 600px;
  transition: height 0.5s ease 0s;
}

.form-card {
  max-width: 450px;
  width: 100%;
  position: absolute;
  top: 0;
  bottom: 0;
  transition: left 0.5s ease;

  &:first-child {
    left: 0;

    &.slide {
      transition: left 0.5s ease 0.75s;
      left: -100%;
    }
  }

  &:last-child {
    left: 100%;

    &.slide {
      transition: left 0.5s ease 0.75s;
      left: 0;
    }
  }
}
</style>
