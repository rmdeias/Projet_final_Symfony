<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SuppliersController extends AbstractController
{
    #[Route('/suppliers', name: 'suppliers')]
    public function index()
    {
        return $this->render('Components/admin/suppliers/suppliers.html.twig');
    }
}
