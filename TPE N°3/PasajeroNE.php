<?php

include_once 'Pasajero.php';

class PasajeroNE extends Pasajero {

    //Atributos
    private $requiereSillaR;
    private $requiereAsistencia;
    private $requiereComidaEsp;

    //Métodos
    public function __construct($nombre, $apellido, $dni, $telefono, $numAsiento, $numTicket, $requiereSillaR, $requiereAsistencia, $requiereComidaEsp){
        parent :: __construct($nombre, $apellido, $dni, $telefono, $numAsiento, $numTicket);
        $this-> requiereSillaR = $requiereSillaR;
        $this-> requiereAsistencia = $requiereAsistencia;
        $this-> requiereComidaEsp = $requiereComidaEsp;
    }

    public function getRequiereSillaR(){
        return $this->requiereSillaR;
    }

    public function setRequiereSillaR($requiereSillaR){
        $this->requiereSillaR = $requiereSillaR;
    }

    public function getRequiereAsistencia(){
        return $this->requiereAsistencia;
    }

    public function setRequiereAsistencia($requiereAsistencia){
        $this->requiereAsistencia = $requiereAsistencia;
    }

    public function getRequiereComidaEsp(){
        return $this->requiereComidaEsp;
    }

    public function setRequiereComidaEsp($requiereComidaEsp){
        $this->requiereComidaEsp = $requiereComidaEsp;
    }

    public function __toString(){
        $cadena = parent :: __toString();
        $cadena = "Requiere silla de ruedas: " . $this->getRequiereSillaR() . "\nRequiere asistencia para el embarque/desembarque: " . 
        $this->getRequiereAsistencia() . "\nRequiere comidas especiales: " . $this->getRequiereComidaEsp() . "\n";
        return $cadena;
    }

    public function darPorcentajeIncremento(){
        $porcentaje = 1;
        $nRequiereSillaR = $this->getRequiereSillaR();
        $nRequiereAsistencia = $this->getRequiereAsistencia();
        $nRequiereComidaEsp = $this->getRequiereComidaEsp();
        if ($nRequiereSillaR == "S" || $nRequiereAsistencia == "S" || $nRequiereComidaEsp == "S") {
            $porcentaje = 1.3;
        } else if ($nRequiereSillaR == "S" && $nRequiereAsistencia == "S" && $nRequiereComidaEsp == "S") {
            $porcentaje = 1.15;
        }
        return $porcentaje;
    }
}

?>