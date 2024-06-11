import { createRouter, createWebHistory } from "vue-router";
import Editor from "@/Pages/Editor.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.APP_URl),
    routes: <array>[
        {
            path: "/editor/:pathMatch(.*)*",
            name: "Editor",
            component: Editor,
        },
    ],
});

export default router;
