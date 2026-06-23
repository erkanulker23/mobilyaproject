import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        // Production build optimizasyonları
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true, // console.log'ları kaldır
                drop_debugger: true,
                pure_funcs: ['console.log', 'console.info', 'console.debug', 'console.warn']
            },
            format: {
                comments: false, // Yorumları kaldır
            }
        },
        cssMinify: true,
        // Chunk boyutunu optimize et
        rollupOptions: {
            output: {
                manualChunks: undefined,
                assetFileNames: 'assets/[name].[hash][extname]',
                chunkFileNames: 'assets/[name].[hash].js',
                entryFileNames: 'assets/[name].[hash].js',
            }
        },
        // Build performansı
        reportCompressedSize: false,
        chunkSizeWarningLimit: 1000,
    },
});
