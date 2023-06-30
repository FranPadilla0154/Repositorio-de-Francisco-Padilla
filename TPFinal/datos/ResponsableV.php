<?php
include_once 'BaseDatos.php';
class ResponsableV{

    private $rnumeroempleado;
    private $rnumerolicencia;
    private $rnombre;
    private $rapellido;
    private $mensajeoperacion;

    public function __construct(){
        $this->rnumeroempleado = "";
        $this->rnumerolicencia = "";
        $this->rnombre = "";
        $this->rapellido = "";
    }

    public function cargar($rnumeroempleado, $rnumerolicencia, $rnombre, $rapellido){
        $this->rnumeroempleado = $rnumeroempleado;
        $this->rnumerolicencia = $rnumerolicencia;
        $this->rnombre = $rnombre;
        $this->rapellido = $rapellido;
    }

    public function getRnumeroempleado(){
        return $this->rnumeroempleado;
    }

    public function setRnumeroempleado($rnumeroempleado){
        $this->rnumeroempleado = $rnumeroempleado;
    }

    public function getRnumerolicencia(){
        return $this->rnumerolicencia;
    }

    public function setRnumerolicencia($rnumerolicencia){
        $this->rnumerolicencia = $rnumerolicencia;
    }

    public function getRnombre(){
        return $this->rnombre;
    }

    public function setRnombre($rnombre){
        $this->rnombre = $rnombre;
    }

    public function getRapellido(){
        return $this->rapellido;
    }

    public function setRapellido($rapellido){
        $this->rapellido = $rapellido;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    /**
	 * Recupera los datos de un responsable del viaje por dni
	 * @param int $rnumeroempleado
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($rnumeroempleado){
		$base = new BaseDatos();
		$consultaResponsable = "Select * from responsable where rnumeroempleado =".$rnumeroempleado;
		$resp = false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaResponsable)){
				if($row2 = $base->Registro()){
                    $this->setRnumeroempleado($rnumeroempleado);
                    $this->setRnumerolicencia($row2['rnumerolicencia']);
                    $this->setRnombre($row2['rnombre']);
				    $this->setRapellido($row2['rapellido']);
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

    public static function listar($condicion = ""){
	    $arregloResponsable = null;
		$base = new BaseDatos();
		$consultaResponsables = "Select * from responsable ";
		if ($condicion != ""){
		    $consultaResponsables = $consultaResponsables.' where '.$condicion;
		}
		$consultaResponsables .= " order by rapellido ";
		//echo $consultaResponsables;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaResponsables)){				
				$arregloResponsable = array();
				while($row2 = $base->Registro()){
				    $rnumeroempleado = $row2['rnumeroempleado'];
					$rnumerolicencia = $row2['rnumerolicencia'];
                    $rnombre = $row2['rnombre'];
					$rapellido = $row2['rapellido'];
				
					$objResponsable = new ResponsableV();
					$objResponsable->cargar($rnumeroempleado, $rnumerolicencia, $rnombre, $rapellido);
					array_push($arregloResponsable,$objResponsable);
	
				}
				
			
		 	}	else {
		 			$this->setMensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setMensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloResponsable;
	}

    public function insertar(){
		$base = new BaseDatos();
		$resp = false;
		$consultaInsertar = "INSERT INTO responsable(rnumeroempleado, rnumerolicencia, rnombre, rapellido)
				VALUES (".$this->getRnumeroempleado().",'".$this->getRnumerolicencia()."','".$this->getRnombre()."','".$this->getRapellido()."')";
		
		if($base->Iniciar()){

			if($rnumeroempleado = $base->devuelveIDInsercion($consultaInsertar)){
				$this->setRnumeroempleado($rnumeroempleado);
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
		$consultaModifica = "UPDATE responsable SET rnumerolicencia = '".$this->getRnumerolicencia()."',rnombre='".$this->getRnombre().
                            "',rapellido='".$this->getRapellido()."' WHERE rnumeroempleado=". $this->getRnumeroempleado();
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
				$consultaBorra="DELETE FROM responsable WHERE rnumeroempleado = ".$this->getRnumeroempleado();
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
        return "Número de empleado: " . $this->getRnumeroempleado() . "\nNúmero de licencia: " . $this->getRnumerolicencia() .
        "\nNombre: " . $this->getRnombre() . "\nApellido: " . $this->getRapellido() . "\n";
    }
}

?>