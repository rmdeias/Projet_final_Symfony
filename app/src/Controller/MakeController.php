<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MakeController extends AbstractController
{
    #[Route('/', name: 'app_make')]
    public function index()
    {
        return $this->render('Components/admin/articles/new_update_article.html.twig');
    }
}
