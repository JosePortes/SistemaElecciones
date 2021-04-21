<?php
require_once "../../helpers/Auth.php";

$auth = new Auth('admin', '../../admin/ingresarAdmin.php');

require_once '../../Datos/conexion.php';
require_once '../servicios/eleccion.php';
require_once '../../helpers/Utilities.php';
require_once '../servicios/EleccioneServiceDataBase.php';
require_once '../../votos/VotoServiceDatabase.php';

$id = $_GET['id'];

$service = new VotoServiceDatabase();
$lista = $service->Reportes($id);

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="../../assets/css/admin.css" type="text/css">
  <script src="https://kit.fontawesome.com/c805912686.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>Reportes Electorales</title>
</head>

<body>

  <div class="d-flex" id="content-wrapper">

    <!-- Sidebar -->
    <!-- <div id="sidebar-container" class="bg-white border-right border-success">
      <div class="logo">
        <h4 class="font-weight-bold mb-0 text-dark border-bottom border-success">Administracion Elecciones</h4>
      </div>
      <div class="menu list-group-flush">
       <a href="../../admin/menuAdmin.php" class="list-group-item list-group-item-action text-success bg-white p-3 border-0"><i class="fas fa-cog"></i> Administracion</a>
        <a href="../../elecciones/vistas/addElecciones.php" class="list-group-item list-group-item-action text-success bg-white p-3 border-0"><i class="fas fa-check-circle"></i> Elecciones</a>
        <a href="../../puestosElectivos/vistas/addPuestoElectivo.php" class="list-group-item list-group-item-action text-success bg-white p-3 border-0"><i class="fas fa-chair"></i> Puestos Electivos</a>

        <a href="../../partidos/vistas/addPartido.php" class="list-group-item list-group-item-action text-success bg-white p-3 border-0"><i class="fas fa-caravan"></i> Partidos</a>
         <a href="../../candidatos/vistas/addCandidato.php" class="list-group-item list-group-item-action text-success bg-white p-3 border-0"><i class="fas fa-user"></i> Candidatos</a>

        <a href="../../ciudadanos/vistas/addCiudadano.php" class="list-group-item list-group-item-action text-success bg-white p-3 border-0"> <i class="fas fa-users"></i> Ciudadanos</a>
      </div>
    </div> -->
    <!-- Fin sidebar -->

    <!-- Page Content -->


    <div id="page-content-wrapper" class="w-100 bg-light-blue">


      <nav style="background-color:#3498DB;" class="navbar navbar-expand-lg navbar-light border-bottom border-dark">
      <h4 class="font-weight-bold mb-0 text-light border-bottom border-dark"><strong>Administracion Elecciones</strong></h4>
        <div class="container">
          <!-- <button class="btn btn-success text-white" id="menu-toggle">Mostrar / esconder menu</button> -->
          <a style="background-color:#3498DB;" href="../../admin/menuAdmin.php" class="list-group-item list-group-item-action text-light p-3 border-0"><i class="fas fa-cog"></i> <strong>Administracion</strong></a>
          <a style="background-color:#3498DB;" href="../../elecciones/vistas/addElecciones.php" class="list-group-item list-group-item-action text-light p-3 border-0"><i class="fas fa-check-circle"></i> <strong>Elecciones</strong></a>
          <a style="background-color:#3498DB;" href="../../puestosElectivos/vistas/addPuestoElectivo.php" class="list-group-item list-group-item-action text-light p-3 border-0"><i class="fas fa-chair"></i> <strong>Puesto Electivo</strong></a>

          <a style="background-color:#3498DB;" href="../../partidos/vistas/addPartido.php" class="list-group-item list-group-item-action text-light p-3 border-0"><i class="fas fa-caravan"></i> <strong>Partidos</strong></a>
          <a style="background-color:#3498DB;" href="../../candidatos/vistas/addCandidato.php" class="list-group-item list-group-item-action text-light p-3 border-0"><i class="fas fa-user"></i> <strong>Candidatos</strong></a>

          <a style="background-color:#3498DB;" href="../../ciudadanos/vistas/addCiudadano.php" class="list-group-item list-group-item-action text-light p-3 border-0"> <i class="fas fa-users"></i> <strong>Ciudadanos</strong></a>


          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

              <li class="nav-item dropdown">
                <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <strong>Inicio</strong>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="../../admin/logout.php">Cerrar sesión</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>


      <!-- Tabla usuarios -->
      <div class="col-xl-9 col-lg-12 ml-5 mt-3">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th colspan="col" style="font-size: 18px;"><small class="font-weight-bold">Nombre Eleccion<small></th>
                <th colspan="col" style="font-size: 18px;"><small class="font-weight-bold">Fecha de realizacion<small></th>
                <th colspan="col" style="font-size: 18px;"><small class="font-weight-bold">Candidato<small></th>
                <th scope="col" style="font-size: 18px;"><small class="font-weight-bold">Puesto Electivo<small></th>
                <th scope="col" style="font-size: 18px;"><small class="font-weight-bold">Partido<small></th>
                <th scope="col" style="font-size: 18px;"><small class="font-weight-bold">Votos<small></th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($lista as $list) : ?>
                <tr class="shadow-sm border border-primary rounded">
                  <td class="align-middle"><span class="d-block"> <?php echo $list['Nombre']; ?> </span></td>
                  <td class="align-middle"><span class="d-block"> <?php echo $list['Fecha_realizacion']; ?> </span></td>
                  <td class="align-middle"><span class="d-block"> <?php echo $list['nombreCandidato']; ?> </span></td>
                  <td class="align-middle"><span class="d-block"> <?php echo $list['puesto']; ?> </span></td>
                  <td class="align-middle"><span class="d-block"> <?php echo $list['partido']; ?> </span></td>
                  <td class="align-middle"><span class="d-block"> <?php echo $list['totalVotos']; ?> </span></td>


                  <td class="align-middle">



                </tr>
              <?php endforeach; ?>

            </tbody>
          </table>
        </div>
      </div>
      <!-- Fin tabla usarios -->



      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      <script src="../assets/js/app.js"></script>
      <script>
        $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#content-wrapper").toggleClass("toggled");
        });
      </script>
</body>

</html>