<?php

namespace App\Controller;

use App\Form\ProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route("/profile")]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'app_profile')]
    public function profile(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           $em = $this->$this->getDoctrine()->getManager();

           $em->persist($user);
           $em->flush();

           $this->addFlash(
                'success',
                'Votre profile a bien été modifié !'
            );

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('Components/profile/profile.html.twig',[
            'form' => $form->createView()
        ]);
    }

}
