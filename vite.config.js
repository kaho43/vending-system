import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue'; // Vue を使ってる場合のみ必要
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/js/app.js',
        'resources/js/script.js',
        'resources/sass/app.scss',
        'resources/css/app.css',
        'resources/css/style.css',
      ],
      refresh: true,
    }),
    vue(), // Vue を使っていない場合はこれ削除OK
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),
    },
  },
  server: {
    host: 'localhost',
    port: 3000,
    hmr: {
      host: 'localhost', // ← ここが重要！
    },
    proxy: {
      '/vending-system': 'http://localhost:8080', // Laravel のバックエンドと連携するなら必要
    },
  },
  build: {
    outDir: 'public/build',
    assetsDir: 'assets',
    manifest: true,
  },
});
