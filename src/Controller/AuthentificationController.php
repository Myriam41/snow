<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Form\RegistrationType;


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
    public function registration ()
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class);

        return $this->render('authentification/registration.html.twig', [ 
            'form' =>$form->createView()
        ]);
    }

     /**
     * @Route("/connexion", name="authentification_connexion")
     */
    public function online ()
    {
        $user = new User();
        $formAuth = $this->createForm(RegistrationType::class);

        return $this->render('authentification/online.html.twig', [ 
            'form' =>$formAuth->createView()
        ]);
    }
}
