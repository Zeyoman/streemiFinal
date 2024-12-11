<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/discover', name: 'movie_discover')]
    public function discover_category(MediaRepository $mediaRepository, CategoryRepository $categoryRepository): Response
    {
        $medias = $mediaRepository->findTrendingMedias(3);
        $categories = $categoryRepository->findAll();

        return $this->render('discover.html.twig', [
            'medias' => $medias,
            'categories' => $categories
        ]);
    }

    #[Route('/category/{id}', name: 'show_category')]
    public function show_category(Category $category, MediaRepository $mediaRepository): Response
    {
        $trendings = $mediaRepository->findTrendingMedias(3, category: $category);

        return $this->render('category.html.twig', [
            'category' => $category,
            'trendings' => $trendings,
        ]);
    }

}