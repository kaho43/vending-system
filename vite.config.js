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
        'resources/css/app.css', 
        'resources/css/style.css' // style.css をここで追加
      ],
      refresh: true,
    }),
  ],
  build: {
    outDir: 'public/build',  // 出力先ディレクトリ
    assetsDir: 'assets',     // アセット格納場所
    manifest: true,          // manifest.json を生成
    rollupOptions: {
      input: {
        app: 'resources/js/app.js', // 既存のエントリーファイル
        script: 'resources/js/script.js', // 新たに追加
        css_app: 'resources/css/app.css', // app.css を指定
        css_style: 'resources/css/style.css', // style.css を追加で指定
      },
    },
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'), // 'resources/js' へのエイリアス
    },
  },
  server: {
    proxy: {
      '/': 'http://localhost',  // Laravelサーバーへのプロキシ設定
    },
    port: 8080, // 同じポートを使用
  },
});
