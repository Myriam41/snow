<?php

namespace App\DataFixtures;

use App\Entity\Tricks;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TricksFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1 ; $i <=10 ; $i++){
            $tricks = new Tricks();
            $tricks ->setTitle("titre de l'article n°$i")
                    ->setContent("contenu de l'article $i")
                    ->setImage("http://placehold.it/350/150")
                    ->setCreatedAt( new  \DataTime());
        }

        $manager->flush();
    }
}
