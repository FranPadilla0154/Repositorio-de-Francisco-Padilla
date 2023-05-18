<?php

class Pasajero {

    //Atributos
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;
    private $numAsiento;
    private $numTicket;

    //Métodos
    public function __construct($nombre, $apellido, $dni, $telefono, $numAsiento, $numTicket){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->telefono = $telefono;
        $this->numAsiento = $numAsiento;
        $this->numTicket = $numTicket;
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

    public function getNumAsiento(){
        return $this->numAsiento;
    }

    public function setNumAsiento($numAsiento){
        $this->numAsiento = $numAsiento;
    }

    public function getNumTicket(){
        return $this->numTicket;
    }

    public function setNumTicket($numTicket){
        $this->numTicket = $numTicket;
    }

    public function __toString(){
        return "Nombre: " . $this->getNombre() . "\nApellido: " . $this->getApellido() . "\nNúmero de documento: " . 
        $this->getNumeroDocumento() . "\nNúmero de teléfono: " . $this->getTelefono() . "\nNúmero de asiento: " . 
        $this->getNumAsiento() . "\nNúmero de ticket: " . $this->getNumTicket() . "\n";
    }

    public function darPorcentajeIncremento(){
        return 1.1;
    }
}

?>