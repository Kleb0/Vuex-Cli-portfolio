const fs = require('fs-extra');
const path = require('path');


const sourcePath = path.join(__dirname, '../backend_Symfony/public/index.html');
const targetPath = path.join(__dirname, '../backend_Symfony/templates/base.html.twig');


fs.readFile(sourcePath, 'utf8', (err, data) => {
  if (err) {
    console.error('Erreur lors de la lecture du fichier index.html :', err);
    return;
  }

  let twigContent = data
    .replace(/\/assets\/css\//g, '{{ asset(\'assets/css/')
    .replace(/\/assets\/js\//g, '{{ asset(\'assets/js/')
    .replace(/\.css/g, '.css\') }}')
    .replace(/\.js/g, '.js\') }}');


  fs.writeFile(targetPath, twigContent, 'utf8', (err) => {
    if (err) {
      console.error('Erreur lors de l\'écriture du fichier base.html.twig :', err);
      return;
    }
    console.log('base.html.twig généré avec succès !');
  });
});
