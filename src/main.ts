import App from "./App.vue";
import "./style.css";
import "@fontsource-variable/roboto";
import { autoAnimatePlugin } from "@formkit/auto-animate/vue";
import { createApp, type Directive } from "vue";

createApp(App)
    .use(autoAnimatePlugin)
    .directive("autofocus", {
        mounted(el: HTMLElement) {
            el.focus();
        },
    } satisfies Directive<HTMLElement>)
    .mount("#app");
