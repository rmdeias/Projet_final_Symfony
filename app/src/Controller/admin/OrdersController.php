<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrdersController extends AbstractController
{
    #[Route('/orders', name: 'orders')]
    public function index()
    {
        return $this->render('Components/admin/orders/orders.html.twig');
    }
}
