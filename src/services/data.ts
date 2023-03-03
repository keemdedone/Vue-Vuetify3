import { User } from "../model/type";

const base = "http://localhost/my-vue-vuetify-server";

export function getUsers(): Promise<User[]> {
  return fetch(base + "/user/read.php")
    .then((response) => response.json())
    .catch((error) => {
      console.error(error);
      alert("Error happend during call users data.");
      return [];
    });
}

export function createUser() {
  return fetch(base + "/user/create.php")
    .then((response) => response.json())
    .catch((error) => {
      console.error(error);
      alert("Error happend during call users data.");
      return [{ complete: false }];
    });
}
