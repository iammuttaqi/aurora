import tailwindcss from '@tailwindcss/vite';
import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    server: {
        hmr: false,
    },
    plugins: [
        tailwindcss(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            assets: ['resources/images/**', 'resources/fonts/**'],
            refresh: false,
        }),
    ],
});
