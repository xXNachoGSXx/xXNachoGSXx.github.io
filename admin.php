<?php
include "Scripts/conexion.php";
session_start();
$idCom = $_SESSION["idComunidad"];
unset ($_SESSION['infoCurso']);
unset($_SESSION["infoMatricula"]);
unset($_SESSION["idCur"]);
if (!isset($_SESSION['user'])){
    header("Location: index.php");
}
if($_SESSION['tipo'] != 2){
  header("Location: index.php");
}
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sistema Matrícula</title>
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


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
        <script type="text/javascript">
          <?php if($_SESSION['nuevo'] == 1){
            echo "$(window).on('load',function(){
                $('#changePass').modal('show');
            });";
          } ?>

        </script>


        <!-- =======================================================
Theme Name: Regna
Theme URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
Author: BootstrapMade.com
License: https://bootstrapmade.com/license/
======================================================= -->
    </head>

    <body >

        <!--==========================
Header
============================-->



        <header id="header">
            <div class="container">

                <div id="logo" class="pull-left">
                    <a href="#hero"><img src="img/logo.png" alt="" title="" /></img></a>
            </div>
            <form id="cs" action="Scripts/eliminarhistorial.php" method="POST">
            <nav id="nav-menu-container"  class="navbar navbar-dark bg-dark">
                <ul class="nav-menu ">

                    <li class="menu-active"><a href="#portfolio">Menú Principal</a></li>  
                    <li><a href="cursos.php">Ver cursos</a></li>

                        <li><a href="#" onclick="document.getElementById('cs').submit()"> Cerrar sesión</a></li>

                </ul>
            </nav><!-- #nav-menu-container -->
            </form>
            </div>
        </header><!-- #header -->

    <main id="main">

        <section id="portfolio">
            <div class="container wow fadeInUp">
                <div class="section-header">
                    <h3 class="section-title">Matrícula de Estudiantes</h3>
                    <p class="section-description">Consiste en la inscripción de estudiantes en cursos solicitados</p>
                </div>

                <section id="call-to-action">
                    <div class="container wow fadeIn">
                        <div class="row1">
                            <div class="column1">
                                <label for="" class="col-sm-2 form-control-label" id="cedula-estudiante"  >Cédula</label>
                                <div class="col-sm-10">
                                  <form action="Scripts/infoBasicaEstudiante.php" method="POST">
                                    <input type="number" name="cedula" id="cedula" min="1" required>
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                  </form>
                                    <br><br>
                                </div>
                                <label for="" class="col-sm-2 form-control-label" id="nombre-estudiante">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nombre" value="<?php echo $_SESSION["nombreEstudiante"]; ?>"readonly>
                                </div>
                            </div>

                            <div class="column1">
                                <label for="" class="col-sm-2 form-control-label" id="selectorcurso">Seleccione el curso</label>
                                <div class="col-sm-10">
                                  <?php
                                    $sql = "call getNombresCursoCm($idCom)";
                                    $res = $conn->query($sql);
                                  ?>
                                  <form action="Scripts/matricular.php" method="POST">
                                    <select class="form-control selectpicker" id="select-curso" name="select-curso" data-live-search="true">
                                      <?php while( $row = $res->fetch_array() ) {
                                        if(!empty($row['nombre'])) {?>
                                        <option data-tokens="<?php echo $row['nombre']; ?>" value="<?php echo $row['idcurso']; ?>">
                                        <?php echo $row['nombre']; ?>
                                        </option>
                                        <?php } } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center>
                      <br><br> <button type="submit" class="btn btn-success">Matricular</button>
                    </center>
                  </form>
                </section><!-- #call-to-action -->

                <center>
                    <br><br>  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Crear estudiante</button>
                </center>
            </div>
        </section><!-- #portfolio -->


        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registrar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body text-center">
                        <div class="col-md-12 col-sm-12 no-padng">
                            <form action="Scripts/crearEstudiante.php" method="post" id="userRegisterFrm" class="log-frm" name="userRegisterFrm">
                                <ul>
                                    <label>Cédula</label>
                                    <input type="number" placeholder="Cédula" name="cedula" class="form-control" required>
                                    <label>Nombre</label>
                                    <input type="text" placeholder="Nombre" name="fName" class="form-control" required>
                                    <label>Primer Apellido</label>
                                    <input type="text" placeholder="Primer Apellido" name="lName1" class="form-control" required>
                                    <label>Segundo Apellido</label>
                                    <input type="text" placeholder="Segundo Apellido" name="lName2" class="form-control" required>
                                    <label>Télefono</label>
                                    <input type="text" placeholder="Teléfono" name="telefono" class="form-control" required>
                                    <label>Correo</label>
                                    <input type="text" placeholder="Correo" name="correo" class="form-control" required>
                                    <br>
                                    <button name="userRegBtn" class="btn btn-primary">Registrar</button>
                                </ul>
                            </form>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--==========================
