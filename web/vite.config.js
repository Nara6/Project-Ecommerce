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
  // base: "/home",
  server: {
    host:true,
    proxy: {
      "/api": {
        target: "http://35.186.150.74:1026/api",
        changeOrigin: true,
        secure: false,
        ws: true,
        
      },
      "^/image": {
        target: "http://35.186.150.74:1026",
        changeOrigin: true,
        secure: false,
        ws: true,
        rewrite: (path) => path.replace(/^\/image/, '')
      },
    },
  },
  pwa: {
    workboxOptions: {
      exclude: [/_redirects/]
    }
  }

})
