<?php
include_once '../datos/Empresa.php';
include_once '../datos/Viaje.php';
include_once '../datos/Pasajero.php';
include_once '../datos/ResponsableV.php';

menuPrincipal();

function mostrarMenuPrincipal(){
    echo "--------------------------------------------------------------------\n";
    echo "Bienvenido al programa Trabajo Final IPOO 2023 por Francisco Padilla\n";
    echo "Elija una opción:\n";
    echo "1.Ingresar datos\n";
    echo "2.Modificar datos\n";
    echo "3.Borrar datos\n";
    echo "4.Visualizar datos\n";
    echo "5.Salir del programa\n";
    echo "--------------------------------------------------------------------\n";
}

function mostrarOpciones(){
    echo "1.Datos de la Empresa\n";
    echo "2.Datos de un Viaje\n";
    echo "3.Datos de un Responsable\n";
    echo "4.Datos de un Pasajero\n";
    echo "5.Salir\n";
}

function mostrarMenuIngresar(){
    echo "¿Qué datos desea ingresar?\n";
    mostrarOpciones();
    echo "--------------------------------------------------------------------\n";
}

function mostrarMenuModificar(){
    echo "¿Qué datos desea modificar?\n";
    mostrarOpciones();
    echo "--------------------------------------------------------------------\n";
}

function mostrarMenuBorrar(){
    echo "¿Qué datos desea borrar?\n";
    mostrarOpciones();
    echo "--------------------------------------------------------------------\n";
}

function mostrarMenuVisualizar(){
    echo "¿Qué datos desea visualizar?\n";
    mostrarOpciones();
    echo "--------------------------------------------------------------------\n";
}

function menuPrincipal(){
    do {
        mostrarMenuPrincipal();
        $respuesta = trim(fgets(STDIN));
        switch ($respuesta) {
            case 1:
                ingresarDatos();
                break;
            case 2:
                modificarDatos();
                break;
            case 3:
                borrarDatos();
                break;
            case 4:
                visualizarDatos();
                break;
            case 5:
                echo "--------------------\n";
                echo "Apagando programa...\n";
                echo "--------------------\n";
                break;
            default:
                echo "---------------------------------\n";
                echo "ERROR, ingrese una opción válida.\n";
                echo "---------------------------------\n";
                break;
        }
    } while ($respuesta != 5);
}

function ingresarDatos(){
    do {
        mostrarMenuIngresar();
        $respuesta = trim(fgets(STDIN));
        switch ($respuesta) {
            case 1:
                ingresarOpcion1();
                break;
            case 2:
                ingresarOpcion2();
                break;
            case 3:
                ingresarOpcion3();
                break;
            case 4:
                ingresarOpcion4();
                break;
            case 5:
                break;
            default:
                echo "---------------------------------\n";
                echo "ERROR, ingrese una opción válida.\n";
                echo "---------------------------------\n";
                break;
        }
    } while ($respuesta != 5);
}

function ingresarOpcion1(){
    $idempresa = 0;
    echo "Ingrese el nombre de la empresa\n";
    $enombre = trim(fgets(STDIN));
    echo "Ingrese la dirección de la empresa\n";
    $edireccion = trim(fgets(STDIN));
    $objEmpresa = new Empresa();
    $objEmpresa->cargar($idempresa, $enombre, $edireccion);
    $respuesta=$objEmpresa->insertar();
	if ($respuesta==true) {
        echo "------------------------------------------------\n";
		echo "OP INSERCION;  La empresa fue ingresada en la BD\n";
        echo "------------------------------------------------\n";
	} else {echo "--------------------------------------------------------------------\n";
            echo $objEmpresa->getmensajeoperacion();
            echo "--------------------------------------------------------------------\n";
        }
}

