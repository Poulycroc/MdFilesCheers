import "./bootstrap";

import "./../scss/app.scss";
import "element-plus/dist/index.css";

import { createApp, h, DefineComponent } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import ElementPlus from "element-plus";
import Router from "./router";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title: string) => `${title} - ${appName}`,
    resolve: (name: string) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>("./Pages/**/*.vue"),
        ),
    setup({ el, App, props, plugin }: object) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Router)
            .use(ZiggyVue)
            .use(ElementPlus)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
