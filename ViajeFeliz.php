<?php
class Viaje {

    //Atributos
    private $viaje;
    private $codigo;
    private $destino;
    private $cantMaxPasajeros;
    private $pasajeros;
    
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
        while ($continuar == "S" && $i < $mCantMaxPasajeros) { 
            echo "Ingrese el nombre del pasajero N° " . $i+1 . ".\n";
            $mNombre = trim(fgets(STDIN));
            echo "Ingrese el apellido.\n";
            $mApellido = trim(fgets(STDIN));
            echo "Ingrese el DNI.\n";
            $mDni = trim(fgets(STDIN));
            $mPasajero = ["Nombre" => $mNombre, "Apellido" => $mApellido, "DNI" => $mDni];
            $mPasajeros[$i] = $mPasajero;
            $i++;
            if ($i < $mCantMaxPasajeros) {
                echo "¿Desea ingresar otro pasajero? S/N.\n";
                $continuar = trim(fgets(STDIN));
            } else echo "Se ha alcanzado el límite de pasajeros.\n";
        }
        $mViaje = ["Código" => $mCodigo, "Destino" => $mDestino, "Cantidad máxima de pasajeros" => $mCantMaxPasajeros, "Pasajeros" => $mPasajeros];
        $this->setViaje($mViaje);
        $this->setCodigo($mCodigo);
        $this->setDestino($mDestino);
        $this->setCantMaxPasajeros($mCantMaxPasajeros);
        $this->setPasajeros($mPasajeros);
        echo "Información guardada.\n";
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
                    echo "Ingrese la nueva cantidad máxima de pasajeros.\n";
                    $mCantMaxPasajeros = trim(fgets(STDIN));
                    $mViaje["Cantidad máxima de pasajeros"] = $mCantMaxPasajeros;
                    $this->setViaje($mViaje);
                    $this->setCantMaxPasajeros($mCantMaxPasajeros);
                    echo "Datos guardados.\n";
                    break;
                case 4:
                    $encontrado = false;
                    do {
                        echo "Ingrese el número de pasajero que desea editar.\n";
                        $nPasajero = trim(fgets(STDIN)) - 1;
                        if (array_key_exists($nPasajero, $mViaje["Pasajeros"])) {
                            $mPasajeros = $this->getPasajeros();
                            $encontrado = true;
                            echo "Ingrese el nuevo nombre del pasajero.\n";
                            $mNombre = trim(fgets(STDIN));
                            echo "Ingrese el nuevo apellido.\n";
                            $mApellido = trim(fgets(STDIN));
                            echo "Ingrese el nuevo DNI.\n";
                            $mDni = trim(fgets(STDIN));
                            $mPasajero = ["Nombre" => $mNombre, "Apellido" => $mApellido, "DNI" => $mDni];
                            $mPasajeros[$nPasajero] = $mPasajero;
                            $mViaje["Pasajeros"] = $mPasajeros;
                            $this->setViaje($mViaje);
                            $this->setPasajeros($mPasajeros);
                            echo "Datos guardados.\n";
                        } else echo "ERROR, ingrese un número de pasajero existente.\n";
                    } while (!$encontrado);
                    break;
                case 5:
                    break;
                default:
                    echo "ERROR, ingrese una opción válida";
            }
        } while ($respuesta != 5);
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
        echo "Cantidad máxima de pasajeros: " . $this->getCantMaxPasajeros() . "\n";
        echo "Datos de los pasajeros:\n";
        for ($i = 0; $i < $j; $i++) {
            echo "Pasajero N°" . $i+1 . "\n";
            echo "Nombre: " . $mPasajeros[$i]["Nombre"] . "\n";
            echo "Apellido: " . $mPasajeros[$i]["Apellido"] . "\n";
            echo "DNI: " . $mPasajeros[$i]["DNI"] . "\n";
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
            echo "3. Cantidad máxima de pasajeros\n";
            echo "4. Un pasajero\n";
            echo "5. Volver al menú principal\n";
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

$objViaje = new Viaje();