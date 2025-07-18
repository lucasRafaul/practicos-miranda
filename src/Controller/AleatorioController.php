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
        $indiceAleatorio = array_rand($nombres);
        $nombreAleatorio = $nombres[$indiceAleatorio];

        return new Response(
            "<html><body>
            <h1>Hola! $nombreAleatorio</h1>
            </body></html>"
        );
    }

}


?>