<?php
require_once "../helpers/Auth.php";
$auth = new Auth('admin', '../admin/ingresarAdmin.php');

require_once "../Datos/conexion.php";
require_once "../Datos/MetodoSql.php";

require_once "../elecciones/servicios/EleccioneServiceDataBase.php";

$eleccion = new EleccionServiceDatabase();
$m = new MetodoSql();

$ganadores = $m->getWinners();

$lista = $eleccion->ListarElecciones();

?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="../assets/css/admin.css" type="text/css">
  <script src="https://kit.fontawesome.com/c805912686.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>Menu de administradores.</title>
</head>

<body>

  <div class="d-flex" id="content-wrapper">

    <div id="page-content-wrapper" class="w-100 bg-light-blue">


      <nav class="navbar navbar-expand-lg navbar-light  border-bottom border-dark" style="background-color:#3498DB ">
        <h4 class="font-weight-bold mb-0 text-light border-bottom border-dark text-align:left">Administracion Elecciones</h4>
        <div class="container">

          <a style="background-color:#3498DB;" href="#" class="list-group-item list-group-item-action text-light p-3 border-0"><i class="fa fa-bars"></i><strong> Administracion</strong></a>
          <a style="background-color:#3498DB;" href="../elecciones/vistas/addElecciones.php" class="list-group-item list-group-item-action text-light  p-3 border-0"><i class="fas fa-check-circle"></i><strong>Elecciones</strong></a>
          <a style="background-color:#3498DB;" href="../puestosElectivos/vistas/addPuestoElectivo.php" class="list-group-item list-group-item-action text-light p-3 border-0"><i class="fas fa-chair"></i><strong>P. Electivos</strong></a>

          <a style="background-color:#3498DB;" href="../partidos/vistas/addPartido.php" class="list-group-item list-group-item-action text-light  p-3 border-0"><i class="fas fa-caravan"></i><strong> Partidos</strong></a>
          <a style="background-color:#3498DB;" href="../candidatos/vistas/addCandidato.php" class="list-group-item list-group-item-action text-light p-3 border-0"><i class="fa fa-male"></i><strong> Candidatos</strong></a>

          <a style="background-color:#3498DB;" href="../ciudadanos/vistas/addCiudadano.php" class="list-group-item list-group-item-action text-light  p-3 border-0"> <i class="fas fa-users"></i><strong> Ciudadanos </strong></a>

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

                  <a class="dropdown-item" href="logout.php"><i class="fa fa-close"></i> Cerrar sesión</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <?php if (!empty($lista[0])) : ?>
        <!---->
        <div class="container-fluid p-3">
          <div class="">
            <div class="card card-elec">


              <div class="card-body">
                <h5 class="card-title text-primary">Elecciones activas:</h5>
                <p class="card-text"><strong> <?php echo $lista[0]->Nombre; ?></strong></p>
                <p><strong> Fecha de inicio: <?php echo $lista[0]->Fecha_realizacion; ?></strong> </p>
                <?php if ($lista[0]->Estado == 'inactivo') : ?>
                  <button class="btn btn-primary"><a href="../elecciones/servicios/terminarEleccion.php">Terminar Elecciones</a> </button>
                <?php else : ?>
                  <button class="btn btn-primary"><a href="../elecciones/servicios/terminarEleccion.php">Terminar Elecciones</a></button>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <!---->

        <div id="content" class="container-fluid p-2">
          <section class="py-3">

            <!-- Highlights -->
            <div class="row">
              <?php foreach ($ganadores as $winner) : ?>
                <div class="col-xl-3 col-lg-6">
                  <div class="card mb-5 shadow-sm border-0 shadow-hover">
                    <div class="card-body d-flex">
                      <div>
                        <div class="circle rounded-circle  align-self-center d-flex mr-3">
                          <img width="40" height="40" src="..\assets\img\alcaide.jpg" alt="bandera de republica dominicana">

                        </div>
                      </div>
                      <div class="align-self-center">
                        <h6 class="mb-0 text-primary"> <?php echo $winner['puesto']; ?> Ganador:</h6>
                        <small class="text-muted"> <?= $winner['nombreCandidato']; ?> </small>
                      </div>
                    </div>
                  </div>
                </div>

              <?php endforeach; ?>

            </div>
            
        </div>

        </section>
    </div>
  </div>
  </div>
<?php else : ?>
  <h1>Debe de empezar una eleccion</h1>

<?php endif; ?>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script>
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#content-wrapper").toggleClass("toggled");
  });
</script>
</body>

</html>