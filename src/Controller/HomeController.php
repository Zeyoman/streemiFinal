<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MediaRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function __invoke(MediaRepository $mediaRepository): Response
    {
        $medias = $mediaRepository->findTrendingMedias();

        return $this->render('index.html.twig', [
            'medias' => $medias,
        ]);
    }
}