function ingresarOpcion2(){
    $idviaje = 0;
    echo "Ingrese el destino\n";
    $vdestino = trim(fgets(STDIN));
    echo "Ingrese la cantidad máxima de pasajeros\n";
    $vcantmaxpasajeros = trim(fgets(STDIN));
    echo "Ingrese el ID de la empresa responsable\n";
    $idempresa = trim(fgets(STDIN));
    echo "Ingrese el número de empleado de la persona responsable del viaje\n";
    $rnumeroempleado = trim(fgets(STDIN));
    echo "Ingrese el importe que va a tener el viaje\n";
    $vimporte = trim(fgets(STDIN));
    $objViaje = new Viaje();
    $objResponsable = new ResponsableV();
    $objEmpresa = new Empresa();
    $coleccionResponsables = $objViaje->listar("rnumeroempleado = " . $rnumeroempleado);
    if ($objResponsable->Buscar($rnumeroempleado)){
        if ($coleccionResponsables == []){
            if ($objEmpresa->Buscar($idempresa)){
                $coleccionPasajeros = [];
                $objViaje->cargar($idviaje, $vdestino, $vcantmaxpasajeros, $objEmpresa, $objResponsable, $vimporte, $coleccionPasajeros);
                $respuesta=$objViaje->insertar();
                if ($respuesta) {
                    echo "----------------------------------------------\n";
                    echo "OP INSERCION;  El viaje fue ingresado en la BD\n";
                    echo "----------------------------------------------\n";
                } else {echo "--------------------------------------------------------------------\n";
                        echo $objViaje->getmensajeoperacion();
                        echo "--------------------------------------------------------------------\n";
                }
            } else {echo "---------------------------------------------------------------------------------\n";
                    echo "El ID de empresa ingresado no corresponde con ningúna empresa en la base de datos\n";
                    echo "---------------------------------------------------------------------------------\n";
            }
        } else {echo "---------------------------------------------------------------------------------\n";
                    echo "El responsable ingresado ya está cargado dentro de otro viaje en la base de datos\n";
                    echo "---------------------------------------------------------------------------------\n";
        }
    } else {echo "-----------------------------------------------------------------------------------------\n";
            echo "El número de empleado ingresado no corresponde con ningún responsable en la base de datos\n";
            echo "-----------------------------------------------------------------------------------------\n";
    }
}

function ingresarOpcion3(){
    $rnumeroempleado = 0;
    echo "Ingrese en número de licencia\n";
    $rnumerolicencia = trim(fgets(STDIN));
    echo "Ingrese el nombre\n";
    $rnombre = trim(fgets(STDIN));
    echo "Ingrese el apellido\n";
    $rapellido = trim(fgets(STDIN));
    $objResponsableV = new ResponsableV();
    $objResponsableV->cargar($rnumeroempleado, $rnumerolicencia, $rnombre, $rapellido);
    $respuesta = $objResponsableV->insertar();
    if ($respuesta){
        echo "----------------------------------------------------\n";
        echo "OP INSERCION;  El responsable fue ingresado en la BD\n";
        echo "----------------------------------------------------\n";
    } else {echo "--------------------------------------------------------------------\n";
            echo $objResponsableV->getmensajeoperacion();
            echo "--------------------------------------------------------------------\n";
    }
}

function ingresarOpcion4(){
    echo "Ingrese el número de documento\n";
    $pdocumento = trim(fgets(STDIN));
    echo "Ingrese el nombre\n";
    $pnombre = trim(fgets(STDIN));
    echo "Ingrese el apellido\n";
    $papellido = trim(fgets(STDIN));
    echo "Ingrese el teléfono\n";
    $ptelefono = trim(fgets(STDIN));
    echo "Ingrese el ID del viaje\n";
    $idviaje = trim(fgets(STDIN));
    $objPasajero = new Pasajero();
    $objViaje = new Viaje();
    if (!$objPasajero->Buscar($pdocumento)){
        if ($objViaje->Buscar($idviaje)){
            $objPasajero->cargar($pdocumento, $pnombre, $papellido, $ptelefono, $objViaje);
            $respuesta = $objPasajero->insertar();
            if ($respuesta){
                echo "-------------------------------------------------\n";
                echo "OP INSERCION;  El pasajero fue ingresado en la BD\n";
                echo "-------------------------------------------------\n";
            } else {echo "--------------------------------------------------------------------\n";
                    echo $objPasajero->getmensajeoperacion();
                    echo "--------------------------------------------------------------------\n";
            }
        } else {echo "----------------------------------------------------------------------------\n";
                echo "El ID de viaje ingresado no corresponde con ningún viaje en la base de datos\n";
                echo "----------------------------------------------------------------------------\n";
        }
    } else {echo "---------------------------------------------------------\n";
            echo "El pasajero ingresado ya está cargado en la base de datos\n";
            echo "---------------------------------------------------------\n";
    }
}

