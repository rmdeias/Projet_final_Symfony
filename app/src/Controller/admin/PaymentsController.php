<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PaymentsController extends AbstractController
{
    #[Route('/payments', name: 'payments')]
    public function index()
    {
        return $this->render('Components/admin/payments/payments.html.twig');
    }
}
