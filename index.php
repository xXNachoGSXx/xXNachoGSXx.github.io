<?php
// Include DB conexion file
include "Scripts/conexion.php";
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

body scroll="no" style="overflow: hidden"  para no mover la pantalla
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
                                    <div class="box">
                                        <div class="box-body">
                                            <form>
                                                <div class="form-group row">
                                                    <label for="" class="col-sm-2 form-control-label">Comunidad</label>
                                                    <div class="col-sm-10">
                                                        <?php
                                                        $sql = "call getcomunidades()";
                                                        $res = $conn->query($sql);
                                                        ?>
                                                        <select class="form-control selectpicker" id="select-comunidad" data-live-search="true">
                                                            <?php while( $row = $res->fetch_array() ) {
    if(!empty($row['nombre'])) {?>
                                                            <option data-tokens="<?php echo $row['nombre']; ?>" value="<?php echo $row['idcomunidad']; ?>">
                                                                <?php echo $row['nombre']; ?>
                                                            </option>
                                                            <?php } } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <center>
                <br><br><br>
                <h4 class="title"><a href="#services" class="button">Buscar</a></h4>
                <br><br><br>


            </center>
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
                    <h3 class="section-title">Información de comunidad</h3>
                    <p class="section-description">Acerca de la información que posee cada comunidad y cursos impartidos</p>

                </div>
            </div>

            <center>

                <div class="form-group row">
                    <label for="" class="col-sm-2 form-control-label">Seleccione el curso</label>
                    <div class="col-sm-10">
                        <select class="form-control selectpicker" id="select-curso" data-live-search="true">
                            <option data-tokens="Tejido">Tejido</option>
                            <option data-tokens="Cocina Tradcional">Cocina Tradcional</option>
                            <option data-tokens="Manejo de alimentos">Manejo de alimentos</option>
                        </select>
                    </div>
                </div>
                <div class="row1">
                    <div class="column1" >
                        <table class="table table-borderless" id="tabla-comunidad">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nombre:</td>
                                    <td>Centro Comunitario de San Bosco</td>
                                </tr>
                                <tr>
                                    <td>Ubicación:</td>
                                    <td>San Bosco de Santa Bárbara de Heredia. Frente a la plaza de deportes.</td>
                                </tr>
                                <tr>
                                    <td>Teléfono:</td>
                                    <td>2269 5699</td>
                                </tr>
                                <tr>
                                    <td>Encargado:</td>
                                    <td>Mary Chavarria</td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                    <div class="column1" >
                        <table id="tabla-curso" class="table table-bordered">
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
                                    <td><b>Duración</b></td>
                                    <td>2 meses</td>
                                </tr>
                                <tr>
                                    <td><b>Precio</b></td>
                                    <td>15000 colones</td>
                                </tr>
                                <tr>
                                    <td><b>Cupos</b></td>
                                    <td>20</td>
                                </tr>
                            </tbody>
                            <!--Table body-->
                        </table>
                    </div>
                </div>
            </center>


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


    </body>
</html>
