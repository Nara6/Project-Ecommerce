const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  devServer: {
    port: 3000,
    allowedHosts: "all",
    proxy: {
      "^/api": {
        target: "http://35.186.150.74:1026",
        changeOrigin: true,
        // pathRewrite: {
        //   '^/api': '/'
        // }
        
      },
      "^/image": {
        target: "http://35.186.150.74:1026",
        changeOrigin: true,
        pathRewrite: {
          '^/image': ''
        }
      },
    },
  },
})
