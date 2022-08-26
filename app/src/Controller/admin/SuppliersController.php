<?php

namespace App\Controller\admin;

use App\Entity\Supplier;
use App\Form\SupplierType;
use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
#[Route("/admin2/suppliers")]
class SuppliersController extends AbstractController
{
    #[Route('/', name: 'admin_suppliers')]
    public function list(SupplierRepository $supplierRepository)
    {
        $suppliers = $supplierRepository->findAll();

        return $this->render('Components/admin/suppliers/suppliers.html.twig', [
            'suppliers' => $suppliers
        ]);
    }

    #[Route('/new', name: 'admin_suppliers_new')]
    public function new(Request $request, PersistenceManagerRegistry $doctrine)
    {
        $supplier = new Supplier();
        $form = $this->createForm(SupplierType::class, $supplier);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $doctrine->getManager();
            $em->persist($supplier);
            $em->flush($supplier);

            $this->addFlash(
                'success',
                'Un nouvelle fournisseur a été crée !'
            );

            return $this->redirectToRoute('admin_suppliers');

        }

        return $this->render('Components/admin/suppliers/new_update_supplier.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/update/{id}', name: 'admin_suppliers_update')]
    public function update(Request $request, SupplierRepository $supplierRepository, $id, PersistenceManagerRegistry $doctrine)
    {
        $supplier = $supplierRepository->find($id);

        $form = $this->createForm(SupplierType::class, $supplier);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $doctrine->getManager();
            $em->persist($supplier);
            $em->flush($supplier);

            $this->addFlash(
                'success',
                'Le fournisseur a été modifié !'
            );

            return $this->redirectToRoute('admin_suppliers_update', [
                'id' => $supplier->getId()
            ]);

        }

        return $this->render('Components/admin/suppliers/new_update_supplier.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_suppliers_delete')]
    public function delete(SupplierRepository $supplierRepository, $id)
    {
        $supplier = $supplierRepository->find($id);
    }
}
