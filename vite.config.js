import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/mapPageFiltersShow.js',
                'resources/js/grenadeVote.js',
                'resources/js/grenadeFavorite.js',
                'resources/js/createGrenade.js',
                'resources/js/mirage.js',
                'resources/js/sortable.js',
                'resources/js/alerts.js'
            ],
            refresh: true,
        }),
    ],
});
