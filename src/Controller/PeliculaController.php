<?php

namespace App\Controller;

use App\Repository\PeliculaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PeliculaController extends AbstractController
{
    #[Route('/pelicula', name: 'app_pelicula', methods: ['GET'])]
    public function index(PeliculaRepository $peliculaRepository): Response
    {
        return $this->render('pelicula/index.html.twig', [
            'peliculas' => $peliculaRepository->findAll(),
        ]);
    }


    //ruta para el estreno de peliculas por anio
     #[Route('/peliculas/estreno/{año}', name: 'peliculas_por_anio')]
    public function porAnio(PeliculaRepository $peliculaRepository, int $año): Response
    {
        $peliculas = $peliculaRepository->findBy(['añoEstreno' => $año]);

        return $this->render('pelicula/index.html.twig', [
            'peliculas' => $peliculas,
        ]);
    }

    // filtrado de peliculas por la primera letra del nombre
    #[Route('/peliculas/letra/{letra}', name: 'peliculas_por_letra')]
    public function porLetra(PeliculaRepository $peliculaRepository, string $letra): Response
    {
        $qb = $peliculaRepository->createQueryBuilder('p')
            ->where('p.nombre LIKE :letra')
            ->setParameter('letra', $letra.'%')
            ->orderBy('p.nombre', 'ASC');

        $peliculas = $qb->getQuery()->getResult();

        return $this->render('pelicula/index.html.twig', [
            'peliculas' => $peliculas,
        ]);
    }

    #[Route('/peliculas/por-director', name: 'peliculas_por_director')]
    public function peliculasPorDirector(PeliculaRepository $peliculaRepository): Response
    {
        $peliculas = $peliculaRepository->createQueryBuilder('p')
            ->leftJoin('p.director', 'd')
            ->addSelect('d')
            ->orderBy('d.nombre', 'ASC')
            ->addOrderBy('p.nombre', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('pelicula/directores.html.twig', [
            'peliculas' => $peliculas,
        ]);
}

}
