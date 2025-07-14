<?php
namespace App\Service;

class FechaService
{
   public function fechaFormateada(): string
   {    
    return (new \DateTime())->format('H:m:y');
   }
}

?>