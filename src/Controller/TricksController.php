<?php

namespace App\Controller;

use App\Entity\Tricks;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TricksController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $repo = $this->getDoctrine()->getRepository(Tricks::class);
        
        $Tricks = $repo->findAll();

        return $this->render('tricks/home.html.twig', [
            'controller_name' => 'TricksController', 'Tricks'=>$Tricks  
        ]);
    }
    /**
     * @Route("trick/{id}", name="showTrick")
     */
    public function show($id)
    {   
        $repo = $this->getDoctrine()->getRepository(Tricks::class);
        
        $Trick = $repo->find($id);

        return $this->render('tricks/trick.html.twig', [
            'controller_name' => 'TricksController', 'Trick'=> $Trick
        ]);
    }
}
