import { createRouter, createWebHistory } from "vue-router";
import HomePage from "@/Pages/HomePage";
import ProductInformations from "@/Pages/Products/ProductInformations";
import i18n from "../i18n/index.js";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      name: i18n.global.t("home.title"),
      path: "",
      component: HomePage,
      product: [
        {
          name: i18n.global.t("product.title"),
          path: "/product/:productId",
          component: ProductInformations,
        },
      ],
    },
  ],
});

export default router;
