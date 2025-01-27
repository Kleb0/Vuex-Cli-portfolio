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

  outputDir: '../backend_Symfony/public', // Dossier public de Symfony
  indexPath: '../backend_Symfony/templates/base.html.twig', // Génère un fichier Twig au lieu de index.html
  assetsDir: 'assets', // Placer les assets dans un sous-dossier
});
