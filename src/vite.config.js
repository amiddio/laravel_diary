import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        strictPort: true,
        port: 5173,
        host: '0.0.0.0',
        origin: 'http://diary.local:5173',
        hmr: {
            host: 'diary.local',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/bootstrap/css/bootstrap.min.css',
                'resources/bootstrap/js/bootstrap.bundle.min.js',
                'resources/css/cabinet.css',
                'resources/css/main.css',
            ],
            refresh: true,
        }),
    ],
});
