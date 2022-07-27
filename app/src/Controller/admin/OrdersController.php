<?php

namespace App\Controller\admin;

use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
#[Route("/admin/orders")]
class OrdersController extends AbstractController
{
    #[Route('/', name: 'admin_orders')]
    public function list(CommandeRepository $commandeRepository)
    {

        $orders = $commandeRepository->findAll();

        return $this->render('Components/admin/orders/orders.html.twig', [
            'orders' => $orders
        ]);
    }

    #[Route('/take-order', name: 'admin_take_order')]
    public function takeOrder(CommandeRepository $commandeRepository)
    {

        return $this->render('Components/admin/orders/orders.html.twig', [
        ]);
    }
}
