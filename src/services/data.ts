import { User } from "../model/type";
import axios from "axios";

const base = "http://localhost/my-vue-vuetify-server";

export function getUsers(): Promise<User[]> {
  return fetch(`${base}/user/read.php`)
    .then((response) => response.json())
    .catch((error) => {
      console.error(error);
      alert("Error happend during call users data.");
      return [];
    });
}

export function getUser(id: number): Promise<User> {
  return fetch(`${base}/user/readSingle.php?id=${id}`)
    .then((response) => response.json())
    .catch((error) => {
      console.error(error);
      alert("Error happend during call user data.");
      return [];
    });
}

export function createUser(
  fName: string,
  lName: string,
  uName: string,
  email: string,
  password: string
) {
  const url = base + "/user/create.php";
  const data = {
    fName,
    lName,
    uName,
    email,
    password,
  };
  return axios
    .post(url, data)
    .then(() => {
      console.log("User created successfully");
      return true;
    })
    .catch((error) => {
      console.error("Error creating user", error);
      throw error;
    });
}

export function updateUser(
  id: number,
  fName: string,
  lName: string,
  uName: string,
  email: string,
  password: string
) {
  const url = base + "/user/update.php?id=" + id;
  const data = {
    fName,
    lName,
    uName,
    email,
    password,
  };
  return axios
    .put(url, data)
    .then(() => {
      console.log("User updated successfully");
      return true;
    })
    .catch((error) => {
      console.error("Error updating user", error);
      throw error;
    });
}

export function updateActive(id: number, value: number) {
  const url = base + "/user/updateActive.php?id=" + id + "&v=" + value;
  return axios
    .put(url)
    .then(() => {
      console.log("User updated successfully");
      return true;
    })
    .catch((error) => {
      console.error("Error updating user", error);
      throw error;
    });
}

export function deleteUser(id: number) {
  const url = base + "/user/delete.php?id=" + id;
  return axios
    .put(url)
    .then(() => {
      console.log("User deleted successfully");
      return true;
    })
    .catch((error) => {
      console.error("Error deleting user", error);
      throw error;
    });
}
