import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/header.css',
                'resources/css/message.css',
                'resources/css/product/show.css',
                'resources/css/admin/table.css',
                'resources/css/product/create.css',
                'resources/css/product/card.css',
                'resources/css/product/pagination.css',
                'resources/css/homepage.css',
                'resources/css/flex-center.css',
                'ressources/css/form.css',
            ],
            refresh: true,
        }),
    ],
});
