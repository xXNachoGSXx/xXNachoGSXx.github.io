<?php
  // Include DB conexion file
  include "Scripts/conexion.php";
  session_start();
  if (!isset($_SESSION['user'])){
      header("Location: index.php");
  }
  if($_SESSION['tipo'] != 1){
    header("Location: index.php");
  }
?>


<!DOCTYPE html>
<title> Sistema de Matrícula</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="" name="keywords">
<meta content="" name="description">

<!-- Favicons -->
<link href="img/favicon.png" rel="icon">
<link href="img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

<!-- Bootstrap CSS File -->
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Libraries CSS Files -->
<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="lib/animate/animate.min.css" rel="stylesheet">

<!-- Main Stylesheet File -->
<link href="css/style.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />

<!-- =======================================================
Theme Name: Regna
Theme URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
Author: BootstrapMade.com
License: https://bootstrapmade.com/license/
body scroll="no" style="overflow: hidden"
======================================================= -->
</head>

<body>

    <!--==========================
Header
============================-->
    <header id="header">
        <div class="container">

            <div id="logo" class="pull-left">
                <a href="#hero"><img src="img/logo.png" alt="" title="" /></img></a>
            <!-- Uncomment below if you prefer to use a text logo -->
            <!--<h1><a href="#hero">Regna</a></h1>-->
        </div>

        <nav id="nav-menu-container"class="navbar navbar-dark bg-dark">
            <ul class="nav-menu">
                <li><a href="#services">Crear Centro</a></li>
                <li><a href="index.php">Salir</a></li>
            </ul>
        </nav><!-- #nav-menu-container -->
        </div>
    </header><!-- #header -->
<!--==========================
Hero Section
============================-->


<main id="main">

    <!--==========================
About Us Section
============================-->
    <section id="about">
        <center><h1 class="modal-title">Centros <br></h1> </center>
        <div class="container">
            <div class="row about-container">
                <div class="col-lg-6 content order-lg-1 order-2">
                    <div class="box">
                        <div class="box-body">
                            <form action="Scripts/infoComunidad.php" id="ver" method="POST">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 form-control-label">Comunidad</label>
                                    <div class="col-sm-10">
                                      <?php
                                        $sql = "call getcomunidades()";
                                        $res = $conn->query($sql);
                                      ?>
                                        <select class="form-control selectpicker" id="select-comunidad" name="select-comunidad" data-live-search="true">
                                          <option data-hidden="true" value="">Seleccione un curso</option>
                                          <?php while( $row = $res->fetch_array() ) {
                                            if(!empty($row['nombre'])) {?>
                                            <option data-tokens="<?php echo $row['nombre']; ?>" value="<?php echo $row['idcomunidad']; ?>">
                                            <?php echo $row['nombre']; ?>
                                            </option>
                                            <?php } } ?>
                                        </select>
                                        <center>
                                            <br><br>
                                            <button type="button" onClick="checkUser()" class="btn btn-primary">Visualizar</button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h2 class="title">Información General</h2>
                    <?php $fila =  unserialize($_SESSION["infoComunidad"]);?>
                    <table class="table table-borderless" id="tabla-comunidad">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nombre:</td>
                                <td><?php echo $fila['nombre']; ?></td>
                            </tr>
                            <tr>
                                <td>Ubicación:</td>
                                <td><?php echo $fila['ubicacion']; ?></td>
                            </tr>
                            <tr>
                                <td>Teléfono:</td>
                                <td><?php echo $fila['telefono']; ?></td>
                            </tr>
                            <tr>
                                <td>Encargado:</td>
                                <td><?php echo $fila['encargado']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 content order-lg-2 order-1 text-center">
                    <h2 class="title">Administradores del Centro</h2>
                    <table class="table" id="tabla-administradores">
                        <thead>
                            <tr>
                              <!-- ARREGLAR -->
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php echo $_SESSION["infoComunidadAdmin"];?>
                        </tbody>
                    </table>
                    <button type="button" class="<?php echo $_SESSION["clase"]; ?>" data-toggle="modal" data-target="#myModal" id="botonAñadir">Añadir</button>
                </div>
            </div>
        </div>
    </section><!-- #about -->


    <!--==========================
Services Section
============================-->
    <section id="services">
        <div class="container wow fadeIn">
            <div class="section-header">
                <h3 class="section-title">Crear nuevo Centro Comunitario</h3>

            </div>
        </div>

        <center>
            <form action="Scripts/crearCentro.php" method="POST" class="log-frm">
                <div class="form-group row">
                    <div class="col-xs-4"></div>
                    <div class="col-xs-4">
                        <ul>
                            <label>Nombre</label>
                            <input type="text" id="nombre" placeholder="Nombre" name="nombre" class="form-control" required>
                            <label>Dirección</label>
                            <input type="text" id="direccion" placeholder="Dirección" name="direccion" class="form-control" required>
                            <label>Número Telefónico</label>
                            <input type="text" id="telefono" placeholder="Número Telefónico" name="telefono" class="form-control" required>
                            <label>Encargado</label>
                            <input type="text" id="encargado" placeholder="Nombre" name="encargado" class="form-control" required>
                            <br><br>

                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </ul>
                </div>
                <div class="col-xs-4"></div>
            </form>
        </center>


    </section><!-- #services -->

    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registrar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body text-center">
                    <div class="col-md-12 col-sm-12 no-padng">
                        <form action="Scripts/registrarAdmin.php" method="POST" id="userRegisterFrm" class="log-frm" name="userRegisterFrm">
                            <ul>
                                <label>Cédula</label>
                                <input type="number" placeholder="Identificación" name="cedula" class="form-control" required>
                                <label>Nombre</label>
                                <input type="text" placeholder="Nombre" name="fName" class="form-control" required>
                                <label>Primer Apellido</label>
                                <input type="text" placeholder="Primer Apellido" name="lName1" class="form-control" required>
                                <label>Segundo Apellido</label>
                                <input type="text" placeholder="Segundo Apellido" name="lName2" class="form-control" required>
                                <label>Teléfono</label>
                                <input type="number" placeholder="Teléfono" name="telefono" class="form-control" required>
                                <label>Nombre de Usuario</label>
                                <input type="text" placeholder="Nombre de Usuario" name="usuario" class="form-control" required>
                                <br>
                                <button type="submit" name="userRegBtn" class="btn btn-primary">Registrar</button>
                            </ul>
                        </form>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <center>
            <div class="footer-top">
                <small>&copy; Copyright 2019, Gabriel Solórzano, Carlos Gómez</small>
            </div>
        </center>
    </footer>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/superfish/hoverIntent.js"></script>
    <script src="lib/superfish/superfish.min.js"></script>

    <!-- Contact Form JavaScript File -->
    <script src="contactform/contactform.js"></script>

    <!-- Template Main Javascript File -->
    <script src="js/main.js"></script>
    <script>
    $("#botonAñadir").on("click", function (event) {
            if ($(this).hasClass("disabled")) {
                event.stopPropagation()
            } else {
                $('#myModal').modal("show");
            }
        });
        function checkUser(){
          var books = $('#select-comunidad');
          if(books.val() === ''){
            alert('Debe de seleccionar una comunidad.');
          }
          else {
            document.getElementById('ver').submit();
          }
        }
    </script>

    </body>
</html>
