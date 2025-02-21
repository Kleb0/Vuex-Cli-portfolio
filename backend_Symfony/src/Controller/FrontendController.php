<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;

class FrontendController extends AbstractController
{
    #[Route('/{vueRouting}', name: 'vue_app', requirements: ['vueRouting' => '.*'])]
    public function index(): Response
    {
        $publicDir = $this->getParameter('kernel.project_dir') . '/public';
        $indexPath = $publicDir . '/vue_dist/index.html';

        if (!file_exists($indexPath)) {
            //the index.html from Vue.js has not been found
            throw $this->createNotFoundException('the index.html from Vue.js has not been found.');
        }

        return new Response(file_get_contents($indexPath));
    }
}
