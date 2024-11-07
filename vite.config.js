import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';


export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'SBAdmin/css/sb-admin-2.min.css'

            ],
            refresh: true,
        }),
    ],
});