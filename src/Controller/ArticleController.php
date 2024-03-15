<?php

namespace App\Controller;

use App\Entity\Article; // Assurez-vous d'importer correctement la classe Article
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/article')]
class ArticleController extends AbstractController
{
    #[Route('/', name: 'app_article')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/{id}', name: 'article_show')]
    public function show(Article $article): Response // Assurez-vous que le type de l'argument est Article
    {
        $category = $article->getCategory();
        
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'category' => $category,
        ]);
    }
}
