<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\FechaService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FechaController extends AbstractController
{
    #[Route('/fecha', name:'fecha')]
    public function calcular(FechaService $fecha_service ): Response
    {   
        $fecha = $fecha_service->fechaFormateada();
        return new Response(
            "<h1>$fecha </h1>"
        );
    }
    
}


?>