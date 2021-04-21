<?php
require_once 'CiudadanoServiceDatabase.php';
require_once 'ciudadano.php';
require_once '../../helpers/Utilities.php';

$ciudadano = new CiudadanoServiceDatabase();
$utilities = new Utilities();
$lista = $ciudadano->ListarCiudadano();
$entidad = new Ciudadano();

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $ciudadanos = $ciudadano->ObtenerId($id);

    if (isset($_POST['nombre']) && isset($_POST['apellido'])) {
        $activo = $utilities->getActive();

        $entidad->StartData($_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['email'], $activo);

        $ciudadano->Actualizar($id, $entidad);

        header('Location: ../vistas/addCiudadano.php');

    }
}
