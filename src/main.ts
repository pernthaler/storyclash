import { autoAnimatePlugin } from "@formkit/auto-animate/vue";
import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import "@fontsource-variable/roboto";

createApp(App).use(autoAnimatePlugin).mount("#app");
