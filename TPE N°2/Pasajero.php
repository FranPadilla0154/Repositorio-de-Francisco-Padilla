<?php

class Pasajero {

    //Atributos
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;

    //Métodos
    public function __construct($nombre, $apellido, $dni, $telefono){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->telefono = $telefono;
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

    public function setNumeroDocumento($dni){
        $this->dni = $dni;
    }

    public function getNumeroDocumento(){
        return $this->dni;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function __toString(){
        return "Nombre: " . $this->getNombre() . "\nApellido: " . $this->getApellido() . "\nNúmero de documento: " . $this->getNumeroDocumento() . "\nNúmero de teléfono: " . $this->getTelefono() . "\n";
    }
}

?>