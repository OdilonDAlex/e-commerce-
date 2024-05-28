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
                'resources/css/form.css',
                'resources/css/profile.css',
                'resources/css/search-bar.css',
                'resources/css/search-result.css',
                'resources/css/notification.css',
                'resources/css/history.css',
                'resources/css/product-index.css',
                'resources/css/product-list-view.css',
                'resources/js/change-category.js',
                'resources/js/admin/message.js',
                'resources/css/admin/dashboard.css',
                'resources/css/admin/mini-card.css',
                'resources/css/admin/sidebar.css',
                'resources/css/footer.css',
                'resources/css/checkout.css',
                'resources/js/checkout.js',
                'resources/js/homepage-scroll-smooth.js',
                'resources/js/product-scroll-smooth.js',
            ],
            refresh: true,
        }),
    ],
});