function modificarDatos(){
    do {
        mostrarMenuModificar();
        $respuesta = trim(fgets(STDIN));
        switch ($respuesta) {
            case 1:
                modificarOpcion1();
                break;
            case 2:
                modificarOpcion2();
                break;
            case 3:
                modificarOpcion3();
                break;
            case 4:
                modificarOpcion4();
                break;
            case 5:
                break;
            default:
                echo "---------------------------------\n";
                echo "ERROR, ingrese una opción válida.\n";
                echo "---------------------------------\n";
                break;
        }
    } while ($respuesta != 5);
}

function modificarOpcion1(){
    echo "Ingrese el ID de la empresa\n";
    $idempresa = trim(fgets(STDIN));
    $objEmpresa = new Empresa();
    if ($objEmpresa->Buscar($idempresa)){
        echo "Ingrese el nuevo nombre\n";
        $enombre = trim(fgets(STDIN));
        echo "Ingrese la nueva dirección\n";
        $edireccion = trim(fgets(STDIN));
        $objEmpresa->cargar($idempresa, $enombre, $edireccion);
        $respuesta = $objEmpresa->modificar();
        if ($respuesta){
            echo "------------------------------------------------------------\n";
            echo "OP MODIFICACION: Los datos fueron actualizados correctamente\n";
            echo "------------------------------------------------------------\n";
        } else {echo "--------------------------------------------------------------------\n";
                echo $objEmpresa->getMensajeoperacion();
                echo "--------------------------------------------------------------------\n";
        }
    } else {echo "--------------------------------------------------------------------\n";
            echo "El ID ingresado no corresponde a ninguna empresa en la base de datos\n";
            echo "--------------------------------------------------------------------\n";
    }
}

function modificarOpcion2(){
    echo "Ingrese el ID del viaje\n";
    $idviaje = trim(fgets(STDIN));
    $objViaje = new Viaje();
    if ($objViaje->Buscar($idviaje)){
        echo "Ingrese el nuevo destino\n";
        $vdestino = trim(fgets(STDIN));
        echo "Ingrese la nueva cantidad máxima de pasajeros\n";
        $vcantmaxpasajeros = trim(fgets(STDIN));
        echo "Ingrese el ID de la empresa\n";
        $idempresa = trim(fgets(STDIN));
        echo "Ingrese el número de empleado del responsable\n";
        $rnumeroempleado = trim(fgets(STDIN));
        echo "Ingrese el nuevo importe del viaje\n";
        $vimporte = trim(fgets(STDIN));
        $objPasajero = new Pasajero();
        $objResponsable = new ResponsableV();
        $objEmpresa = new Empresa();
        $coleccionPasajeros = $objPasajero->listar("idviaje = " . $idviaje);
        $cantidadPasajeros = count($coleccionPasajeros);
        $arregloResponsables = $objViaje->listar("rnumeroempleado = " . $rnumeroempleado . " AND idviaje != " . $idviaje);
        if ($cantidadPasajeros <= $vcantmaxpasajeros){
            if ($objResponsable->Buscar($rnumeroempleado)){
                if ($arregloResponsables == []){
                    if ($objEmpresa->Buscar($idempresa)){
                        $objViaje->cargar($idviaje, $vdestino, $vcantmaxpasajeros, $objEmpresa, $objResponsable, $vimporte, $coleccionPasajeros);
                        $respuesta = $objViaje->modificar();
                        if ($respuesta){
                            echo "------------------------------------------------------------\n";
                            echo "OP MODIFICACION: Los datos fueron actualizados correctamente\n";
                            echo "------------------------------------------------------------\n";
                        } else {echo "--------------------------------------------------------------------\n";
                                echo $objViaje->getMensajeoperacion();
                                echo "--------------------------------------------------------------------\n";
                        }
                    } else {echo "---------------------------------------------------------------------------------\n";
                            echo "El ID de empresa ingresado no corresponde con ninguna empresa en la base de datos\n";
                            echo "---------------------------------------------------------------------------------\n";
                    }
                } else {echo "------------------------------------------------------\n";
                        echo "El responsable ingresado ya está anotado en otro viaje\n";
                        echo "------------------------------------------------------\n";
                }
            } else {echo "-----------------------------------------------------------------------------------------\n";
                    echo "El número de empleado ingresado no corresponde con ningún responsable en la base de datos\n";
                    echo "-----------------------------------------------------------------------------------------\n";
            }
        } else {echo "----------------------------------------------------------------------------------------------------\n";
                echo "La cantidad máxima de pasajeros ingresada es menor a la cantidad de pasajeros existentes en el viaje\n";
                echo "----------------------------------------------------------------------------------------------------\n";
        }
    } else {echo "--------------------------------------------------------------------\n";
            echo "El ID ingresado no corresponde a ninguna empresa en la base de datos\n";
            echo "--------------------------------------------------------------------\n";
    }
}

