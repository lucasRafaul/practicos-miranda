<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name:'home')]
    public function homeAction(): Response
    {
        return new Response(
            '<html><body>
            <h1>"Home Inicial" </h1>
            </body><html>'
        );
    }
    #[Route('/saludo/{nombre}', name:'saludo')]
    public function saludo(string $nombre): Response
    {
        return new Response(
            '<html><body><h1> Hola! ' . $nombre . ' Bienvenido!</h1><a href="/despedida/' . $nombre . '">ir a despedida</a></body></html>'
            
        );
    }
    #[Route('/despedida/{nombre}', name:'despedida')]
    public function despedida(string $nombre): Response
    {
        return new Response(
            '<html><body><h1> Hola! ' . $nombre . ' Nos vemos!</h1></body></html>' 
        );
    }  


    #[Route('/estado/{nombre}/{estado}', name:'estado de animo')]
    public function estadoDeAnimo(string $nombre, string $estado): Response
    {
        if($estado){
            return new Response(
                '<html><body><h1> Hola ' . $nombre . ' veo que hoy estas ' . $estado . '</h1></body></html>' 
            );
        }else{ 
            return new Response(
                '<html><body><h1> Hola ' . $nombre . ' como estas hoy? </h1></body></html>'
            );

        }
        
    }  
    #[Route('/registro', name:'RegistroUsuario')]
    public function registro(Request $request): Response
    {
        if($request->isMethod('POST')){
            $nombre = $request->get('nombre');
            $apellido = $request->get('apellido');
            return new Response("<h1>Hola! $nombre $apellido! </h1>");
        }

        return new Response('
        <form method="POST">
        <label> Nombre: <input name="nombre" /></input><br>
        <label> Apellido: <input name="apellido" /></input><br>
        <button type="submit">Saludos</button>
        </form>
        ');
        
    }
    #[Route('/api/usuario/{id}', name:'usuario_random')]
    public function usuarioRandom(int $id): Response
    {
        $nombres = ['id'=> 0, 'nombre'=> 'Lucas'];
        return $this->json($nombres);
        
    }  
    #[Route('/mayoria/{edad}', name:'mayoria_edad')]
    public function mayorEdad(int $edad): Response
    {
        if($edad >= 18){
            return new Response("<h1>Hola, eres mayor de edad! juju $edad </h1>");
        }else{
            return new Response("<h1>Hola, no eres mayor de edad, vete de aqui!  $edad </h1>");
        }
        
    }  
}

?>