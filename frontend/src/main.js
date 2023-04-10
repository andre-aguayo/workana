import i18n from "./i18n";
import App from "./App.vue";
import { pinia } from "pinia";
import { createApp } from "vue";
import router from "./router/router";

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

createApp(App).use(pinia).use(i18n).use(router).mount("#app");