function modificarOpcion3(){
    echo "Ingrese el número de empleado del responsable\n";
    $rnumeroempleado = trim(fgets(STDIN));
    $objResponsableV = new ResponsableV();
    if ($objResponsableV->Buscar($rnumeroempleado)){
        echo "Ingrese el nuevo número de licencia\n";
        $rnumerolicencia = trim(fgets(STDIN));
        echo "Ingrese el nuevo nombre\n";
        $rnombre = trim(fgets(STDIN));
        echo "Ingrese el nuevo apellido\n";
        $rapellido = trim(fgets(STDIN));
        $objResponsableV->cargar($rnumeroempleado, $rnumerolicencia, $rnombre, $rapellido);
        $respuesta = $objResponsableV->modificar();
        if ($respuesta){
            echo "------------------------------------------------------------\n";
            echo "OP MODIFICACION: Los datos fueron actualizados correctamente\n";
            echo "------------------------------------------------------------\n";
        } else {echo "--------------------------------------------------------------------\n";
                echo $objResponsableV->getMensajeoperacion();
                echo "--------------------------------------------------------------------\n";
        }
    } else {echo "-----------------------------------------------------------------------------------------\n";
            echo "El número de empleado ingresado no corresponde con ningún responsable en la base de datos\n";
            echo "-----------------------------------------------------------------------------------------\n";
    }
}

function modificarOpcion4(){
    echo "Ingrese el número de documento de la persona\n";
    $pdocumento = trim(fgets(STDIN));
    $objPasajero = new Pasajero();
    if ($objPasajero->Buscar($pdocumento)){
        echo "Ingrese el nuevo nombre\n";
        $pnombre = trim(fgets(STDIN));
        echo "Ingrese el nuevo apellido\n";
        $papellido = trim(fgets(STDIN));
        echo "Ingrese el nuevo número de telefono\n";
        $ptelefono = trim(fgets(STDIN));
        echo "Ingrese el nuevo ID del viaje\n";
        $idviaje = trim(fgets(STDIN));
        $objPasajero = new Pasajero();
        $objViaje = new Viaje();
        if ($objViaje->Buscar($idviaje)){
            $objPasajero->cargar($pdocumento, $pnombre, $papellido, $ptelefono, $objViaje);
            $respuesta = $objPasajero->modificar();
            if ($respuesta){
                echo "------------------------------------------------------------\n";
                echo "OP MODIFICACION: Los datos fueron actualizados correctamente\n";
                echo "------------------------------------------------------------\n";
            } else {echo "--------------------------------------------------------------------\n";
                    echo $objPasajero->getMensajeoperacion();
                    echo "--------------------------------------------------------------------\n";
            }
        } else {echo "----------------------------------------------------------------------------\n";
                echo "El ID de viaje ingresado no corresponde con ningún viaje en la base de datos\n";
                echo "----------------------------------------------------------------------------\n";
        }
    } else {echo "---------------------------------------------------------------------------------------\n";
            echo "El número de documento ingresado no corresponde con ningún pasajero en la base de datos\n";
            echo "---------------------------------------------------------------------------------------\n";
    }
}

function borrarDatos(){
    do {
        mostrarMenuBorrar();
        $respuesta = trim(fgets(STDIN));
        switch ($respuesta) {
            case 1:
                borrarOpcion1();
                break;
            case 2:
                borrarOpcion2();
                break;
            case 3:
                borrarOpcion3();
                break;
            case 4:
                borrarOpcion4();
                break;
            case 5:
                break;
            default:
                echo "---------------------------------\n";
                echo "ERROR, ingrese una opción válida.\n";
                echo "---------------------------------\n";
                break;
        }
    } while ($respuesta != 5);
}

