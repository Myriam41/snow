<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AuthentificationController extends AbstractController
{
    /**
     * @Route("/authentification", name="authentification")
     */
    public function index ()
    {
        return $this->render('authentification/index.html.twig', [
            'controller_name' => 'AuthentificationController',
        ]);
    }

    /**
     * @Route("/inscription", name="authentification_registration")
     */
    public function registration (Request $request, ObjectManager $manager, 
    UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hach = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hach);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('authentification_connexion');
        }

        return $this->render('authentification/registration.html.twig', [ 
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="authentification_connexion")
     */
    public function online ()
    {
        return $this->render('authentification/online.html.twig');
    }

    /**
     * @Route("/deconnexion", name="authentification_deconnexion")
     */
    public function logout () {}

}
