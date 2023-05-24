import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { VitePluginNode } from 'vite-plugin-node';
// import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // 'resources/sass/app.scss',
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        VitePluginNode(),
    ],
    optimizeDeps: {
        include: ['jquery'],
      }
});
