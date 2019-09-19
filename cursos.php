<?php
include "Scripts/conexion.php";
session_start();
$idCom = $_SESSION["idComunidad"];
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



        <!-- =======================================================
Theme Name: Regna
Theme URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
Author: BootstrapMade.com
License: https://bootstrapmade.com/license/
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

            <nav id="nav-menu-container"  class="navbar navbar-dark bg-dark">
                <ul class="nav-menu">
                    <li data-toggle="modal" data-target="#myModal"><a href="#">Crear curso</a></li>
                    <li><a href="admin.php">Atrás</a></li>
                </ul>
            </nav><!-- #nav-menu-container -->
            </div>
        </header><!-- #header -->


    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Creación de curso</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="/examples/actions/confirmation.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre" required="required">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="descripcion" placeholder="Descripción" required="required">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="profe" placeholder="Profesor" required="required">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="cupos" placeholder="Cantidad de cupos" required="required">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="precio" placeholder="Precio" required="required">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="horario" placeholder="Horario" required="required">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="duracion" placeholder="Duración" required="required">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Crear curso</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <main id="main">

        <section id="portfolio">
            <div class="container wow fadeInUp">
                <div class="section-header">
                    <h3 class="section-title">Visualizador de cursos</h3>
                    <p class="section-description">Consiste en la visualización de los cursos de una comunidad</p>
                </div>
                <label for="" class="col-sm-2 form-control-label"  >Seleccione curso</label>
                <div class="col-sm-10">
                  <?php
                    $sql = "call getNombresCursoCm($idCom)";
                    $res = $conn->query($sql);
                  ?>
                    <select class="form-control selectpicker" id="select-country" data-live-search="true">
                      <?php while( $row = $res->fetch_array() ) {
                        if(!empty($row['nombre'])) {?>
                        <option data-tokens="<?php echo $row['nombre']; ?>" value="<?php echo $row['idcurso']; ?>">
                        <?php echo $row['nombre']; ?>
                        </option>
                        <?php } } ?>
                    </select>
                </div>
                <center>
                    <br><br> <button class="btn btn-primary">Visualizar</button>
                </center>
            </div>


            <div class="section-header">
                <h3 class="section-title">Información de curso</h3>
            </div>


            <center>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-10">
                        </div>
                        <div class="col-sm">
                            <table id="tablePreview" class="table table-bordered">
                                <!--Table body-->
                                <tbody>
                                    <tr>
                                        <td><b>Nombre</b></td>
                                        <td>Tejido</td>
                                    </tr>
                                    <tr>
                                        <td><b>Descripción</b></td>
                                        <td>Se tratarán los temas principales con respecto al tejido con telar.</td>
                                    </tr>
                                    <tr>
                                        <td><b>Profesor</b></td>
                                        <td>Andrea Montero</td>
                                    </tr>
                                    <tr>
                                        <td><b>Horario</b></td>
                                        <td>Jueves 6pm - 8 pm</td>
                                    </tr>
                                    <tr>
                                        <td><b>Precio</b></td>
                                        <td>15000</td>
                                    </tr>
                                    <tr>
                                        <td><b>Cupos</b></td>
                                        <td>20</td>
                                    </tr>
                                </tbody>
                                <!--Table body-->
                            </table>
                        </div>
                        <div class="col-sm-10">
                        </div>
                    </div>
                </div>
            </center>



            <div class="section-header">
                <h3 class="section-title">Estudiantes inscritos</h3>
            </div>

            <center>

                <div class="container">

                    <table class="table table-striped custab">
                        <thead>
                            <tr>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>402430534</td>
                            <td>Carlos</td>
                            <td>Gómez</td>
                            <td class="text-center"> <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#desma"><span class="glyphicon glyphicon-remove"></span> Desmatricular</a></td>
                        </tr>
                        <tr>
                            <td>116920331</td>
                            <td>Gabriel</td>
                            <td>Solózano</td>
                            <td class="text-center"> <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#desma"><span class="glyphicon glyphicon-remove"></span> Desmatricular</a></td>
                        </tr>
                        <tr>
                            <td>402220111</td>
                            <td>Adriana</td>
                            <td>Álvarez</td>
                            <td class="text-center"><a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#desma"><span class="glyphicon glyphicon-remove"></span> Desmatricular</a></td>
                        </tr>
                    </table>

                </div>

            </center>

            <div class="modal fade" id="desma" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">¡Atención!</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <p>Esta seguro que desea desmatricular al estudiante?</p>
                                <button class="btn btn-success btn-md" class="close" data-dismiss="modal" aria-hidden="true">Si</button>
                                <button class="btn btn-danger btn-md" class="close" data-dismiss="modal" aria-hidden="true">No</button>
                            </center>
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


        </section><!-- #portfolio -->

        <!--==========================
Hero Section
============================-->




        <!--==========================
About Us Section
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
                <small>&copy; Copyright 2019, Gabriel Solórzano, Carlo Gómez</small>
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


    </body>
</html>
