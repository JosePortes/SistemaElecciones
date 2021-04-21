<?php
require_once '../../Datos/conexion.php';

require_once "EleccioneServiceDataBase.php";

$id = $_GET['id'];
var_dump($id);
$obj = new EleccionServiceDataBase();
$obj->Borrar($id);
header('Location: ../vistas/addElecciones.php');
