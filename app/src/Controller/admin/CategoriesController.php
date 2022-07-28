<?php

namespace App\Controller\admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategorieRepository;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function new(CategoryRepository $categorieRepository, Request $request, PersistenceManagerRegistry $doctrine)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $doctrine->getManager();
            $em->persist($category);
            $em->flush($category);

            $this->addFlash(
                'success',
                'Une nouvelle catégorie a été ajoutée !'
            );

            return $this->redirectToRoute('admin_category');

        }
        
        return $this->render('Components/admin/categories/new_update_category.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/update/{id}', name: 'admin_category_update')]
    public function update($id, CategoryRepository $categorieRepository, Request $request, PersistenceManagerRegistry $doctrine)
    {
        $category = $categorieRepository->find($id);

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($category);
            $em->flush($category);

            $this->addFlash(
                'success',
                'La catégorie a été mise à jour !'
            );

        }

        return $this->render('Components/admin/categories/new_update_category.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_category_delete')]
    public function delete($id, CategoryRepository $categorieRepository)
    {
        $category = $categorieRepository->find($id);
    }
}
