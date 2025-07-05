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
                'resources/js/grenadeGroup.js',
                'resources/js/createGrenade.js',
                'resources/js/map/mirage.js',
                'resources/js/sortableGrenade.js',
                'resources/js/alerts.js',
                'resources/js/grenadeGroup.js'
            ],
            refresh: true,
        }),
    ],
});
