<?php

namespace App\DataFixtures;

use App\Factory\CustomerFactory;
use App\Factory\PhoneFactory;
use App\Factory\ResellerFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        ResellerFactory::new()->createMany(10);
        CustomerFactory::new()->createMany(50);
        PhoneFactory::new()->createMany(50);
       

        $manager->flush();
    }
}
