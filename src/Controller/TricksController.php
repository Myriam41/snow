<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TricksController extends AbstractController
{
    /**
     * @Route("/tricks", name="tricks")
     */
    public function liste()
    {
        return $this->render('tricks/home.html.twig', [
            'controller_name' => 'TricksController',
        ]);
    }
}
