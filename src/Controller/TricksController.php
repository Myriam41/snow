<?php

namespace App\Controller;

use App\Entity\Tricks;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\TricksRepository;
use Symfony\Component\HttpFoundation\Response;

class TricksController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(TricksRepository $repo)
    {
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

     /**
     * @Route("addtrick/", name="addTrick")
     */
    public function addTrick()
    {   
        $manager = $this->getDoctrine()->getmanager();
        
        $Trick = new Tricks();
        $Trick->setDescription();
        $Trick->setImage();
        $Trick->setName();
        $Trick->setSwitch();
        $Trick->setType();

        $manager->persist($Trick);

        $manager->flush();

        return new Response('Le nouveau Trick  bien été enregistré');

     //   return $this->render('tricks/trick.html.twig', [
        //    'controller_name' => 'TricksController', 'Trick'=> $Trick
      //  ]);
    }
}
