const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  devServer: {
    port: 8081,
    // host:true,
    proxy: {
      "^/api": {
        // target: "http://127.0.0.1:8000",
        target: "http://35.186.150.74:1026",
        changeOrigin: true,
        secure: false,
        ws: true,
        // pathRewrite: {
        //   '^/api': '/'
        // }
        
      },
      "^/image": {
        target: "http://35.186.150.74:1026",
        changeOrigin: true,
        secure: false,
        ws: true,
        pathRewrite: {
          '^/image': ''
        }
      },
    },
  },
})
