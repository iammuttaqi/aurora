import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    server: {
        hmr: false,
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: false,
        }),
    ],
});
