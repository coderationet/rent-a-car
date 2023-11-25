import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            'moment': 'moment/moment.js',
            // 'jquery': 'jquery/dist/jquery.js',
            // '$': 'jquery/dist/jquery.js',
        },
    },
});
