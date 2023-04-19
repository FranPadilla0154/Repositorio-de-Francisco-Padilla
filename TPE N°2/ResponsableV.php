<?php

class ResponsableV {

    //Atributos
    private $numeroEmpleado;
    private $numeroLicencia;
    private $nombre;
    private $apellido;

    //Métodos
    public function __construct($numeroEmpleado, $numeroLicencia, $nombre, $apellido){
        $this->numeroEmpleado = $numeroEmpleado;
        $this->numeroLicencia = $numeroLicencia;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    public function setNumeroEmpleado($numeroEmpleado){
        $this->numeroEmpleado = $numeroEmpleado;
    }

    public function getNumeroEmpleado(){
        return $this->numeroEmpleado;
    }

    public function setNumeroLicencia($numeroLicencia){
        $this->numeroLicencia = $numeroLicencia;
    }

    public function getNumeroLicencia(){
        return $this->numeroLicencia;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function __toString(){
        return "Nombre: " . $this->getNombre() . "\nApellido: " . $this->getApellido() . "\nNúmero de empleado: " . $this->getNumeroEmpleado() . "\nNúmero de licencia: " . $this->getNumeroLicencia() . "\n";
    }
}

?>