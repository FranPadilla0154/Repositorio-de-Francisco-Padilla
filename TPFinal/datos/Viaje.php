<?php
include_once 'BaseDatos.php';
include_once 'Empresa.php';
include_once 'ResponsableV.php';
class Viaje{

    private $idviaje;
    private $vdestino;
    private $vcantmaxpasajeros;
    private $objEmpresa;
    private $objResponsable;
    private $vimporte;
	private $coleccionPasajeros;
    private $mensajeoperacion;

    public function __construct(){
        $this->idviaje = "";
        $this->vdestino = "";
        $this->vcantmaxpasajeros = "";
        $this->vimporte = "";
		$this->coleccionPasajeros = [];
    }

    public function cargar($idviaje, $vdestino, $vcantmaxpasajeros, $objEmpresa, $objResponsable, $vimporte, $coleccionPasajeros){
        $this->idviaje = $idviaje;
        $this->vdestino = $vdestino;
        $this->vcantmaxpasajeros = $vcantmaxpasajeros;
        $this->objEmpresa = $objEmpresa;
        $this->objResponsable = $objResponsable;
        $this->vimporte = $vimporte;
		$this->coleccionPasajeros = $coleccionPasajeros;
    }

    public function getIdviaje(){
        return $this->idviaje;
    }

    public function setIdviaje($idviaje){
        $this->idviaje = $idviaje;
    }

    public function getVdestino(){
        return $this->vdestino;
    }

    public function setVdestino($vdestino){
        $this->vdestino = $vdestino;
    }

    public function getVcantmaxpasajeros(){
        return $this->vcantmaxpasajeros;
    }

    public function setVcantmaxpasajeros($vcantmaxpasajeros){
        $this->vcantmaxpasajeros = $vcantmaxpasajeros;
    }

    public function getObjempresa(){
        return $this->objEmpresa;
    }

    public function setObjempresa($objEmpresa){
        $this->objEmpresa = $objEmpresa;
    }

    public function getObjresponsable(){
        return $this->objResponsable;
    }

    public function setObjresponsable($objResponsable){
        $this->objResponsable = $objResponsable;
    }

    public function getVimporte(){
        return $this->vimporte;
    }

    public function setVimporte($vimporte){
        $this->vimporte = $vimporte;
    }

	public function getColeccionPasajeros(){
        return $this->coleccionPasajeros;
    }

    public function setColeccionPasajeros($coleccionPasajeros){
        $this->coleccionPasajeros = $coleccionPasajeros;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    /**
	 * Recupera los datos de un viaje por id
	 * @param int $idviaje
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idviaje){
		$base = new BaseDatos();
		$consultaViaje = "Select * from viaje where idviaje=".$idviaje;
		$resp = false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaViaje)){
				if($row2=$base->Registro()){
                    $this->setIdviaje($idviaje);
                    $this->setVdestino($row2['vdestino']);
                    $this->setVcantmaxpasajeros($row2['vcantmaxpasajeros']);
					$objEmpresa = new Empresa();
					$objEmpresa->Buscar($row2['idempresa']);
				    $this->setObjempresa($objEmpresa);
					$objResponsable = new ResponsableV();
					$objResponsable->Buscar($row2['rnumeroempleado']);
					$this->setObjresponsable($objResponsable);
                    $this->setVimporte($row2['vimporte']);
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
	    $arregloViaje = null;
		$base = new BaseDatos();
		$consultaViajes = "Select * from viaje ";
		if ($condicion != ""){
		    $consultaViajes = $consultaViajes.' where '.$condicion;
		}
		$consultaViajes .= " order by idviaje ";
		//echo $consultaViajes;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaViajes)){				
				$arregloViaje = array();
				while($row2 = $base->Registro()){
				    $idviaje = $row2['idviaje'];
					$vdestino = $row2['vdestino'];
                    $vcantmaxpasajeros = $row2['vcantmaxpasajeros'];
					$objEmpresa = new Empresa();
					$objEmpresa->Buscar($row2['idempresa']);
					$objResponsable = new ResponsableV();
					$objResponsable->Buscar($row2['rnumeroempleado']);
                    $vimporte = $row2['vimporte'];
					$objPasajero = new Pasajero();
					$coleccionPasajeros = $objPasajero->listar("pasajero.idviaje = " . $idviaje);
				
					$objViaje = new Viaje();
					$objViaje->cargar($idviaje, $vdestino, $vcantmaxpasajeros, $objEmpresa, $objResponsable, $vimporte, $coleccionPasajeros);
					array_push($arregloViaje,$objViaje);
	
				}
				
			
		 	}	else {
		 			$this->setMensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setMensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloViaje;
	}

    public function insertar(){
		$base = new BaseDatos();
		$resp = false;
		$objEmpresa = $this->getObjempresa();
		$objResponsable = $this->getObjresponsable();
		$consultaInsertar = "INSERT INTO viaje(idviaje, vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte)
				VALUES (".$this->getIdviaje().",'".$this->getVdestino()."','".$this->getVcantmaxpasajeros()."','".$objEmpresa->getIdempresa().
                        "','".$objResponsable->getRnumeroempleado()."','".$this->getVimporte()."')";
		
		if($base->Iniciar()){

			if($idviaje = $base->devuelveIDInsercion($consultaInsertar)){
				$this->setIdviaje($idviaje);
					$resp = true;

			} else {
					$this->setmensajeoperacion($base->getError());
			}
		} else {
				$this->setmensajeoperacion($base->getError());
		}
		return $resp;
	}

    public function modificar(){
	    $resp = false; 
	    $base = new BaseDatos();
		$consultaModifica = "UPDATE viaje SET vdestino = '".$this->getVdestino()."',vcantmaxpasajeros='".$this->getVcantmaxpasajeros().
                            "',idempresa='".$this->getObjempresa()->getIdempresa()."',rnumeroempleado='"
							.$this->getObjresponsable()->getRnumeroempleado()."',vimporte='".$this->getVimporte()."' WHERE idviaje=". $this->getIdviaje();
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
				$consultaBorra="DELETE FROM viaje WHERE idviaje = ".$this->getIdviaje();
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
        return "ID Viaje: " . $this->getIdviaje() . "\nDestino: " . $this->getVdestino() . "\nCantidad máxima de pasajeros: " .
        $this->getVcantmaxpasajeros() . "\n\nEmpresa responsable:\n" . $this->getObjempresa() . "\nResponsable asignado:\n" . $this->getObjresponsable()
        . "\nImporte: " . $this->getVimporte() . "\n";
    }
}

?>