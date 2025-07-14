<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AleatorioController
{
    #[Route('/aleatorio', name:'aleatorio')]
    public function saludoAleatorio(): Response
    {
        $nombres = array('Lucas','Anna','Leonardo','Messi','Julian','Karol','Bad Bunny');
        $nombresAleatorios = array_rand($nombres);
        return new Response(
            "<html><body>
            <h1>Hola!  $nombresAleatorios</h1>
            </body><html>"
        );
    }
}


?>