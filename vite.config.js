import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/mapPageFiltersShow.js',
                'resources/js/createGrenade.js',
                'resources/js/mirage.js',
<<<<<<< HEAD
=======
                'resources/css/welcome.css',
>>>>>>> 6520ec6c9924d4f5689095e4e6b23480d3d6fda4
                'resources/js/sortable.js'
            ],
            refresh: true,
        }),
    ],
});
