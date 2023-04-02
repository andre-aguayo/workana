import { createRouter, createWebHistory } from "vue-router";
import HelloWorld from "@/components/HelloWorld.vue";
import noo from "@/components/noo.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      name: "home",
      path: "/",
      component: HelloWorld,
    },
    {
      name: "noo",
      path: "/noo",
      component: noo,
    },
  ],
});

export default router;
