<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'articles')]
    public function index()
    {
        return $this->render('Components/admin/articles/articles.html.twig');
    }
}
