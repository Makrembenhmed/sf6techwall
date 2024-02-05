<?php

namespace App\DataFixtures;

use App\Entity\Hobby;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HobbyFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data=["YOGA",
        "Foot",
        "Etude",
        "developmnt",
        "Dormir",
        "Music",
        "dessin",
        "manger",
        "photografie",
        "langue",];
        for($i=0;$i<(count($data));$i++){
            $hobbi= new Hobby();
            $hobbi->setDesignation($data[$i]);
            $manager->persist($hobbi);
    
    
        }
        $manager->flush();
    
            
        

        
    }
}
