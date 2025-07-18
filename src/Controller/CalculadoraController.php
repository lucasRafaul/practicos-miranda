<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\CalculadoraService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CalculadoraController extends AbstractController
{
    #[Route('/calcular', name:'calculadora')]
    public function calcular(CalculadoraService $calculadora_service ): Response
    {   
        $n1 = 10;
        $n2 = 5;
        $suma = $calculadora_service->suma($n1,$n2);
        $resta = $calculadora_service->resta($n1,$n2);
        $multiplicacion = $calculadora_service->multi($n1,$n2);
        $division = $calculadora_service->divi($n1,$n2);
        return new Response(
            "<h1>suma: $suma . resta: $resta . multiplicacion: $multiplicacion . division: $division</h1>"
        );
    }
    
}


?>