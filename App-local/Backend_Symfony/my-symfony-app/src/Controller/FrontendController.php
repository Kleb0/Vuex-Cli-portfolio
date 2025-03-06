<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Finder\Finder;

class FrontendController extends AbstractController
{
    #[Route('/api/vue-files', name: 'vue_files', methods: ['GET'])]
    public function listVueFiles(): JsonResponse
    {
        $publicPath = $this->getParameter('kernel.project_dir') . '/public/vue_dist';
        $finder = new Finder();
        $finder->files()->in($publicPath)->name('*.js')->name('*.css');

        $files = [];
        foreach ($finder as $file) {
            $files[] = $file->getRelativePathname();
        }

        return new JsonResponse($files);
    }

    #[Route('/{route}', name: 'vue_frontend', requirements: ['route' => '^(?!api).*$'], defaults: ['route' => 'index.html'])]
    public function index(Request $request): Response
    {
        $publicPath = $this->getParameter('kernel.project_dir') . '/public';
        $requestedFile = $request->get('route') ?: 'index.html';
        $file = $publicPath . '/' . $requestedFile;

        // Vérifie si le fichier demandé existe réellement
        if (!file_exists($file)) {
            // Si le fichier n'existe pas ET qu'il n'est pas un asset statique, charge Vue.js
            if (!preg_match('/\.(js|css|map|json|ico|png|jpg|jpeg|svg|woff|woff2|ttf|eot)$/', $requestedFile)) {
                $file = $publicPath . '/index.html';
            } else {
                throw new FileNotFoundException('Fichier non trouvé: ' . $requestedFile);
            }
        }

        // Définir le bon Content-Type
        $mimeType = mime_content_type($file);
        if (!$mimeType) {
            $mimeType = 'application/octet-stream'; // Fallback sécurisé
        }

        return new Response(file_get_contents($file), 200, ['Content-Type' => $mimeType]);
    }
}
