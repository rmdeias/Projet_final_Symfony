<?php

namespace App\Controller\customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home_customer', name: 'home_customer')]
    public function index()
    {
        return $this->render('Components/customer/home/home_customer.html.twig');
    }
}
