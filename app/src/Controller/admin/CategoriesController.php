<?php

namespace App\Controller\admin;

use App\Entity\Category;
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

    #[Route('/update/{id}', name: 'admin_category_update')]
    public function update($id, CategoryRepository $categorieRepository)
    {
        $category = $categorieRepository->find($id);
        return $this->render('Components/admin/categories/new_update_category.html.twig', [
            
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_category_delete')]
    public function delete($id, CategoryRepository $categorieRepository)
    {
        $category = $categorieRepository->find($id);
    }
}
