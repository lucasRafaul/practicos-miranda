<?php

namespace App\Controller;

use App\Entity\Departamento;
use App\Form\DepartamentoType;
 use App\Repository\DepartamentoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;

final class DepartamentoController extends AbstractController
{
    #[Route('/departamento', name: 'app_departamento')]
    public function index(DepartamentoRepository $departamentoRepository): Response
    {
        return $this->render('departamento/index.html.twig', [
            'departamentos' => $departamentoRepository->findAll(),
        ]);
}

    #[Route('/departamento/new', name: 'departamento_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $departamento = new Departamento();

        $form = $this->createForm(DepartamentoType::class, $departamento);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($departamento);
            $em->flush();

            return $this->redirectToRoute('app_departamento'); // Cambia por tu ruta de listado
        }

        return $this->render('departamento/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
