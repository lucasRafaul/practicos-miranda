<?php

namespace App\DataFixtures;

use App\Entity\Pelicula;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PeliculaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $p1 = new Pelicula();
        $p1->setNombre('Inception');
        $p1->setAñoEstreno(new \DateTime('2010-01-01'));
        $p1->setDirector($this->getReference('director_nolan'));
        $manager->persist($p1);

        $p2 = new Pelicula();
        $p2->setNombre('Lost in Translation');
        $p2->setAñoEstreno(new \DateTime('2003-01-01'));
        $p2->setDirector($this->getReference('director_coppola'));
        $manager->persist($p2);

        $p3 = new Pelicula();
        $p3->setNombre('Pulp Fiction');
        $p3->setAñoEstreno(new \DateTime('1994-01-01'));
        $p3->setDirector($this->getReference('director_tarantino'));
        $manager->persist($p3);

        // Película sin director
        $p4 = new Pelicula();
        $p4->setNombre('Sin Director 1');
        $p4->setAñoEstreno(new \DateTime('2001-01-01'));
        $p4->setDirector(null);
        $manager->persist($p4);

        $p5 = new Pelicula();
        $p5->setNombre('Sin Director 2');
        $p5->setAñoEstreno(new \DateTime('2005-01-01'));
        $p5->setDirector(null);
        $manager->persist($p5);

        $p6 = new Pelicula();
        $p6->setNombre('Reservoir Dogs');
        $p6->setAñoEstreno(new \DateTime('1992-01-01'));
        $p6->setDirector($this->getReference('director_tarantino'));
        $manager->persist($p6);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            DirectorFixtures::class,
        ];
    }
}
