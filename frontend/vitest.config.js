import { defineConfig } from 'vitest/config';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  css: { postcss: { plugins: [] } },
  plugins: [vue({ template: { transformAssetUrls: { includeAbsolute: false } } })],
});
