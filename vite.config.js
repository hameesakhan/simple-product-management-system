import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    optimizeDeps: {
        exclude: ["jquery"],
    },
    plugins: [
        laravel([
            'resources/sass/app.scss',
            'resources/js/app.js',
            'resources/js/frontend/src/main.js',
        ]),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '@': 'resources/js/frontend/src'
        },
    },
    // build: {
    //     rollupOptions: {
    //         external: ['jquery'],
    //         output: {
    //             globals: {
    //                 jquery: 'window.jQuery',
    //                 jquery: 'window.$'
    //             }
    //         }
    //     }
    // }
});