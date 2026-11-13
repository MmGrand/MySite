import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { fileURLToPath } from 'node:url';

const hmrHost = process.env.VITE_HMR_HOST || 'localhost';
const hmrPort = Number(process.env.VITE_PORT || 5173);

export default defineConfig({
  server: {
    host: process.env.VITE_HOST || '0.0.0.0',
    origin: `http://${hmrHost}:${hmrPort}`,
    hmr: {
      host: hmrHost,
      clientPort: hmrPort,
    },
  },
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
