<?php

include_once 'Pasajero.php';

class PasajeroVIP extends Pasajero {

    //Atributos
    private $numViajeroFrecuente;
    private $cantMillas;

    //Métodos
    public function __construct($nombre, $apellido, $dni, $telefono, $numAsiento, $numTicket, $numViajeroFrecuente, $cantMillas){
        parent :: __construct($nombre, $apellido, $dni, $telefono, $numAsiento, $numTicket);
        $this->numViajeroFrecuente = $numViajeroFrecuente;
        $this->cantMillas = $cantMillas;
    }

    public function getNumViajeroFrecuente(){
        return $this->numViajeroFrecuente;
    }

    public function setNumViajeroFrecuente($numViajeroFrecuente){
        $this->numViajeroFrecuente = $numViajeroFrecuente;
    }

    public function getCantMillas(){
        return $this->cantMillas;
    }

    public function setCantMillas($cantMillas){
        $this->cantMillas = $cantMillas;
    }

    public function __toString(){
        $cadena = parent :: __toString();
        $cadena = "Número de viajero frecuente: " . $this->getNumViajeroFrecuente() . "\nCantidad de millas acumuladas del pasajero: " . $this->getCantMillas() . "\n";
        return $cadena;
    }

    public function darPorcentajeIncremento(){
        $porcentaje = 1.35;
        if ($this->getCantMillas() > 300) {
            $porcentaje = 1.65;
        }
        return $porcentaje;
    }
}

?>