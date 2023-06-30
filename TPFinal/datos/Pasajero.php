<?php
include_once 'BaseDatos.php';
class Pasajero{

    private $pdocumento;
    private $pnombre;
    private $papellido;
    private $ptelefono;
    private $objViaje;
    private $mensajeoperacion;

    public function __construct(){
        $this->pdocumento = "";
        $this->pnombre = "";
        $this->papellido = "";
        $this->ptelefono = "";
    }

    public function cargar($pdocumento, $pnombre, $papellido, $ptelefono, $objViaje){
        $this->setPdocumento($pdocumento);
        $this->setPnombre($pnombre);
        $this->setPapellido($papellido);
        $this->setPtelefono($ptelefono);
        $this->setObjviaje($objViaje);
    }

    public function getPdocumento(){
        return $this->pdocumento;
    }

    public function setPdocumento($pdocumento){
        $this->pdocumento = $pdocumento;
    }

    public function getPnombre(){
        return $this->pnombre;
    }

    public function setPnombre($pnombre){
        $this->pnombre = $pnombre;
    }

    public function getPapellido(){
        return $this->papellido;
    }

    public function setPapellido($papellido){
        $this->papellido = $papellido;
    }

    public function getPtelefono(){
        return $this->ptelefono;
    }

    public function setPtelefono($ptelefono){
        $this->ptelefono = $ptelefono;
    }

    public function getObjviaje(){
        return $this->objViaje;
    }

    public function setObjviaje($objViaje){
        $this->objViaje = $objViaje;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    /**
	 * Recupera los datos de un pasajero por dni
	 * @param int $pdocumento
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($pdocumento){
		$base = new BaseDatos();
		$consultaPasajero = "Select * from pasajero where pdocumento=".$pdocumento;
		$resp = false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPasajero)){
				if($row2=$base->Registro()){
                    $this->setPdocumento($pdocumento);
                    $this->setPnombre($row2['pnombre']);
                    $this->setPapellido($row2['papellido']);
				    $this->setPtelefono($row2['ptelefono']);
					$objViaje = new Viaje();
					$objViaje->Buscar($row2['idviaje']);
					$this->setObjviaje($objViaje);
					$resp = true;
				}				
			
		 	}	else {
		 			$this->setMensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setMensajeoperacion($base->getError());
		 	
		 }		
		 return $resp;
	}

    public static function listar($condicion=""){
	    $arregloPasajero = null;
		$base = new BaseDatos();
		$consultaPasajeros = "Select * from pasajero ";
		if ($condicion != ""){
		    $consultaPasajeros = $consultaPasajeros.' where '.$condicion;
		}
		$consultaPasajeros .= " order by papellido ";
		//echo $consultaPasajeros;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPasajeros)){
				$arregloPasajero = array();
				while($row2 = $base->Registro()){
				    $pdocumento = $row2['pdocumento'];
					$pnombre = $row2['pnombre'];
                    $papellido = $row2['papellido'];
					$ptelefono = $row2['ptelefono'];
					$objViaje = new Viaje();
					$objViaje->Buscar($row2['idviaje']);
				
					$objPasajero = new Pasajero();
					$objPasajero->cargar($pdocumento, $pnombre, $papellido, $ptelefono, $objViaje);
					array_push($arregloPasajero,$objPasajero);
	
				}
				
			
		 	}	else {
		 			$this->setMensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setMensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloPasajero;
	}

    public function insertar(){
		$base = new BaseDatos();
		$resp = false;
		$consultaInsertar = "INSERT INTO pasajero(pdocumento, pnombre, papellido, ptelefono, idviaje)
				VALUES (".$this->getPdocumento().",'".$this->getPnombre()."','".$this->getPapellido()."','".$this->getPtelefono()."','".$this->getObjviaje()->getIdviaje()."')";
		
		if($base->Iniciar()){

			if($base->Ejecutar($consultaInsertar)){

			    $resp = true;

			}	else {
					$this->setMensajeoperacion($base->getError());
					
			}

		} else {
				$this->setMensajeoperacion($base->getError());
			
		}
		return $resp;
	}

    public function modificar(){
	    $resp = false; 
	    $base = new BaseDatos();
		$consultaModifica = "UPDATE pasajero SET pnombre = '".$this->getPnombre()."',papellido='".$this->getPapellido()."',ptelefono='".$this->getPtelefono()."'
                           ,idviaje='".$this->getObjviaje()->getIdviaje()."' WHERE pdocumento=". $this->getPdocumento();
		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $resp = true;
			}else{
				$this->setMensajeoperacion($base->getError());
				
			}
		}else{
				$this->setMensajeoperacion($base->getError());
			
		}
		return $resp;
	}

    public function eliminar(){
		$base = new BaseDatos();
		$resp = false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM pasajero WHERE pdocumento = ".$this->getPdocumento();
				if($base->Ejecutar($consultaBorra)){
				    $resp = true;
				}else{
						$this->setMensajeoperacion($base->getError());
					
				}
		}else{
				$this->setMensajeoperacion($base->getError());
			
		}
		return $resp; 
	}

    public function __toString(){
        return "Documento: " . $this->getPdocumento() . "\nNombre: " . $this->getPnombre() . "\nApellido: " . $this->getPapellido() .
        "\nTeléfono: " . $this->getPtelefono() . "\nObjeto Viaje: " . $this->getObjviaje() . "\n";
    }
}

?>