import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { fileURLToPath } from 'node:url';

export default defineConfig({
  root: fileURLToPath(new URL('.', import.meta.url)),
  envDir: fileURLToPath(new URL('..', import.meta.url)),
  build: { outDir: fileURLToPath(new URL('../public/spa', import.meta.url)), emptyOutDir: true },
  css: { postcss: { plugins: [] } },
  plugins: [
    laravel({
      input: [fileURLToPath(new URL('src/main.js', import.meta.url))],
      buildDirectory: 'spa',
      hotFile: fileURLToPath(new URL('../public/hot', import.meta.url)),
      refresh: true,
    }),
    vue({ template: { transformAssetUrls: { includeAbsolute: false } } }),
  ],
});
