<?php
namespace App\Librerias;

class apiReniec 
{
  protected $dni;
  function __construct(){
    $this->dni = new DNI('rHYk4dXjCOTRLnDbm26YyrqXvpLWGzheYkzORGDR');
  }
  public function buscarDNI($numero){
    return $this->dni->get($numero, true);
  }
}
