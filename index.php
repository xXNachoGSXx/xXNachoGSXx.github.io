<?php
include "Scripts/conexion.php";
unset($_SESSION["user"]);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Sistema de matrícula</title>
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
  <link href="css/styleproyecto.css" rel="stylesheet">


  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
  <script type="text/javascript">
    $(document).ready(function() {
      $('#tabla-curso tr').empty();
      $('#tabla-comunidad tr').empty();
    });
  </script>
  <!-- =======================================================
Theme Name: Regna
Theme URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
Author: BootstrapMade.com
License: https://bootstrapmade.com/license/

body scroll="no" style="overflow: hidden"  para no mover la pantalla
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

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#hero">Inicio</a></li>
          <li><a href="#about">Cursos</a></li>
          <li><a href="about.php">Acerca de nosotros</a></li>
          <li data-toggle="modal" data-target="#myModal"><a href="#">Iniciar Sesión</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->


  <!--==========================
Inicio de sesión
============================-->


  <div id="myModal" class="modal fade">
    <div class="modal-dialog modal-login">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Inicio de Sesión</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <form action="Scripts/validacion.php" method="POST">
            <div class="form-group">
              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required="required">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña" required="required">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Login</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <!-- <li><a href="admin.php">Administrador</a></li>
<li><a href="super.php">Usuario Alpha</a></li> -->
        </div>
      </div>
    </div>
  </div>


  <!--==========================
Hero Section
============================-->
  <section id="hero">
    <div class="hero-container">
      <h1>Bienvenido a Cursos Comunitarios</h1>
      <h2>Aprender de la mano de la comunidad</h2>
      <a href="#about" class="btn-get-started">Ver cursos</a>
    </div>
  </section><!-- #hero -->

  <main id="main">

    <!--==========================
About Us Section
============================-->
    <section id="about">
      <center>
        <h2 class="title">Cursos</h2>
        <p>
          Seleccione una comunidad asociada para ver los cursos que se imparten
        </p>
      </center>

      <div class="container" align="center">
        <div class="row about-container">
          <div class="col-lg-6 content order-lg-1 order-2">
            <div class="container">
              <div class="row">
                <div class="col-xs-12">
                  <div class="form-group row">
                    <label for="" class="col-sm-2 form-control-label">Comunidad</label>
                    <div class="col-sm-10">
                      <?php
                      $sql = "call getcomunidades()";
                      $res = $conn->query($sql);
                      ?>
                      <!-- <form action="Scripts/getCursos.php" method="POST"> -->
                      <select class="form-control selectpicker" name="select-comunidad" id="select-comunidad" data-live-search="true">
                        <!-- data-hidden="true" -->
                        <option data-hidden="true" value="">Seleccione una comunidad</option>
                        <?php while ($row = $res->fetch_array()) {
                          if (!empty($row['nombre'])) { ?>
                            <option data-tokens="<?php echo $row['nombre']; ?>" value="<?php echo $row['idcomunidad']; ?>">
                              <?php echo $row['nombre']; ?>
                            </option>
                        <?php }
                        } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- #about -->

    <!--==========================
Facts Section
============================-->

    <!--==========================
Services Section
============================-->
    <section id="services">
      <div class="container wow fadeIn">
        <div class="section-header">
          <h3 class="section-title" id="label2">Información de comunidad</h3>
          <p class="section-description" id="label3">Acerca de la información que posee cada comunidad y cursos impartidos</p>

        </div>
      </div>

      <center>
        <div class="container">
          <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-sm">
              <table class="table table-borderless" name="tabla-comunidad" id="tabla-comunidad">
                <thead>
                </thead>
                <tbody>
                  <tr>
                    <td><b>Nombre:</b></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><b>Ubicación:</b></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><b>Teléfono:</b></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><b>Encargado:</b></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-2">
            </div>
          </div>
        </div>
      </center>

      <center>
        <!-- <div class="container">
        <div class="row">
            <div class="col-sm-10">
            </div>
            <div class="col-sm">
        <div class="row1">
          <div class="column1">
            <div class="form-group row"> -->
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-3">
            <label class="form-control-label" id="label1">Seleccione el curso:</label>
            <select name="select-curso" id="select-curso">
              <option style="display:none;">Seleccione un curso</option>
            </select>
          </div>
          <div class="col-md-5">
            <table id="tabla-curso" name="tabla-curso" class="table table-bordered">
              <tbody>
                <tr>
                  <td><b>Nombre</b></td>
                  <td></td>
                </tr>
                <tr>
                  <td><b>Descripción</b></td>
                  <td></td>
                </tr>
                <tr>
                  <td><b>Profesor</b></td>
                  <td></td>
                </tr>
                <tr>
                  <td><b>Duración</b></td>
                  <td></td>
                </tr>
                <tr>
                  <td><b>Horario</b></td>
                  <td></td>
                </tr>
                <tr>
                  <td><b>Duración</b></td>
                  <td></td>
                </tr>
                <tr>
                  <td><b>Precio</b></td>
                  <td></td>
                </tr>
                <tr>
                  <td><b>Cupos</b></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- </div>
          </div> -->
        <!-- <div class="column1"> -->

        <!-- </div> -->
        <!-- </div>
      </div>
      <div class="col-sm-10">
      </div> -->
        <!-- </div>
        </div> -->
      </center>
      <!-- </center> -->


    </section><!-- #services -->

    <!--==========================
