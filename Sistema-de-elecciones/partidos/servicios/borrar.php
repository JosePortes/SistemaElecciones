<?php
require_once "PartidoServiceDatabase.php";
$service = new PartidoServiceDatabase();

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $service->Borrar($id);

    header('Location: ../vistas/addPartido.php');

}