function borrarOpcion1(){
    echo "Ingrese el ID de la empresa que desea borrar\n";
    $idempresa = trim(fgets(STDIN));
    $objViaje = new Viaje();
    $arregloViajes = $objViaje->listar('idempresa = ' . $idempresa);
    $objEmpresa = new Empresa();
    if ($objEmpresa->Buscar($idempresa)){
        if ($arregloViajes == []){
            $objEmpresa->setIdempresa($idempresa);
            $respuesta = $objEmpresa->eliminar();
            if ($respuesta){
                echo "-------------------------------------------------------\n";
                echo "OP ELIMINACION: Los datos fueron borrados correctamente\n";
                echo "-------------------------------------------------------\n";
            } else {echo "--------------------------------------------------------------------\n";
                    echo $objEmpresa->getMensajeoperacion();
                    echo "--------------------------------------------------------------------\n";
            }
        } else {echo "------------------------------------------------------------------------\n";
                echo "La empresa ingresada está ligada a uno o más viajes y no se puede borrar\n";
                echo "------------------------------------------------------------------------\n";
        }
    } else {echo "--------------------------------------------------------------------\n";
            echo "El ID ingresado no corresponde a ninguna empresa en la base de datos\n";
            echo "--------------------------------------------------------------------\n";
    }
}

function borrarOpcion2(){
    echo "Ingrese el ID del viaje que desea borrar\n";
    $idviaje = trim(fgets(STDIN));
    $objPasajero = new Pasajero();
    $coleccionPasajeros = $objPasajero->listar('idviaje = ' . $idviaje);
    $objViaje = new Viaje();
    if ($objViaje->Buscar($idviaje)){
        if ($coleccionPasajeros == []){
            $objViaje->setIdviaje($idviaje);
            $respuesta = $objViaje->eliminar();
            if ($respuesta){
                echo "-------------------------------------------------------\n";
                echo "OP ELIMINACION: Los datos fueron borrados correctamente\n";
                echo "-------------------------------------------------------\n";
            } else {echo "--------------------------------------------------------------------\n";
                    echo $objViaje->getMensajeoperacion();
                    echo "--------------------------------------------------------------------\n";
            }
        } else {echo "-------------------------------------------------------------------------\n";
                echo "El viaje ingresado está ligado a uno o más pasajeros y no se puede borrar\n";
                echo "-------------------------------------------------------------------------\n";
        }
    } else {echo "-----------------------------------------------------------------\n";
            echo "El ID ingresado no corresponde a ningun viaje en la base de datos\n";
            echo "-----------------------------------------------------------------\n";
    }
}

function borrarOpcion3(){
    echo "Ingrese el número de empleado del responsable que desea borrar\n";
    $rnumeroempleado = trim(fgets(STDIN));
    $objViaje = new Viaje();
    $coleccionViajes = $objViaje->listar('rnumeroempleado = ' . $rnumeroempleado);
    $objResponsableV = new ResponsableV();
    if ($objResponsableV->Buscar($rnumeroempleado)){
        if ($coleccionViajes == []){
            $objResponsableV->setRnumeroempleado($rnumeroempleado);
            $respuesta = $objResponsableV->eliminar();
            if ($respuesta){
                echo "-------------------------------------------------------\n";
                echo "OP ELIMINACION: Los datos fueron borrados correctamente\n";
                echo "-------------------------------------------------------\n";
            } else {echo "--------------------------------------------------------------------\n";
                    echo $objResponsableV->getMensajeoperacion();
                    echo "--------------------------------------------------------------------\n";
            }
        } else {echo "--------------------------------------------------------------------\n";
                echo "El responsable ingresado está ligado a un viaje y no se puede borrar\n";
                echo "--------------------------------------------------------------------\n";
        }
    } else {echo "---------------------------------------------------------------------------------------\n";
            echo "El número de empleado ingresado no corresponde a ningun responsable en la base de datos\n";
            echo "---------------------------------------------------------------------------------------\n";
    }
}

function borrarOpcion4(){
    echo "Ingrese el número de documento del pasajero\n";
    $pdocumento = trim(fgets(STDIN));
    $objPasajero = new Pasajero();
    if ($objPasajero->Buscar($pdocumento)){
        $objPasajero->setPdocumento($pdocumento);
        $respuesta = $objPasajero->eliminar();
        if ($respuesta){
            echo "-------------------------------------------------------\n";
            echo "OP ELIMINACION: Los datos fueron borrados correctamente\n";
            echo "-------------------------------------------------------\n";
        } else {echo "--------------------------------------------------------------------\n";
                echo $objPasajero->getMensajeoperacion();
                echo "--------------------------------------------------------------------\n";
        }
    } else {echo "-------------------------------------------------------------------------------------\n";
            echo "El número de documento ingresado no corresponde a ningun pasajero en la base de datos\n";
            echo "-------------------------------------------------------------------------------------\n";
    }
}

