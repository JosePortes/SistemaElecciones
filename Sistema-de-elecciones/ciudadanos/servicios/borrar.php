<?php
require_once "CiudadanoServiceDatabase.php";

$id = $_GET['id'];
var_dump($id);
$obj = new CiudadanoServiceDatabase();
$obj->Borrar($id);
header('Location: ../vistas/addCiudadano.php');
