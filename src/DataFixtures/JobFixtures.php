<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data=["information",
        "developpeur",
        "etudiant",
        "serveure",
        "gestionnaire",
        "Musicien",
        "photografiste",
        "manager",
        "chef atelier",
        "tolier",];
        for($i=0;$i<(count($data));$i++){
            $job= new Job();
            $job->setDesignation($data[$i]);
            $manager->persist($job);
    
    
        }
        $manager->flush();
    
            
        



    }
}
