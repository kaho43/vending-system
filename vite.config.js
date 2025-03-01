import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
  plugins: [
    vue(),
    laravel({
      input: [
        'resources/js/app.js',
        'resources/sass/app.scss',  // ここで app.scss を指定
        'resources/css/style.css',  // 他の CSS を指定
        'resources/css/app.css',
        'resources/js/script.js'
      ],
      refresh: true,
    }),
  ],
  build: {
    outDir: 'public/build',
    assetsDir: 'assets',
    manifest: true,
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),
    },
  },
  server: {
    proxy: {
      '/': 'http://localhost',
    },
    port: 3000,
    roxy: {
      '/vending-system': 'http://localhost:8080', // Laravelのバックエンドにリクエストを渡す
    },
  },
});
