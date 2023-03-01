// Composables
import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/",
    component: () => import("@/layouts/default/Default.vue"),
    children: [
      {
        path: "",
        redirect: "home",
      },
      {
        path: "home",
        name: "Home",
        component: () => import("@/views/Home.vue"),
      },
      {
        path: "calendar",
        name: "Calendar",
        component: () => import("@/views/calendar.vue"),
      },
      {
        path: "users",
        name: "Users",
        component: () => import("@/views/users.vue"),
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
