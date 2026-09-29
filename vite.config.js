import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            // Web root is the project root, so build output goes to ./build
            publicDirectory: '.',
            refresh: true,
        }),
        tailwindcss(),
    ],
});
