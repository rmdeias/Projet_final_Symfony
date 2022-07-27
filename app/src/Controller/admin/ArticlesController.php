<?php

namespace App\Controller\admin;

use App\Entity\Article;
use App\Entity\VariationArticle;
use App\Form\ArticleType;
use App\Form\UpdateArticleType;
use App\Repository\ArticleRepository;
use App\Repository\ArticleVariationRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\VariationArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin/articles")]
class ArticlesController extends AbstractController
{
    #[Route('/', name: 'admin_articles')]
    public function list(ArticleVariationRepository $variationArticleRepository)
    {
        // !!! On récupère les variations d'articles
        $v_articles = $variationArticleRepository->findAll();

        return $this->render('Components/admin/articles/articles.html.twig',[ 
            'v_articles' => $v_articles,
        ]);
    }

    #[Route('/new', name: 'admin_article_new')]
    public function new(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //On va créer x variation d'article défini dans l'entité
        }

        return $this->render('Components/admin/articles/new_update_article.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);
    }

    #[Route('/update/{id}', name: 'admin_update_article')]
    public function update(Article $article, Request $request)
    {
        $type = "udpate";

        $form = $this->createForm(UpdateArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
        }

        return $this->render('Components/admin/articles/new_update_article.html.twig', [
            'article' => $article,
            'type' => $type,
            'form' => $form->createView()
        ]);
    }

    #[Route('/stock/{id}', name: 'admin_stock_variation_article')]
    public function stock(ArticleVariationRepository $variationArticle)
    {
        return $this->render('Components/admin/articles/stock_article.html.twig', [
            'variationArticle' => $variationArticle
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_delete_article')]
    public function delete(Article $article)
    {
        
    }
}