function visualizarDatos(){
    do {
        mostrarMenuVisualizar();
        $respuesta = trim(fgets(STDIN));
        switch ($respuesta) {
            case 1:
                visualizarOpcion1();
                break;
            case 2:
                visualizarOpcion2();
                break;
            case 3:
                visualizarOpcion3();
                break;
            case 4:
                visualizarOpcion4();
                break;
            case 5:
                break;
            default:
                echo "---------------------------------\n";
                echo "ERROR, ingrese una opción válida.\n";
                echo "---------------------------------\n";
                break;
        }
    } while ($respuesta != 5);
}

function visualizarOpcion1(){
    do {
        echo "-----------------------------------------------------\n";
        echo "Seleccione una opción\n";
        echo "1.Ver una empresa específica\n";
        echo "2.Ver todas las empresas cargadas en la base de datos\n";
        echo "3.Volver\n";
        echo "-----------------------------------------------------\n";
        $respuesta = trim(fgets(STDIN));
        switch ($respuesta) {
            case 1:
                verEmpresaEspecifica();
                break;
            case 2:
                verEmpresas();
                break;
            case 3:
                break;
            default:
                echo "---------------------------------\n";
                echo "ERROR, ingrese una opción válida.\n";
                echo "---------------------------------\n";
                break;
        }
    } while ($respuesta != 3);
}

function verEmpresaEspecifica(){
    echo "Ingrese el ID de la empresa\n";
    $idempresa = trim(fgets(STDIN));
    $objEmpresa = new Empresa();
    if ($objEmpresa->Buscar($idempresa)){
        echo "----------------------------------------------------------------------------------------------------------------------------------\n";
        echo $objEmpresa;
        echo "----------------------------------------------------------------------------------------------------------------------------------\n";
    } else {echo "--------------------------------------------------------------------\n";
            echo "El ID ingresado no corresponde a ninguna empresa en la base de datos\n";
            echo "--------------------------------------------------------------------\n";
        }
}

function verEmpresas(){
    $objEmpresa = new Empresa();
    $arregloEmpresas = $objEmpresa->listar();
    if ($arregloEmpresas != []){
        $cantidadEmpresas = count($arregloEmpresas);
        for ($i = 0; $i < $cantidadEmpresas; $i++){
            echo "----------------------------------------------------------------------------------------------------------------------------------\n";
            echo "Empresa N°" . $i+1 . "\n\n";
            echo $arregloEmpresas[$i];
        }
        echo "----------------------------------------------------------------------------------------------------------------------------------\n";
    } else {echo "---------------------------------------\n";
            echo "La base de datos de empresas está vacía\n";
            echo "---------------------------------------\n";

    }
}

function visualizarOpcion2(){
    do {
        echo "---------------------------------------------------\n";
        echo "Seleccione una opción\n";
        echo "1.Ver un viaje específico\n";
        echo "2.Ver todos los viajes cargados en la base de datos\n";
        echo "3.Volver\n";
        echo "---------------------------------------------------\n";
        $respuesta = trim(fgets(STDIN));
        switch ($respuesta) {
            case 1:
                verViajeEspecifico();
                break;
            case 2:
                verViajes();
                break;
            case 3:
                break;
            default:
                echo "---------------------------------\n";
                echo "ERROR, ingrese una opción válida.\n";
                echo "---------------------------------\n";
                break;
        }
    } while ($respuesta != 3);
}

function verViajeEspecifico(){
    echo "Ingrese el ID del viaje\n";
    $idviaje = trim(fgets(STDIN));
    $objViaje = new Viaje();
    if ($objViaje->Buscar($idviaje)){
        echo "----------------------------------------------------------------------------------------------------------------------------------\n";
        echo $objViaje;
        echo "----------------------------------------------------------------------------------------------------------------------------------\n";
    } else {echo "-----------------------------------------------------------------\n";
            echo "El ID ingresado no corresponde a ningun viaje en la base de datos\n";
            echo "-----------------------------------------------------------------\n";
    }
}

function verViajes(){
    $objViaje = new Viaje();
    $arregloViajes = $objViaje->listar();
    if ($arregloViajes != []){
        $cantidadViajes = count($arregloViajes);
        for ($i = 0; $i < $cantidadViajes; $i++){
            echo "----------------------------------------------------------------------------------------------------------------------------------\n";
            echo "Viaje N°" . $i+1 . "\n\n";
            echo $arregloViajes[$i];
        }
        echo "----------------------------------------------------------------------------------------------------------------------------------\n";
    } else {echo "-------------------------------------\n";
            echo "La base de datos de viajes está vacía\n";
            echo "-------------------------------------\n";

    }
}

