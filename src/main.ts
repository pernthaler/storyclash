import App from "./App.vue";
import "./style.css";
import "@fontsource-variable/roboto";
import { autoAnimatePlugin } from "@formkit/auto-animate/vue";
import { createApp } from "vue";

createApp(App).use(autoAnimatePlugin).mount("#app");
