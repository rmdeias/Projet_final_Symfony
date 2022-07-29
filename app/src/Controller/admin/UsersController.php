<?php

namespace App\Controller\admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

#[Route("/admin/users")]
class UsersController extends AbstractController
{
    #[Route('/', name: 'admin_users')]
    public function list(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();

        return $this->render('Components/admin/users/users.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/new', name: 'admin_users_new')]
    public function new(Request $request, PersistenceManagerRegistry $doctrine)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush($user);

            $this->addFlash(
                'success',
                'Un nouvel utilisateur a été crée !'
            );

            return $this->redirectToRoute('admin_users');

        }

        return $this->render('Components/admin/users/new_update_user.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/update/{id}', name: 'admin_users_update')]
    public function update($id, UserRepository $userRepository, Request $request)
    {
        $user = $userRepository->find($id);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

        }

        return $this->render('Components/admin/users/new_update_user.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_users_delete')]
    public function delete($id, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);

        return $this->render('Components/admin/users/users.html.twig', [
        ]);
    }
}
