<?php

namespace App\Controller\customer;

use App\Entity\Article;
use App\Entity\ArticleVariation;
use App\Repository\ArticleRepository;
use App\Repository\ArticleVariationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/article')]
class ArticleController extends AbstractController
{
    #[Route('/{id}', name: 'article_id')]
    public function article($id, ArticleRepository $articleRepository)
    {
        $article = $articleRepository->find($id);

        return $this->render('Components/customer/article/article.html.twig', [
            'article' => $article
        ]);
    }
}
