<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Form\TrickType;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\TricksRepository;
use Symfony\Component\HttpFoundation\Request;
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
    public function addTrick(Request $request)
    {   
        $Trick = new Tricks();
        $formTrick = $this->createForm(TrickType::class, $Trick);
 

       // $Trick->setName();
       // $Trick->setType();
       // $Trick->setDescription();
       // $Trick->setImage();
       $formTrick->handleRequest($request);

       if ($formTrick->isSubmitted() && $formTrick->isValid()) {
           $manager = $this->getDoctrine()->getmanager();
           $manager->persist($Trick);
           $manager->flush();
   
           return $this->redirectToRoute('showTrick', [
               'id' => $Trick->getId()
           ]);

           return new Response('Le nouveau Trick a bien été enregistré');
           }
        else {
            return $this->redirectToRoute('home');
            return new Response('Aucun nouveau Trick a été enregistré');
        }
     //   return $this->render('tricks/trick.html.twig', [
        //    'controller_name' => 'TricksController', 'Trick'=> $Trick
      //  ]);
    }
}
