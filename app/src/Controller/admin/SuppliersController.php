<?php

namespace App\Controller\admin;

use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
#[Route("/admin/suppliers")]
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
    public function new()
    {
        return $this->render('Components/admin/suppliers/new_update_supplier.html.twig', [
        ]);
    }

    #[Route('/update/{id}', name: 'admin_suppliers_update')]
    public function update(SupplierRepository $supplierRepository, $id)
    {
        $supplier = $supplierRepository->find($id);
        return $this->render('Components/admin/suppliers/new_update_supplier.html.twig', [
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_suppliers_delete')]
    public function delete(SupplierRepository $supplierRepository, $id)
    {
        $supplier = $supplierRepository->find($id);
    }
}
