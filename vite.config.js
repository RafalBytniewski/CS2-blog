import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/mapPageFiltersShow.js',
                'resources/js/mapPageFiltersFetch.js',
                'resources/js/createGrenade.js',
                'resources/js/Mirage.js'
            ],
            refresh: true,
        }),
    ],
});
