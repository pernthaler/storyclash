<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $johnDoe = new User();
        $johnDoe->setFirstName('John');
        $johnDoe->setLastName('Doe');
        $johnDoe->setAvatar('/examples/john-doe.jpeg');
        $manager->persist($johnDoe);

        $lisaLink = new User();
        $lisaLink->setFirstName('Lisa');
        $lisaLink->setLastName('Link');
        $lisaLink->setAvatar('/examples/lisa-link.jpeg');
        $manager->persist($lisaLink);

        $harrySamson = new User();
        $harrySamson->setFirstName('Harry');
        $harrySamson->setLastName('Samson');
        $harrySamson->setAvatar('/examples/harry-samson.jpeg');
        $manager->persist($harrySamson);

        $peterSmith = new User();
        $peterSmith->setFirstName('Peter');
        $peterSmith->setLastName('Smith');
        $peterSmith->setAvatar('/examples/peter-smith.jpeg');
        $manager->persist($peterSmith);

        $manager->flush();
    }
}
