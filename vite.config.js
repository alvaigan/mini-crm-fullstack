import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue2";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/js/main.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
