<?php
 namespace App\Controller;
 use App\Entity\Pais;
 use App\Form\PaisType;
 use App\Repository\PaisRepository;
 use Doctrine\ORM\EntityManagerInterface;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Attribute\Route;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 
 
 class PaisController extends AbstractController
{
    #[Route('/pais', name: 'pais_index', methods: ['GET'])]
   public function index(PaisRepository $paisRepository): Response
   {
       return $this->render('pais/index.html.twig', [
           'paises' => $paisRepository->findAll(),
       ]);
   }


   #[Route('/pais/new', name: 'app_pais_new')]
   public function new(Request $request, EntityManagerInterface $entityManager): Response
   {
       $pais = new Pais();
       $form = $this->createForm(PaisType::class, $pais);
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
           $entityManager->persist($pais);
           $entityManager->flush();
           return $this->redirectToRoute('pais_index', [], Response::HTTP_SEE_OTHER);
       }
      
       return $this->render('pais/new.html.twig', [
           'form' => $form->createView(),
           'pais' => $pais,
       ]);
   }
    
}

?>