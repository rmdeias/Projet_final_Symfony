<?php

namespace App\Controller\admin;

use App\Repository\CustomerOrderRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
#[Route("/admin/orders")]
class OrdersController extends AbstractController
{
    #[Route('/', name: 'admin_orders')]
    public function list(CustomerOrderRepository $commandeRepository)
    {

        $orders = $commandeRepository->findAll();

        return $this->render('Components/admin/orders/orders.html.twig', [
            'orders' => $orders
        ]);
    }

    #[Route('/take-order/{id}', name: 'admin_take_order')]
    public function takeOrder($id, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);
        
        return $this->render('Components/admin/orders/take_order.html.twig', [
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_order_delete')]
    public function delete($id, CustomerOrderRepository $customerOrderRepository)
    {
        $order = $customerOrderRepository->find($id);
    }
}
