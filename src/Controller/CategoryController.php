<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/category')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository, ArticleRepository $articleRepository, Request $request): Response
    {
        $categories = $categoryRepository->findAll();
        $articles = $articleRepository->findAll();

        // Handle any additional logic here if needed

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
            'articles' => $articles,
        ]);
    }
    
    #[Route('/category/{id}', name: 'category_show')]
    public function show(
        Category $category,
    ): Response {
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }
}
