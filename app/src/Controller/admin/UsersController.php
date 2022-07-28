<?php

namespace App\Controller\admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function new()
    {
        return $this->render('Components/admin/users/new_update_user.html.twig', [
        ]);
    }

    #[Route('/update/{id}', name: 'admin_users_update')]
    public function update($id, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);

        return $this->render('Components/admin/users/new_update_user.html.twig', [
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
