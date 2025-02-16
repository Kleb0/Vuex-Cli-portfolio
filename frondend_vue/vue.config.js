const { defineConfig } = require('@vue/cli-service');

module.exports = defineConfig({
  transpileDependencies: true,

  devServer: {
    proxy: {
      '/api': { 
        target: 'http://127.0.0.1:8000',
        changeOrigin: true,
        secure: false,
        pathRewrite: { '^/api': '' }, 
      },
    },
  },

  outputDir: '../backend_Symfony/public', // Générer Vue dans le dossier public de Symfony
  assetsDir: 'assets', // Placer les assets dans public/assets
  indexPath: 'index.html', // Laisser Vue générer un index.html standard
});
