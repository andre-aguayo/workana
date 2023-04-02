import { createRouter, createWebHistory } from "vue-router";
import homePage from "@/components/homePage.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      name: "home page",
      path: "/",
      component: homePage,
    },
  ],
});

export default router;
