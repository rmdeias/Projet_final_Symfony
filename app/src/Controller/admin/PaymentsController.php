<?php

namespace App\Controller\admin;

use App\Repository\PaymentMethodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


#[Route("/admin/payments")]
class PaymentsController extends AbstractController
{
    #[Route('/', name: 'admin_payments')]
    public function list(PaymentMethodRepository $paymentMethodRepository)
    {
        $payments = $paymentMethodRepository->findAll();
        return $this->render('Components/admin/payments/payments.html.twig', [
            'payments' => $payments,
        ]);
    }

    #[Route('/new', name: 'admin_payments_new')]
    public function new()
    {
        return $this->render('Components/admin/payments/new_update_payment.html.twig');
    }

    #[Route('/update/{id}', name: 'admin_payments_update')]
    public function update($id, PaymentMethodRepository $paymentMethodRepository)
    {
        $payment = $paymentMethodRepository->find($id);

        return $this->render('Components/admin/payments/new_update_payment.html.twig');
    }

    #[Route('/delete/{id}', name: 'admin_payments_delete')]
    public function delete($id, PaymentMethodRepository $paymentMethodRepository)
    {
        $payment = $paymentMethodRepository->find($id);

        return $this->render('Components/admin/payments/new_update_payment.html.twig');
    }
}
