<?php
include "Scripts/conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: index.php");
}
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

            <nav id="nav-menu-container"  class="navbar navbar-dark bg-dark">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="index.php">Atrás</a></li>
                </ul>
            </nav><!-- #nav-menu-container -->
            </div>
        </header><!-- #header -->


    <!--==========================
Inicio de sesión
============================-->


    <!--==========================
Hero Section
============================-->
    <main id="main">

        <!--==========================
About Us Section
============================-->
        <section id="about">
            <center>
                <h1>Acerca de nosotros</h1>
                <p> Estudiantes del Tecnológico de Costa Rica  </p>
                <p class="mt-3" >Actualmente cursando el curso de Computación y sociedad, donde se busca a través de este proyecto brindar una herramienta a la sociedad, que facilite el proceso de matrícula para los cursos impartidos por disitntas comunidades del país.</p>
                <!--Carousel Wrapper-->
                <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">
                    <!--/.Controls-->
                    <!--/.Indicators-->

                    <!--Slides-->

                    <!--First slide-->
                    <div class="carousel-item active">

                        <div class="col-md-6">
                            <div class="card mb-2">
                                <img class="card-img-top i"
                                     src="img/gabriel.jpg"
                                     alt="Card image cap ">
                                <div class="card-body">
                                    <h4 class="card-title">Gabriel Solórzano Chanto </h4>
                                    <p class="card-text">Santa Bárbara, Heredia</p>
                                    <p class="card-text">Correo: g.solorzano97@hotmail.com</p>
                                    <p class="card-text">Teléfono Celular: +506 8706 2905</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-2">
                                <img class="card-img-top i"
                                     src="img/carlos.jpg"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title">Carlos Gómez Segura</h4>
                                    <p class="card-text">Santo Domingo, Heredia</p>
                                    <p class="card-text">Correo: cagsegura0499@gmail.com</p>
                                    <p class="card-text">Teléfono Celular: +506 8661 5654</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/.First slide-->

                </div>
                <!--/.Carousel Wrapper-->

                <div class="footer-top">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-xl-4 col-sm-8 col-lg-4">
                                <div class="single-footer-widget footer_3">
                                    <img src="img/logotec.png" alt="Avatar" class="image">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </section><!-- #about -->

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
