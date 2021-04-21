<?php
require_once '../../Datos/conexion.php';
require_once 'eleccion.php';
require_once '../../helpers/Utilities.php';
require_once 'EleccioneServiceDataBase.php';

if (isset($_POST['nombre']) && isset($_POST['activo'])) {

    $service = new EleccionServiceDatabase();
    $puesto = new eleccion();
    $utilities = new Utilities();
    $activo = $utilities->getActive();
    $puesto->StartData(0, $_POST['nombre'], null, $activo);

    $service->Agregar($puesto);
    header('Location: ../vistas/addElecciones.php');
}
