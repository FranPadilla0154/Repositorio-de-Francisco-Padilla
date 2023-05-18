<?php

include_once 'Pasajero.php';
include_once 'PasajeroVIP.php';
include_once 'PasajeroNE.php';
include_once 'ResponsableV.php';

class Viaje {

    //Atributos
    private $viaje;
    private $codigo;
    private $destino;
    private $cantMaxPasajeros;
    private $pasajeros;
    private $objPasajero;
    private $objResponsableV;
    private $costoViaje;
    private $sumaCostosAbonados;
    
    //Métodos
    public function __construct(){
        $this->menuPrincipal();
    }

    /**
     * Retorna el arreglo viaje
     */
    public function getViaje(){
        return $this->viaje;
    }

    /**
     * Setea el arreglo viaje
     */
    public function setViaje($viaje){
        $this->viaje = $viaje;
    }

    /**
     * Retorna el valor del código de viaje
     */
    public function getCodigo(){
        return $this->codigo;
    }

    /**
     * Setea el valor del código de viaje
     */
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    /**
     * Retorna el destino del viaje
     */
    public function getDestino(){
        return $this->destino;
    }

    /**
     * Setea el destino del viaje
     */
    public function setDestino($destino){
        $this->destino = $destino;
    }

    /**
     * Retorna la cantidad máxima de pasajeros para el viaje
     */
    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }

    /**
     * Setea la cantidad máxima de pasajeros para el viaje
     */
    public function setCantMaxPasajeros($cantMaxPasajeros){
        $this->cantMaxPasajeros = $cantMaxPasajeros;
    }

    /**
     * Retorna el arreglo pasajeros
     */
    public function getPasajeros(){
        return $this->pasajeros;
    }

    /**
     * Setea el arreglo pasajeros
     */
    public function setPasajeros($pasajeros){
        $this->pasajeros = $pasajeros;
    }

    public function getObjPasajero(){
        return $this->objPasajero;
    }

    public function setObjPasajero($objPasajero){
        $this->objPasajero = $objPasajero;
    }

    public function getObjResponsableV(){
        return $this->objResponsableV;
    }

    public function setObjResponsableV($objResponsableV){
        $this->objResponsableV = $objResponsableV;
    }

    public function getCostoViaje(){
        return $this->costoViaje;
    }

    public function setCostoViaje($costoViaje){
        $this->costoViaje = $costoViaje;
    }

    public function getSumaCostosAbonados(){
        return $this->sumaCostosAbonados;
    }

    public function setSumaCostosAbonados($sumaCostosAbonados){
        $this->sumaCostosAbonados = $sumaCostosAbonados;
    }

    public function yaCargado ($dni) {
        $mPasajeros = $this->getPasajeros();
        if ($mPasajeros == []) {
            $j = 0;
        } else $j = count($mPasajeros);
        $cargado = false;
        for ($i = 0; $i < $j; $i++) {
            if ($mPasajeros[$i]->getNumeroDocumento() == $dni) {
                $cargado = true;
            }
            return $cargado;
        }
    }

    /**
     * Le permite al usuario cargar los datos del viaje
     */
    public function cargarviaje(){
        //String continuar, mDestino, mNombre, mApellido
        //Array mPasajeros, mViaje, mPasajero
        //Int i, mCodigo, mCantMaxPasajeros, mDni
        $continuar = "S";
        $i = 0;
        $mPasajeros = [];
        echo "Ingrese el código del viaje.\n";
        $mCodigo = trim(fgets(STDIN));
        echo "Ingrese el destino del viaje.\n";
        $mDestino = trim(fgets(STDIN));
        echo "Ingrese la cantidad máxima de pasajeros que tendra el viaje.\n";
        $mCantMaxPasajeros = trim(fgets(STDIN));
        echo "Ingrese el coste del viaje.\n";
        $mCostoViaje = trim(fgets(STDIN));
        echo "Ingrese el nombre de la persona responsable del viaje.\n";
        $mNombreR = trim(fgets(STDIN));
        echo "Ingrese el apellido.\n";
        $mApellidoR = trim(fgets(STDIN));
        echo "Ingrese el número de empleado.\n";
        $mNumeroEmpleado = trim(fgets(STDIN));
        echo "Ingrese el número de licencia.\n";
        $mNumeroLicencia = trim(fgets(STDIN));
        $objResponsableV = new ResponsableV($mNumeroEmpleado, $mNumeroLicencia, $mNombreR, $mApellidoR);
        $this->setObjResponsableV($objResponsableV);
        while ($continuar == "S" && $i < $mCantMaxPasajeros) { 
            echo "Ingrese el nombre del pasajero N° " . $i+1 . ".\n";
            $mNombreP = trim(fgets(STDIN));
            echo "Ingrese el apellido.\n";
            $mApellidoP = trim(fgets(STDIN));
            echo "Ingrese el DNI.\n";
            $mDni = trim(fgets(STDIN));
            echo "Ingrese el número de teléfono.\n";
            $mTelefono = trim(fgets(STDIN));
            echo "Ingrese el número del asiento.\n";
            $mNumAsiento = trim(fgets(STDIN));
            echo "Ingrese el número de ticket.\n";
            $mNumTicket = trim(fgets(STDIN));
            if (!$this->yaCargado($mDni)) {
                do {
                    $this->mostrarMenuPasajeros();
                    $respuesta = trim(fgets(STDIN));
                    switch ($respuesta) {
                        case 1:
                            $objPasajero = new Pasajero($mNombreP, $mApellidoP, $mDni, $mTelefono, $mNumAsiento, $mNumTicket);
                            break;
                        case 2:
                            echo "Ingrese el número de viajero frecuente.\n";
                            $mNumViajeroFrecuente = trim(fgets(STDIN));
                            echo "Ingrese la cantidad de millas acumuladas.\n";
                            $mCantMillas = trim(fgets(STDIN));
                            $objPasajero = new PasajeroVIP($mNombreP, $mApellidoP, $mDni, $mTelefono, $mNumAsiento, $mNumTicket, $mNumViajeroFrecuente, $mCantMillas);
                            break;
                        case 3:
                            echo "¿El pasajero requiere de una silla de ruedas? S/N\n";
                            $mRequiereSillaR = trim(fgets(STDIN));
                            echo "¿El pasajero requiere de asistencia para realizar el embarque/desembarque? S/N\n";
                            $mRequiereAsistencia = trim(fgets(STDIN));
                            echo "¿El pasajero requiere comidas especiales? S/N\n";
                            $mRequiereComidaEsp = trim(fgets(STDIN));
                            $objPasajero = new PasajeroNE($mNombreP, $mApellidoP, $mDni, $mTelefono, $mNumAsiento, $mNumTicket, $mRequiereSillaR, $mRequiereAsistencia, $mRequiereComidaEsp);
                            break;
                        default:
                            echo "ERROR, ingrese una opción válida.\n";
                            break;
                    }
                } while ($respuesta != 1 && $respuesta != 2 && $respuesta != 3);
                $this->setCantMaxPasajeros($mCantMaxPasajeros);
                $this->setCostoViaje($mCostoViaje);
                $this->venderPasaje($objPasajero);
                $i++;
            } else echo "El pasajero ingresado ya esta cargado en el sistema.\n";
            if ($this->hayPasajesDisponibles()) {
                echo "¿Desea ingresar otro pasajero? S/N.\n";
                $continuar = trim(fgets(STDIN));
            } else echo "Se ha alcanzado el límite de pasajeros.\n";
        }
        $mViaje = ["Código" => $mCodigo, "Destino" => $mDestino, "Costo del viaje" => $mCostoViaje, "Responsable del viaje" => $objResponsableV, "Cantidad máxima de pasajeros" => $mCantMaxPasajeros, "Pasajeros" => $mPasajeros];
        $this->setViaje($mViaje);
        $this->setCodigo($mCodigo);
        $this->setDestino($mDestino);
        $this->setCantMaxPasajeros($mCantMaxPasajeros);
        echo "Información guardada.\n";
    }

    public function mostrarMenuPasajeros(){
        echo "Ingrese el tipo de pasajero.\n";
        echo "1. Para pasajero estándar.\n";
        echo "2. Para pasajero VIP.\n";
        echo "3. Para pasajero con necesidades especiales.\n";
    }

    public function venderPasaje($objPasajero){
        $mPasajeros = $this->getPasajeros();
        $mCostoViaje = $this->getCostoViaje();
        $mSumaCostosAbonados = $this->getSumaCostosAbonados();
        if ($this->hayPasajesDisponibles()) {
            if (empty($mPasajeros)) {
                $mPasajeros[0] = $objPasajero;
            } else array_push($mPasajeros, $objPasajero);
            $this->setPasajeros($mPasajeros);
            $mCostoViaje = $mCostoViaje * $objPasajero->darPorcentajeIncremento();
            $mSumaCostosAbonados = $mSumaCostosAbonados + $mCostoViaje;
            $this->setSumaCostosAbonados($mSumaCostosAbonados);
        }
        return $mCostoViaje;
    }

    public function hayPasajesDisponibles(){
        $booleano = false;
        $mPasajeros = $this->getPasajeros();
        if (empty($mPasajeros)) {
            $mCantPasajeros = 0;
        } else $mCantPasajeros = count($mPasajeros);
        if ($mCantPasajeros < $this->getCantMaxPasajeros()) {
            $booleano = true;
        }
        return $booleano;
    }

    /**
     * Le permite al usuario editar secciones del viaje
     */
    public function editarViaje(){
        //Array mViaje, mPasajeros, mPasajero
        //String mDestino, mNombre, mApellido
        //Int respuesta, mCodigo, mCantMaxPasajeros, nPasajero, mDni
        //Boolean encontrado
        $mViaje = $this->getViaje();
        do {
            $this->mostrarMenuEdicion();
            $respuesta = trim(fgets(STDIN));
            switch ($respuesta) {
                case 1:
                    echo "Ingrese el nuevo código de viaje.\n";
                    $mCodigo = trim(fgets(STDIN));
                    $mViaje["Código"] = $mCodigo;
                    $this->setViaje($mViaje);
                    $this->setCodigo($mCodigo);
                    echo "Datos guardados.\n";
                    break;
                case 2:
                    echo "Ingrese el nuevo destino del viaje.\n";
                    $mDestino = trim(fgets(STDIN));
                    $mViaje["Destino"] = $mDestino;
                    $this->setViaje($mViaje);
                    $this->setDestino($mDestino);
                    echo "Datos guardados.\n";
                    break;
                case 3:
                    echo "Ingrese el nuevo coste del viaje.\n";
                    $mCostoViaje = trim(fgets(STDIN));
                    $this->setCostoViaje($mCostoViaje);
                    echo "Datos guardados.\n";
                    break;
                case 4:
                    $mObjResponsableV = $this->getObjResponsableV();
                    echo "Ingrese el nuevo nombre.\n";
                    $mNombre = trim(fgets(STDIN));
                    echo "Ingrese el nuevo apellido.\n";
                    $mApellido = trim(fgets(STDIN));
                    echo "Ingrese el nuevo número de empleado.\n";
                    $mNumeroEmpleado = trim(fgets(STDIN));
                    echo "Ingrese el nuevo número de licencia.\n";
                    $mNumeroLicencia = trim(fgets(STDIN));
                    $mObjResponsableV->setNombre($mNombre);
                    $mObjResponsableV->setApellido($mApellido);
                    $mObjResponsableV->setNumeroEmpleado($mNumeroEmpleado);
                    $mObjResponsableV->setNumeroLicencia($mNumeroLicencia);
                    $this->setObjResponsableV($mObjResponsableV);
                    echo "Datos guardados.\n";
                    break;
                case 5:
                    echo "Ingrese la nueva cantidad máxima de pasajeros.\n";
                    $mCantMaxPasajeros = trim(fgets(STDIN));
                    $mViaje["Cantidad máxima de pasajeros"] = $mCantMaxPasajeros;
                    $this->setViaje($mViaje);
                    $this->setCantMaxPasajeros($mCantMaxPasajeros);
                    echo "Datos guardados.\n";
                    break;
                case 6:
                    $encontrado = false;
                    do {
                        echo "Ingrese el número de pasajero que desea editar.\n";
                        $nPasajero = trim(fgets(STDIN)) - 1;
                        if (array_key_exists($nPasajero, $mViaje["Pasajeros"])) {
                            $mPasajeros = $this->getPasajeros();
                            $mObjPasajero = $mPasajeros[$nPasajero];
                            $encontrado = true;
                            echo "Ingrese el nuevo nombre del pasajero.\n";
                            $mNombre = trim(fgets(STDIN));
                            echo "Ingrese el nuevo apellido.\n";
                            $mApellido = trim(fgets(STDIN));
                            echo "Ingrese el nuevo DNI.\n";
                            $mDni = trim(fgets(STDIN));
                            echo "Ingrese el nuevo número de teléfono.\n";
                            $mTelefono = trim(fgets(STDIN));
                            if (!$this->yaCargado($mDni)) {
                                $mObjPasajero->setNombre($mNombre);
                                $mObjPasajero->setApellido($mApellido);
                                $mObjPasajero->setNumeroDocumento($mDni);
                                $mObjPasajero->setTelefono($mTelefono);
                                $mPasajeros[$nPasajero] = $mObjPasajero;
                                $mViaje["Pasajeros"] = $mPasajeros;
                                $this->setViaje($mViaje);
                                $this->setPasajeros($mPasajeros);
                                echo "Datos guardados.\n";
                            } else echo "El pasajero ingresado ya esta cargado en el sistema.\n";
                        } else echo "ERROR, ingrese un número de pasajero existente.\n";
                    } while (!$encontrado);
                    break;
                case 7:
                    break;
                default:
                    echo "ERROR, ingrese una opción válida";
            }
        } while ($respuesta != 7);
        echo "/---------------------------/\n";
    }

    /**
     * Le permite al usuario visualizar la información del viaje
     */
    public function mostrarDatos(){
        //Array mPasajeros
        //Int i, j
        $mPasajeros = $this->getPasajeros();
        $j = count($mPasajeros);
        echo "Información del viaje N°" . $this->getCodigo() . ".\n";
        echo "Destino: " . $this->getDestino() . "\n";
        echo "Coste del viaje: " . $this->getCostoViaje() . "\n";
        echo "Suma de los costos abonados: " . $this->getSumaCostosAbonados() . "\n";
        echo "Datos de la persona responsable del viaje:\n";
        echo $this->getObjResponsableV()->__toString();
        echo "Cantidad máxima de pasajeros: " . $this->getCantMaxPasajeros() . "\n";
        echo "Datos de los pasajeros:\n";
        for ($i = 0; $i < $j; $i++) {
            echo "Pasajero N°" . $i+1 . "\n";
            echo $mPasajeros[$i]->__toString();
            echo "/---------------------------/\n";
        }
    }

    /**
     * Muestra por pantalla el menú principal
     */
    public function mostrarMenu(){
        echo "Bienvenido al programa de registro de datos Viaje Feliz\n";
        echo "Por favor seleccione una opción:\n";
        echo "1. Cargar información del viaje\n";
        echo "2. Editar información del viaje\n";
        echo "3. Visualizar información del viaje\n";
        echo "4. Salir de la aplicación\n"; 
    }

    /**
     * Muestra por pantalla el menú de edición
     */
    public function mostrarMenuEdicion(){
            echo "¿Qué dato del viaje desea editar?\n";
            echo "1. Código\n";
            echo "2. Destino\n";
            echo "3. El coste del viaje\n";
            echo "4. El encargado del viaje\n";
            echo "5. Cantidad máxima de pasajeros\n";
            echo "6. Un pasajero\n";
            echo "7. Volver al menú principal\n";
    }

    /**
     * Menú principal del programa que permite cargar los datos del viaje, editarlos y visualizarlos
     */
    public function menuPrincipal(){
        //Boolean datosCargados
        //Int respuesta
        $datosCargados = false;
        do {
            $this->mostrarMenu();
            $respuesta = trim(fgets(STDIN));
            switch ($respuesta) {
                case 1:
                    $this->cargarviaje();
                    $datosCargados = true;
                    break;
                case 2:
                    $this->editarViaje();
                    break;
                case 3:
                    if ($datosCargados) {
                        $this->mostrarDatos();
                    } else echo "ERROR, no se han encontrado datos cargados.\n";
                    break;
                case 4:
                    echo "Gracias por utilizar los servicios de Viaje Feliz.\n";
                    break;
                default:
                    echo "ERROR, ingrese una opción válida.\n";
                    break;
            }
        } while ($respuesta != 4);
    }
}