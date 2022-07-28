<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin")]
class HomeController extends AbstractController
{
    #[Route('/', name: 'admin_home')]
    public function index()
    {
        return $this->render('Components/admin/home/home_admin.html.twig');
    }
}
