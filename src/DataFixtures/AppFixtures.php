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
        CustomerFactory::new()->createMany(20);
        PhoneFactory::new()->createMany(50);
        ResellerFactory::new()->createMany(10);

        $manager->flush();
    }
}
