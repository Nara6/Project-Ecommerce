import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
  // base: '/Project-e-commerce-/',
  plugins: [vue()],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  },
  server: {
    proxy: {
      "/api": {
        target: "http://35.186.150.74:1026",
        changeOrigin: true,
        secure: false,
      },
    },
  },
  pwa: {
    workboxOptions: {
      exclude: [/_redirects/]
    }
  }

})
