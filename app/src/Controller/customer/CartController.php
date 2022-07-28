<?php

namespace App\Controller\customer;

use App\Entity\CustomerOrder;
use App\Form\CartType;
use App\Repository\CustomerOrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartController extends AbstractController
{
    #[Route('/', name: 'customer_cart')]
    public function cart(CustomerOrderRepository $customerOrderRepository, Request $request)
    {
        $cart = $customerOrderRepository->findOneBy([
            'user' => $this->getUser(),
            'statut' => CustomerOrder::STATUS_CART
        ]);

        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //On va créer x variation d'article défini dans l'entité
        }


        return $this->render('Components/customer/cart/cart.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
