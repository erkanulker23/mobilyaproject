import { defineConfig } from 'vite';
import { resolve } from "path";

export default defineConfig({
    build: {
        lib: {
            entry: resolve(__dirname, "Resources/js/menu-builder.js"),
            name: "MenuBuilder",
            fileName: "menu-builder",
        },
    },
});
