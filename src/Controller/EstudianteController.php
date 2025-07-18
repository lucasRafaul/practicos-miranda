<?php
// src/Controller/EstudianteController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EstudianteController extends AbstractController
{
    #[Route('/estudiantes', name: 'app_estudiantes')]
    public function index(): Response
    {
        $estudiantes = [
            ['nombre' => 'Julian', 'nota' => 8],
            ['nombre' => 'Luis Rafaul', 'nota' => 5],
            ['nombre' => 'Lucas Rafaul', 'nota' => 9],
        ];

        return $this->render('estudiantes/index.html.twig', [
            'estudiantes' => $estudiantes,
        ]);
    }

    #[Route('/cursos', name: 'ver_cursos')]
    public function cursos(): Response
{
    $cursos = [
        '1A' => [
            ['nombre' => 'Luqui', 'nota' => 8],
            ['nombre' => 'Mariano', 'nota' => 5],
        ],
        '2B' => [
            ['nombre' => 'Julieta', 'nota' => 9],
            ['nombre' => 'Martinez', 'nota' => 4],
        ],
    ];

    return $this->render('estudiantes/cursos_por_estudiantes.html.twig', [
        'cursos' => $cursos,
    ]);
}
    #[Route('/estudiantes/vista', name: 'estudiantes_vista')]
    public function vista(): Response
    {
        $estudiantes = [
            ['nombre' => 'Julian Lopez', 'nota' => 8],
            ['nombre' => 'Rogelio Gimenez', 'nota' => 5],
        ];

        return $this->render('estudiantes/vista.html.twig', [
            'estudiantes' => $estudiantes,
        ]);
    }


}

?>