 <?php

require_once "../helpers/Auth.php";
require_once "../Datos/conexion.php";
$auth = new Auth('usuario', '../index.php');

require_once 'VotoServiceDatabase.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../PHPMailer/PHPMailer.php';
require_once '../PHPMailer/SMTP.php';
require_once '../PHPMailer/Exception.php';
require_once '../helpers/EmailHandler/EmailHandler.php';


$email = new EmailHandler('../helpers/EmailHandler');
$voto = new VotoServiceDatabase();
$lista = $voto->ObtenerVotos($_SESSION['usuario']['Cedula']);

$votacionesString = '';

for ($i = 0; $i < sizeof($lista); $i++) {
    $votacionesString .= "Nombre del candidato: " . $lista[$i]['nombreCandidato'] . ", Partido: " . $lista[$i]['partido'] . " Puesto electivo: " . $lista[$i]['puestoElectivo'] . "<br>";
}

$votaciones = "<b>" . $_SESSION['usuario']['Nombre'] . "</b> Ya ha finalizado sus votaciones" . "<br>"
    . 'Aqui su listado de votaciones' . "<br>" .
    $votacionesString;

$email->sendEmail($_SESSION['usuario']['Email'], 'Votaciones', $votaciones);
unset($_SESSION['usuario']);
unset($_SESSION['votaciones']);
header('Location: ../index.php');
exit();

?>