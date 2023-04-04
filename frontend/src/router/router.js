import { createRouter, createWebHistory } from "vue-router";
import HomePage from "@/Pages/HomePage";
import i18n from "../i18n/index.js";
import CreateProduct from "@/Pages/Products/CreateProduct";
import Create from "@/Pages/ProductCategory/Create";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      name: i18n.global.t("home.title"),
      path: "",
      component: HomePage,
    },
    {
      name: i18n.global.t("product.title"),
      path: "/product/create",
      component: CreateProduct,
    },
    {
      name: i18n.global.t("productCategory.create.title"),
      path: "/product-category/create",
      component: Create,
    },
  ],
});

export default router;
