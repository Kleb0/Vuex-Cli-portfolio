const { defineConfig } = require('@vue/cli-service');
const path = require('path');

const outputPath = path.resolve(__dirname, '../../Backend_Symfony/my-symfony-app/public/vue_dist');

console.log('Build output directory:', outputPath);

module.exports = defineConfig({
  transpileDependencies: true,
  outputDir: outputPath,
  publicPath: './',
});
