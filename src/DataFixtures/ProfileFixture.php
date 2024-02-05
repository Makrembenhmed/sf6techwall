<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfileFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $profile = new Profile();
        $profile->setRs('facebook');
        $profile->setUrl('facebook\makrem\bnhmed');
        

        $profile1 = new Profile();
        $profile1->setRs('twitter');
        $profile1->setUrl('twiter\makrem\bnhmed');

        $profile2 = new Profile();
        $profile2->setRs('github');
        $profile2->setUrl('github\makrem\bnhmed');


        $profile3 = new Profile();
        $profile3->setRs('linkedln');
        $profile3->setUrl('linkedln\makrem\bnhmed');

        $manager->persist($profile);
        $manager->persist($profile1);
        $manager->persist($profile2);
        $manager->persist($profile3);


        $manager->flush();
    }
}
