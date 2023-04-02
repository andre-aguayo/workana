import { createApp } from "vue";
import App from "./App.vue";
import router from "./router/router";
import { pinia } from "pinia";
import i18n from "./i18n";

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

createApp(App).use(pinia).use(i18n).use(router).mount("#app");
