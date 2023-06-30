<?php
include_once 'BaseDatos.php';
class Empresa{

    private $idempresa;
    private $enombre;
    private $edireccion;
    private $mensajeoperacion;

    public function __construct(){
        $this->idempresa = "";
        $this->enombre = "";
        $this->edireccion = "";
    }

    public function cargar($idempresa, $enombre, $edireccion){
        $this->idempresa = $idempresa;
        $this->enombre = $enombre;
        $this->edireccion = $edireccion;
    }

    public function getIdempresa(){
        return $this->idempresa;
    }

    public function setIdempresa($idempresa){
        $this->idempresa = $idempresa;
    }

    public function getEnombre(){
        return $this->enombre;
    }

    public function setEnombre($enombre){
        $this->enombre = $enombre;
    }

    public function getEdireccion(){
        return $this->edireccion;
    }

    public function setEdireccion($edireccion){
        $this->edireccion = $edireccion;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    /**
	 * Recupera los datos de una empresa por id
	 * @param int $idempresa
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idempresa){
		$base = new BaseDatos();
		$consultaEmpresa = "Select * from empresa where idempresa =".$idempresa;
		$resp = false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaEmpresa)){
				if($row2 = $base->Registro()){
                    $this->setIdempresa($idempresa);
                    $this->setEnombre($row2['enombre']);
                    $this->setEdireccion($row2['edireccion']);
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
	    $arregloEmpresa = null;
		$base = new BaseDatos();
		$consultaEmpresas = "Select * from empresa ";
		if ($condicion != ""){
		    $consultaEmpresas = $consultaEmpresas.' where '.$condicion;
		}
		$consultaEmpresas .= " order by enombre ";
		//echo $consultaEmpresas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaEmpresas)){				
				$arregloEmpresa = array();
				while($row2 = $base->Registro()){
				    $idempresa = $row2['idempresa'];
					$enombre = $row2['enombre'];
                    $edireccion = $row2['edireccion'];
				
					$objEmpresa = new Empresa();
					$objEmpresa->cargar($idempresa, $enombre, $edireccion);
					array_push($arregloEmpresa,$objEmpresa);
	
				}
				
			
		 	}	else {
		 			$this->setMensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setMensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloEmpresa;
	}

    public function insertar(){
		$base = new BaseDatos();
		$resp = false;
		$consultaInsertar = "INSERT INTO empresa(idempresa, enombre, edireccion)
				VALUES (".$this->getIdempresa().",'".$this->getEnombre()."','".$this->getEdireccion()."')";
		
		if($base->Iniciar()){

			if($idempresa = $base->devuelveIDInsercion($consultaInsertar)){
				$this->setIdempresa($idempresa);
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
		$consultaModifica = "UPDATE empresa SET enombre = '".$this->getEnombre()."',edireccion='".$this->getEdireccion().
                            "' WHERE idempresa=". $this->getIdempresa();
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
				$consultaBorra="DELETE FROM empresa WHERE idempresa = ".$this->getIdempresa();
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
        return "ID Empresa: " . $this->getIdempresa() . "\nNombre: " . $this->getEnombre() . "\nDirección: " . $this->getEdireccion() . "\n";
    }
}

?>