<?php

namespace App\Controller\admin;

use App\Entity\PaymentMethod;
use App\Form\PaymentType;
use App\Repository\PaymentMethodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;


#[Route("/admin2/payments")]
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
    public function new(Request $request, PersistenceManagerRegistry $doctrine)
    {
        $payment = new PaymentMethod();

        $form = $this->createForm(PaymentType::class, $payment);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){

            $em = $doctrine->getManager();
            $em->persist($payment);
            $em->flush($payment);

            $this->addFlash(
                'success',
                'Une nouvelle méthode paiement a été ajoutée !'
            );

            return $this->redirectToRoute('admin_payments');
        }

        return $this->render('Components/admin/payments/new_update_payment.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/update/{id}', name: 'admin_payments_update')]
    public function update($id, PaymentMethodRepository $paymentMethodRepository, Request $request, PersistenceManagerRegistry $doctrine)
    {
        $payment = $paymentMethodRepository->find($id);

        $form = $this->createForm(PaymentType::class, $payment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $doctrine->getManager();
            $em->persist($payment);
            $em->flush($payment);

            $this->addFlash(
                'success',
                'La méthode de paiement a été modifiée !'
            );

            return $this->redirectToRoute('admin_payments_update', [
                'id' => $payment->getId()
            ]);

        }

        return $this->render('Components/admin/payments/new_update_payment.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_payments_delete')]
    public function delete($id, PaymentMethodRepository $paymentMethodRepository)
    {
        $payment = $paymentMethodRepository->find($id);

        return $this->render('Components/admin/payments/new_update_payment.html.twig');
    }
}
