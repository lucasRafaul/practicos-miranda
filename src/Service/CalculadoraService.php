<?php
namespace App\Service;

class CalculadoraService
{
   public function suma($n1, $n2): int
   {    
    $resultado = $n1 + $n2;
   return $resultado;
   }
   public function resta($n1, $n2): int
   {
    $resultado = $n1 - $n2;
    return $resultado;
   }
   public function multi($n1, $n2): float
   {
    $resultado = $n1 * $n2;
    return $resultado;
   }
   public function divi($n1, $n2): float
   {
    $resultado = $n1 / $n2;
    return $resultado;
   }
}











?>