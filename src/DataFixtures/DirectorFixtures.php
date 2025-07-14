<?php

namespace App\DataFixtures;

use App\Entity\Director;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DirectorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $director1 = new Director();
        $director1->setNombre('Christopher Nolan');
        $manager->persist($director1);

        $director2 = new Director();
        $director2->setNombre('Sofia Coppola');
        $manager->persist($director2);

        $director3 = new Director();
        $director3->setNombre('Quentin Tarantino');
        $manager->persist($director3);

        // Guardamos en la base
        $manager->flush();

        // Almacenar referencias para las Peliculas
        $this->addReference('director_nolan', $director1);
        $this->addReference('director_coppola', $director2);
        $this->addReference('director_tarantino', $director3);
    }
}
