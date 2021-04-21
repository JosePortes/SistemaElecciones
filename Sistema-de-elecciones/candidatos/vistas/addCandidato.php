<?php

require_once "../../helpers/Auth.php";

$auth = new Auth('admin', '../admin/ingresarAdmin.php');

require_once '../servicios/CandidatoServiceDatabase.php';
require_once '../servicios/candidato.php';
require_once '../../puestosElectivos/servicios/PuestoServiceDataBase.php';
require_once '../../partidos/servicios/PartidoServiceDataBase.php';
require_once '../../helpers/Utilities.php';
require_once '../../elecciones/servicios/EleccioneServiceDataBase.php';

$elecciones = new EleccionServiceDatabase();
$elec = $elecciones->ListarElecciones();

$candidatos = new CandidatoServiceDatabase();
$partido = new PartidoServiceDataBase();
$puesto = new PuestoServiceDataBase();
$lista = $candidatos->ListarCandidato();
$lista1 = $partido->ListarPartido();
$lista2 = $puesto->ListarPuesto();

$utilities = new Utilities();

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="../../assets/css/admin.css" type="text/css">
  <script src="https://kit.fontawesome.com/c805912686.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">




  <title>Agregar Candidatos.</title>
</head>

<body>



  <div class="d-flex" id="content-wrapper">



    <div id="page-content-wrapper" class="w-100 bg-light-blue">


      <nav class="navbar navbar-expand-lg navbar-light border-bottom border-dark" style="background-color:#3498DB;">
        <h4 class="font-weight-bold mb-0 text-light border-bottom border-dark"><strong>Administracion Elecciones</strong></h4>
        <div class="container">

          <a style="background-color:#3498DB;" href="../../admin/menuAdmin.php" class="list-group-item list-group-item-action text-light  p-3 border-0"><i class="fa fa-bars"></i><strong> Administracion</strong></a>
          <a style="background-color:#3498DB;" href="../../elecciones/vistas/addElecciones.php" class="list-group-item list-group-item-action text-light p-3 border-0"><i class="fas fa-check-circle"></i> <strong>Elecciones</strong></a>
          <a style="background-color:#3498DB;" href="../../puestosElectivos/vistas/addPuestoElectivo.php" class="list-group-item list-group-item-action text-light p-3 border-0"><i class="fas fa-chair"></i> <strong>P. Electivos</strong></a>

          <a style="background-color:#3498DB;" href="../../partidos/vistas/addPartido.php" class="list-group-item list-group-item-action text-light  p-3 border-0"><i class="fas fa-caravan"></i> <strong>Partidos</strong></a>
          <a style="background-color:#3498DB;" href="../../candidatos/vistas/addCandidato.php" class="list-group-item list-group-item-action text-light p-3 border-0"><i class="fa fa-male"></i> <strong> Candidatos</strong></a>

          <a style="background-color:#3498DB;" href="../../ciudadanos/vistas/addCiudadano.php" class="list-group-item list-group-item-action text-light p-3 border-0"> <i class="fas fa-users"></i> <strong>Ciudadanos</strong></a>


          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

              <li class="nav-item dropdown">
                <a style="background-color:#3498DB;" class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
      <?php if ($elec[0]->Estado != 'inactivo') : ?>
        <!---->
        <div class="container-fluid pl-5 pt-4 pr-5">
          <div class="">
            <div class="card card-elec">

              <div class="card-body">
                <form method="POST" action="../servicios/add.php" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-md-2 ">
                      <div id="preview" class="img-thumbnail border border-primary rounded float-left ">
                        <img src="../../assets/img/chico.png" alt="" srcset="" width="100px">
                      </div>

                    </div>

                    <div class="form-group col-md-2 mt-4 mr-4">


                      <input type="file" class="form-control custom-file-input" id="file" name="foto">
                      <label for="file" class="custom-file-label">foto</label>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="nombre"><strong>Nombre</strong></label>
                      <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="apellido"><strong>Apellido</strong></label>
                      <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>

                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="exampleFormControlSelect1"><strong>Seleccione su partido</strong></label>
                      <select class="form-control" id="exampleFormControlSelect1" name="partido">

                        <?php foreach ($lista1 as $lt1) : ?>

                          <option value="<?php echo $lt1->idPartidos; ?>"> <?php echo $lt1->Nombre; ?> </option>

                        <?php endforeach; ?>

                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="puesto"><strong>Seleccione su Puesto electivo</strong></label>
                      <select class="form-control" id="puesto" name="puesto">

                        <?php foreach ($lista2 as $lt2) : ?>

                          <option value="<?php echo $lt2->idPuesto_Electivo; ?>"> <?php echo $lt2->Nombre; ?> </option>


                        <?php endforeach; ?>
                      </select>
                    </div>

                  </div>

                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck" checked name="activo">
                      <label class="form-check-label" for="gridCheck">
                        <strong>Activo</strong>
                      </label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary text-dark"><strong>Guardar</strong></button>

                </form>
              </div>
            </div>
          </div>
        </div>
        <!---->
        <!-- Tabla usuarios -->
        <div class="col-xl-9 col-lg-12 ml-5 mt-3">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th colspan="col" style="font-size: 18px;"><small class="font-weight-bold">Candidatos<small></th>
                  <th scope="col" style="font-size: 18px;"><small class="font-weight-bold">Nombre<small></th>
                  <th scope="col" style="font-size: 18px;"><small class="font-weight-bold">Apellido<small></th>
                  <th scope="col" style="font-size: 18px;"><small class="font-weight-bold">Partido<small></th>
                  <th scope="col" style="font-size: 18px;"><small class="font-weight-bold">Puesto<small></th>
                  <th scope="col" style="font-size: 18px;"><small class="font-weight-bold">Estado<small></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($lista as $list) : ?>

                  <?php $puestoPerteneciente = $puesto->ObtenerId($list->Puesto); ?>
                  <?php $partidoPerteneciente = $partido->ObtenerId($list->Partido); ?>

                  <tr class="shadow-sm border border-primary rounded">
                    <td class="align-middle"><img src="<?= $utilities->getSrcImage64($list->Foto) ?>" class="img-fluid irclrounded-ce avatar" width="25%" /></td>
                    <td class="align-middle"><span class="d-block"> <?php echo $list->Nombre; ?></span></td>
                    <td class="align-middle"><span class="d-block"> <?php echo $list->Apellido; ?> </span></td>
                    <td class="align-middle"><span class="d-block"> <?php echo $partidoPerteneciente->Nombre; ?> </span></td>
                    <td class="align-middle"><span class="d-block"> <?php echo $puestoPerteneciente->Nombre; ?> </span></td>
                    <td class="align-middle"><span class="badge badge-primary text-primary"> <?php echo $list->Estado ?></span></td>
                    <td class="align-middle">
                      <a href="../servicios/borrarCandidato.php?id=<?php echo $list->idCandidatos; ?>"> <i class="fas fa-trash-alt text-danger"></i></a>
                      <a href="editarCandidato.php?id=<?php echo $list->idCandidatos; ?>"> <i class="fas fa-edit text-secondary"></i> </td></a>

                  </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
          </div>
        </div>
        <!-- Fin tabla usarios -->
      <?php else : ?>


        <h1>Tienes que iniciar elecciones</h1>

      <?php endif; ?>




      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      <script src="../../assets/js/app.js"></script>
      <script>
        $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#content-wrapper").toggleClass("toggled");
        });
      </script>
</body>

</html>