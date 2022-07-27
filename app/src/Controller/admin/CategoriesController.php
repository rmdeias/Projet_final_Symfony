<?php

namespace App\Controller\admin;

use App\Repository\CategorieRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
#[Route("/admin/category")]
class CategoriesController extends AbstractController
{
    #[Route('/', name: 'admin_category')]
    public function list(CategoryRepository $categorieRepository)
    {
        $categories = $categorieRepository->findAll();

        return $this->render('Components/admin/categories/categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/new', name: 'admin_category_new')]
    public function new(CategoryRepository $categorieRepository)
    {
        
        return $this->render('Components/admin/categories/new_update_category.html.twig', [
            
        ]);
    }

    #[Route('/delete', name: 'admin_category_delete')]
    public function delete(CategoryRepository $categorieRepository)
    {
        
    }
}