function visualizarOpcion3(){
    do {
        echo "---------------------------------------------------------\n";
        echo "Seleccione una opción\n";
        echo "1.Ver un responsable específico\n";
        echo "2.Ver todos los responsables cargados en la base de datos\n";
        echo "3.Volver\n";
        echo "---------------------------------------------------------\n";
        $respuesta = trim(fgets(STDIN));
        switch ($respuesta) {
            case 1:
                verResponsableEspecifico();
                break;
            case 2:
                verResponsables();
                break;
            case 3:
                break;
            default:
                echo "---------------------------------\n";
                echo "ERROR, ingrese una opción válida.\n";
                echo "---------------------------------\n";
                break;
        }
    } while ($respuesta != 3);
}

function verResponsableEspecifico(){
    echo "Ingrese el número de empleado del responsable\n";
    $rnumeroempleado = trim(fgets(STDIN));
    $objResponsableV = new ResponsableV();
    if ($objResponsableV->Buscar($rnumeroempleado)){
        echo "----------------------------------------------------------------------------------------------------------------------------------\n";
        echo $objResponsableV;
        echo "----------------------------------------------------------------------------------------------------------------------------------\n";
    } else {echo "---------------------------------------------------------------------------------------\n";
            echo "El número de empleado ingresado no corresponde a ningun responsable en la base de datos\n";
            echo "---------------------------------------------------------------------------------------\n";
    }
}

function verResponsables(){
    $objResponsable = new ResponsableV();
    $arregloResponsables = $objResponsable->listar();
    if ($arregloResponsables != []){
        $cantidadResponsables = count($arregloResponsables);
        for ($i = 0; $i < $cantidadResponsables; $i++){
            echo "----------------------------------------------------------------------------------------------------------------------------------\n";
            echo "Responsable N°" . $i+1 . "\n\n";
            echo $arregloResponsables[$i];
        }
        echo "----------------------------------------------------------------------------------------------------------------------------------\n";
    } else {echo "-------------------------------------------\n";
            echo "La base de datos de responsables está vacía\n";
            echo "-------------------------------------------\n";
    }
}

function visualizarOpcion4(){
    do {
        echo "------------------------------------------------------\n";
        echo "Seleccione una opción\n";
        echo "1.Ver un pasajero específico\n";
        echo "2.Ver todos los pasajeros cargados en la base de datos\n";
        echo "3.Volver\n";
        echo "------------------------------------------------------\n";
        $respuesta = trim(fgets(STDIN));
        switch ($respuesta) {
            case 1:
                verPasajeroEspecifico();
                break;
            case 2:
                verPasajeros();
                break;
            case 3:
                break;
            default:
                echo "---------------------------------\n";
                echo "ERROR, ingrese una opción válida.\n";
                echo "---------------------------------\n";
                break;
        }
    } while ($respuesta != 3);
}

function verPasajeroEspecifico(){
    echo "Ingrese el número de documento del pasajero\n";
    $pdocumento = trim(fgets(STDIN));
    $objPasajero = new Pasajero();
    if ($objPasajero->Buscar($pdocumento)){
        echo "----------------------------------------------------------------------------------------------------------------------------------\n";
        echo $objPasajero;
        echo "----------------------------------------------------------------------------------------------------------------------------------\n";
    } else {echo "-------------------------------------------------------------------------------------\n";
            echo "El número de documento ingresado no corresponde a ningun pasajero en la base de datos\n";
            echo "-------------------------------------------------------------------------------------\n";
    }
}

function verPasajeros(){
    $objPasajero = new Pasajero();
    $arregloPasajeros = $objPasajero->listar();
    if ($arregloPasajeros != []){
        $cantidadPasajeros = count($arregloPasajeros);
        for ($i = 0; $i < $cantidadPasajeros; $i++){
            echo "----------------------------------------------------------------------------------------------------------------------------------\n";
            echo $objPasajero;
        }
        echo "----------------------------------------------------------------------------------------------------------------------------------\n";
    } else {echo "----------------------------------------\n";
            echo "La base de datos de pasajeros está vacía\n";
            echo "----------------------------------------\n";
    }
}
?>