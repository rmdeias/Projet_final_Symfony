<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\ArticleVariation;
use App\Entity\Category;
use App\Entity\CustomerOrder;
use App\Entity\PaymentMethod;
use App\Entity\Supplier;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ){
      
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(ArticleCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Projet Cloud Campus');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::section('Gestion des articles');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Créer un produit', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les produits', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_INDEX),
        ]);

        yield MenuItem::section('Gestion catégories');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Créer une catégorie', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les catégories', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_INDEX),
        ]);

        yield MenuItem::section('Gestion des fournisseurs');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Créer un fournisseur', 'fas fa-plus', Supplier::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les fournisseurs', 'fas fa-plus', Supplier::class)->setAction(Crud::PAGE_INDEX),
        ]);

        yield MenuItem::section('Gestion des utilisateurs');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Créer un utilisateur', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les utilisateurs', 'fas fa-plus', User::class)->setAction(Crud::PAGE_INDEX),
        ]);

        yield MenuItem::section('Gestion des moyens de paiement');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Créer un moyen de paiement', 'fas fa-plus', PaymentMethod::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les moyens de paiement', 'fas fa-plus', PaymentMethod::class)->setAction(Crud::PAGE_INDEX),
        ]);

        yield MenuItem::section('Gestion des commandes');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Voir les commanndes', 'fas fa-plus', CustomerOrder::class)->setAction(Crud::PAGE_INDEX),
        ]);
/*
        yield MenuItem::subMenu('Variation de produit', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Créer une variation de produit', 'das fa-plus', ArticleVariation::class)->setAction(Crud::PAGE_NEW)
        ]);
*/
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