Hero Section
============================-->
<div id="changePass" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cambiar Contraseña</h4>
                <br>
                <p>Por favor cambie su clave termporal por su clave permanente.</p>
            </div>

            <div class="modal-body text-center">
                <div class="col-md-12 col-sm-12 no-padng">
                    <form action="Scripts/cambiarClave.php" method="post" id="cambiarCont" class="log-frm" name="userRegisterFrm">
                        <ul>
                            <label>Contraseña</label>
                            <input type="password" placeholder="Contraseña" name="password" id="password" class="form-control" required>
                            <label>Confirmar Contraseña</label>
                            <input type="password" placeholder="Confirmar Contraseña" name="confirm_password" id="confirm_password" class="form-control" required>
                            <span id='message'></span>
                            <br>
                            <br>
                            <button type="button" name="userRegBtn" class="btn btn-primary" onClick="check()">Actualizar</button>
                        </ul>
                    </form>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>



        <!--==========================
About Us Section
============================-->
        <section id="about" style="overflow: auto;">
            <center>
                <h2 class="title">Historial de matrícula</h2>
                <p>
                    Información de los útimos alumnos matrículados.
                </p>


                <div class="container">

                    <table class="table table-striped custab" id="tabla-historial">
                        <thead>
                            <tr>
                                <th class="text-center">Curso</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Primer Apellido</th>
                                <th class="text-center">Segundo Apellido</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <?php echo $_SESSION["historialmatricula"]; ?>
                    </table>

                </div>

                <div class="modal fade" id="desma" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">¡Atención!</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <p>Esta seguro que desea desmatricular al estudiante?</p>
                                <form action="Scripts/desmatriculahistorial.php" method="POST">
                                  <button type="submit" value="0" name="botonSi" class="btn btn-success btn-md" class="close" aria-hidden="true">Si</button>
                                  <button onClick="reset()" class="btn btn-danger btn-md" class="close" data-dismiss="modal" aria-hidden="true">No</button>
                                </form>
                            </center>
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

                </section><!-- #about -->

            <!--==========================
Facts Section
============================-->

            <!--==========================
Services Section
============================-->


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
        <script>
        $('#password, #confirm_password').on('keyup', function () {
          if ($('#password').val() != $('#confirm_password').val()) {
            $('#message').html('Contraseñas no coinciden').css('color', 'red');
          }
          else
            $('#message').html('').css('color', 'green');
          });
        function check(){
          if ($('#password').val() == $('#confirm_password').val()) {
            document.getElementById('cambiarCont').submit();
          }
        }
        </script>

        <!-- Template Main Javascript File -->
        <script src="js/main.js"></script>
        <script src="js/funproyecto.js"></script>
        <script type="text/javascript">
          function reply_click(clicked_id){
            document.getElementsByName("botonSi")[0].value=clicked_id;
          }
          function reset(){
            document.getElementsByName("botonSi")[0].value=0;
          }
        </script>


        </body>
</html>