Call To Action Section
============================-->
    <!--==========================
Portfolio Section
============================-->

  </main>

  <!--==========================
Footer
============================-->
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
  <script src="js/funproyecto.js"></script>
  <script>
    document.getElementById("label1").style.visibility = "hidden";
    document.getElementById("select-curso").style.visibility = "hidden";
    document.getElementById("label2").style.visibility = "hidden";
    document.getElementById("label3").style.visibility = "hidden";
    $(document).ready(function() {
      $('#tabla-curso tr').empty();
      $('#tabla-comunidad tr').empty();
      $("#select-comunidad").change(function() {
        var comid = $(this).val();
        $.ajax({
          url: 'Scripts/getCursos.php',
          type: 'post',
          data: {
            com: comid
          },
          dataType: 'json',
          success: function(response) {
            $('#tabla-curso tr').empty();
            var len = response.length;
            $('#select-curso')
              .empty();
            document.getElementById("label1").style.visibility = "visible";
            document.getElementById("select-curso").style.visibility = "visible";
            document.getElementById("label2").style.visibility = "visible";
            document.getElementById("label3").style.visibility = "visible";
            if (len == 0) {
              var select = document.getElementById("select-curso");
              var opt = document.createElement('option');
              opt.appendChild(document.createTextNode("No hay cursos disponibles"));
              opt.value = -1;
              select.appendChild(opt);
            } else {
              $('#select-curso')
                .append('<option style="display:none;" selected="selected">Seleccione un Curso</option>');
              for (var i = 0; i < len; i++) {
                var id = response[i]['id'];
                var name = response[i]['name'];
                var x = document.getElementById("select-curso");
                var option = document.createElement("option");
                option.text = name;
                option.value = id;
                x.add(option);
              }
            }
          }
        });
        $.ajax({
          url: 'Scripts/infoComIndex.php',
          type: 'post',
          data: {
            com: comid
          },
          dataType: 'json',
          success: function(response) {
            var len = response.length;
            var nom = response[0]['nombre'];
            var ubi = response[0]['ubi'];
            var tel = response[0]['tel'];
            var enc = response[0]['enc'];
            $('#tabla-comunidad tr').empty();
            $('#tabla-comunidad tr:last').after('<tr><td><b>Nombre:</b></td><td>' + nom + '</td></tr>');
            $('#tabla-comunidad tr:last').after('<tr><td><b>Ubicación:</b></td><td>' + ubi + '</td></tr>');
            $('#tabla-comunidad tr:last').after('<tr><td><b>Teléfono:</b></td><td>' + tel + '</td></tr>');
            $('#tabla-comunidad tr:last').after('<tr><td><b>Encargado:</b></td><td>' + enc + '</td></tr>');
          }
        });
      });
      $("#select-curso").change(function() {
        var curid = $(this).val();
        if (curid > 0) {
          $.ajax({
            url: 'Scripts/infoCursoIndex.php',
            type: 'post',
            data: {
              cur: curid
            },
            dataType: 'json',
            success: function(response) {
              var len = response.length;
              var nom = response[0]['nombre'];
              var des = response[0]['des'];
              var prof = response[0]['prof'];
              var hor = response[0]['hor'];
              var prec = response[0]['prec'];
              var cupo = response[0]['cupo'];
              var dur = response[0]['dur'];
              $('#tabla-curso tr').empty();
              $('#tabla-curso tr:last').after('<tr><td><b>Nombre:</b></td><td>' + nom + '</td></tr>');
              $('#tabla-curso tr:last').after('<tr><td><b>Descripción:</b></td><td>' + des + '</td></tr>');
              $('#tabla-curso tr:last').after('<tr><td><b>Profesor:</b></td><td>' + prof + '</td></tr>');
              $('#tabla-curso tr:last').after('<tr><td><b>Duración:</b></td><td>' + dur + '</td></tr>');
              $('#tabla-curso tr:last').after('<tr><td><b>Horario:</b></td><td>' + hor + '</td></tr>');
              $('#tabla-curso tr:last').after('<tr><td><b>Precio:</b></td><td>' + prec + '</td></tr>');
              $('#tabla-curso tr:last').after('<tr><td><b>Cupo:</b></td><td>' + cupo + '</td></tr>');
            }
          });
        }
      });
    });
  </script>

</body>

</html>