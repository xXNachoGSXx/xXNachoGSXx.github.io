<?php
include "Scripts/conexion.php";
session_start();
$idCom = $_SESSION["idComunidad"];
unset ($_SESSION['infoCurso']);
unset($_SESSION["infoMatricula"]);
unset($_SESSION["idCur"]);
unset($_SESSION["activo"]);
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
        <script type="text/javascript">
          <?php if(isset($_SESSION['infoGeneral'])){
            echo "$(window).on('load',function(){
                $('#info').modal('show');
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
                    <li><a data-toggle="modal" data-target="#editar"><span style="color:white" class="glyphicon glyphicon-cog"></span></a></li>
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
                                <label for="" class="col-sm-5 form-control-label" id="cedula-estudiante" style="color:white" >Seleccione el estudiante:</label>
                                  <br><br>
                                  <?php
                                    $sql = "call getEstudiantes()";
                                    $res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
                                    ?>
                                  <form action="Scripts/matricular.php" id="matri" method="POST">
                                    <select class="col-sm-8 form-control selectpicker" name="select-estudiante" id="select-estudiante" data-live-search="true">

                                      <option data-hidden="true" value="">Seleccione un estudiante</option>
                                      <?php while ($row = $res->fetch_array()) {
                                      if (!empty($row['nombre'])) {?>
                                      <option data-tokens="<?php echo $row['cedula']." ".$row['nombre']." ".$row['primerapellido']." ".$row['segundoapellido']; ?>" value="<?php echo $row['cedula']; ?>">
                                        <?php echo $row['cedula']." - ".$row['nombre']." ".$row['primerapellido']." ".$row['segundoapellido']; ?>
                                      </option>
                                      <?php }
                                      } ?>
                                    </select>
                                    <br><br>
                                <label for="" class="col-sm-2 form-control-label" id="selectorcurso">Seleccione el curso:</label>
                                <br><br>
                                  <?php
                                  $res->close();
                                  $conn->next_result();
                                    $sql = "call getNombresCursoCm($idCom,1)";
                                    $res = $conn->query($sql);
                                  ?>
                                    <select class=" col-sm-8 form-control selectpicker" id="select-curso" name="select-curso" data-live-search="true">
                                      <option data-hidden="true" value="">Seleccione un curso</option>
                                      <?php while( $row = $res->fetch_array() ) {
                                        if(!empty($row['nombre'])) {?>
                                        <option data-tokens="<?php echo $row['nombre']; ?>" value="<?php echo $row['idcurso']; ?>">
                                        <?php echo $row['nombre']; ?>
                                        </option>
                                        <?php } } ?>
                                    </select>
                        </div>
                    </div>
                    <center>
                      <br><br> <button type="button" class="btn btn-success" onClick="checkUser()">Matricular</button>
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
                            <form action="Scripts/crearEstudiante.php" method="post" id="registrarEst" class="log-frm" name="registrarEst">
                                    <label>Cédula</label>
                                    <input type="number" placeholder="Cédula" id="cedulaR" name="cedulaR" class="form-control" required>
                                    <label>Nombre</label>
                                    <input type="text" placeholder="Nombre" id="fName" name="fName" class="form-control" required>
                                    <label>Primer Apellido</label>
                                    <input type="text" placeholder="Primer Apellido" id="lName1" name="lName1" class="form-control" required>
                                    <label>Segundo Apellido</label>
                                    <input type="text" placeholder="Segundo Apellido" id="lName2" name="lName2" class="form-control" required>
                                    <label>Télefono</label>
                                    <input type="text" placeholder="Teléfono" name="telefono" id="telefono" class="form-control" required>
                                    <label>Correo</label>
                                    <input type="email" placeholder="Correo" id="correo" name="correo" class="form-control" required>
                                    <br>
                                    <span id='message'></span>
                                    <br>
                                    <br>
                                      <button type="button" name="userRegBtn" class="btn btn-primary" onclick="chequear()">Continuar</button>
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

                            <label>Contraseña</label>
                            <input type="password" placeholder="Contraseña" name="password" id="password" class="form-control" required>
                            <label>Confirmar Contraseña</label>
                            <input type="password" placeholder="Confirmar Contraseña" name="confirm_password" id="confirm_password" class="form-control" required>
                            <span id='message'></span>
                            <br>
                            <br>
                            <button type="button" name="userRegBtn" class="btn btn-primary" onClick="check()">Actualizar</button>

                    </form>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<div id="cambiarPass" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cambiar Contraseña</h4>
                <button type="button" class="close" data-dismiss="modal" data-toggle="modal" data-target="#editar" aria-hidden="true">×</button>
            </div>

            <div class="modal-body text-center">
                <div class="col-md-12 col-sm-12 no-padng">
                    <form action="Scripts/cambiarClaveUsuario.php" method="post" id="cambiarpassword" class="log-frm" name="userRegisterFrm">
                            <label>Contraseña actual</label>
                            <input type="password" placeholder="Contraseña actual" name="oldpassword" id="oldpassword" class="form-control" required>
                            <label>Nueva contraseña</label>
                            <input type="password" placeholder="Nueva contraseña" name="newpassword" id="newpassword" class="form-control" required>
                            <label>Confirmar Nueva Contraseña</label>
                            <input type="password" placeholder="Confirmar nueva contraseña" name="newconfirm_password" id="newconfirm_password" class="form-control" required>
                            <span id='message2'></span>
                            <br>
                            <br>
                            <button type="button" name="userRegBtn" class="btn btn-primary" onClick="check2()">Cambiar</button>
                    </form>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<div id="editar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registrar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body text-center">
                <div class="col-md-12 col-sm-12 no-padng">
                  <?php $fila =  unserialize($_SESSION["infoAdmin"]);?>
                    <form action="Scripts/editarAdmin.php" method="POST" id="userRegisterFrm" class="log-frm" name="userRegisterFrm">

                            <label>Cédula</label>
                            <input type="number" placeholder="Identificación" value="<?php echo $fila['idpersona']; ?>" name="ced" class="form-control" required>
                            <label>Nombre</label>
                            <input type="text" placeholder="Nombre" name="nom" value="<?php echo $fila['nombre']; ?>" class="form-control" required>
                            <label>Primer Apellido</label>
                            <input type="text" placeholder="Primer Apellido" name="lN1" value="<?php echo $fila['apellido1']; ?>"class="form-control" required>
                            <label>Segundo Apellido</label>
                            <input type="text" placeholder="Segundo Apellido" name="lN2" value="<?php echo $fila['apellido2']; ?>"class="form-control" required>
                            <label>Teléfono</label>
                            <input type="text" placeholder="Teléfono" name="tel" value="<?php echo $fila['telefono']; ?>"class="form-control" required>
                            <label>Nombre de Usuario</label>
                            <input type="text" placeholder="Nombre de Usuario" name="us" value="<?php echo $fila['usuario']; ?>"class="form-control" required>
                            <br>
                            <button type="button" name="userRegBtn" data-dismiss="modal" data-toggle="modal" data-target="#cambiarPass" class="btn btn-info">Cambiar Contraseña</button>
                            <br>
                            <br>
                            <br>
                            <button type="submit" name="userRegBtn" class="btn btn-primary">Realizar Cambios</button>

                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

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
                <div id="info" class="modal" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">¡Atención!</h4>
                          </div>
                            <div class="modal-body text-center">
                                <div class="col-md-12 col-sm-12 no-padng">
                                  <p><?php echo $_SESSION["infoGeneral"];
                                          unset($_SESSION["infoGeneral"]);?></p>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Aceptar</button>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
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

                    </div>
                </div>
            </div>


            <div id="terminos" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Términos y Condiciones</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>

                        <div class="form-group">
                    <div class="col-xs-12">
                        <div style="border: 2px solid #e5e5e5; height: 500px; overflow: auto; padding: 10px;">
                          <h2>Términos y Condiciones de Uso</h1>
                            <br>
                          <h4>INFORMACIÓN RELEVANTE</h3>
                            <br>
                            <p>Es requisito necesario para la adquisición de los productos que se ofrecen en
                              este sitio, que lea y acepte los siguientes Términos y Condiciones que a
                              continuación se redactan. El uso de nuestros servicios implicará que usted ha leído
                              y aceptado los Términos y Condiciones de Uso en el presente documento. Todos
                              los servicios que son ofrecidos por nuestro sitio web pudieran ser creadas,
                              cobradas, enviadas o presentadas por una página web tercera y en tal caso estarían
                              sujetas a los propios Términos y Condiciones.</p>
                            <p>El usuario colaborador puede elegir y cambiar la clave para su acceso de
                              administración de la cuenta en cualquier momento, en caso de que se haya
                              registrado y que sea necesario para el ejercicio de funciones. Sistema de Matrícula
                              Comunitaria, no asume la responsabilidad en caso de que entregue dicha clave a
                              terceros.</p>
                              <h4>LICENCIA</h3>
                                <br>
                            <p>Tecnológico de Costa Rica, a través de su sitio web concede una licencia
                              para que los usuarios utilicen de aplicaciones de estudiantes, y puedan utilizarlas
                              para objetivos didácticos.</p>
                              <h4>USO NO AUTORIZADO</h3>
                                <br>
                            <p>En caso de que aplique (para venta de software, templetes, u otro producto
                              de diseño y programación) usted no puede colocar uno de nuestros productos,
                              modificado o sin modificar, en un CD, sitio web o ningún otro medio y ofrecerlos
                              para la redistribución o la reventa de ningún tipo.</p>
                              <h4>PROPIEDAD</h3>
                                <br>
                            <p>Usted no puede declarar propiedad intelectual o exclusiva a ninguno de
                              nuestros productos, modificado o sin modificar. Todos los productos son propiedad
                              de los proveedores del contenido Carlos Adrián Gómez Segura y Gabriel Solórzano
                              Chanto. En caso de que no se especifique lo contrario, nuestros productos se
                              proporcionan sin ningún tipo de garantía, expresa o implícita. En ningún esta
                              compañía será responsables de ningún daño incluyendo, pero no limitado a, daños
                              directos, indirectos, especiales, fortuitos o consecuentes u otras pérdidas
                              resultantes del uso o de la imposibilidad de utilizar nuestros servicios.</p>
                              <h4>COMPROBACIÓN ANTIFRAUDE</h3>
                                <br>
                            <p>El ejercicio de funciones puede ser aplazada para la comprobación
                              antifraude. También puede ser suspendida por más tiempo para una investigación
                              más rigurosa, para evitar transacciones y matrículas fraudulentas.</p>
                              <h4>PRIVACIDAD</h3>
                                <br>
                              <p>Este servicio Web Sistema de Matrícula garantiza que la información
                                personal que usted envía cuenta con la seguridad necesaria. Los datos ingresados
                                por usuario o en el caso de requerir una validación de los pedidos no serán
                                entregados a terceros, salvo que deba ser revelada en cumplimiento a una orden
                                judicial o requerimientos legales.
                                Tecnológico de Costa Rica y Sistema de Matrícula Comunitaria, reserva los
                                derechos de cambiar o de modificar estos términos sin previo aviso.</p>
                        </div>
                    </div>
                    <div class="form-group">
                      <!-- <div class="col-xs-12"> -->
                      <br>
                      <center>
                      <a href="terms/terminos-condiciones.pdf" download>Descargar PDF</a>
                    </center>
                      <br>
                      <center>
                    <div class="form-check-inline">
                      <br><br>
                        <label><input type="checkbox" id="checkb" name="checkb" onclick="checkBox();"> Acepto</label>
                      <!-- </div> -->
                    </div>
                    <br><br>
                            <button type="button" id="btnRegistrar" class="btn btn-primary" onclick="submitRegistro()">Registrar</button>
                    </center>
                  </div>
                </div>
                    </div>
                </div>
            </div>

                  <button id="terminosCo" data-toggle="modal" data-target="#terminos" style="display:none;"></button>
      </section>
        </main>

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
        document.getElementById('btnRegistrar').style.visibility = "hidden";
        function chequear(){
          if(document.getElementById('cedulaR').value != "" &&
            document.getElementById('fName').value != "" &&
            document.getElementById('lName1').value != "" &&
            document.getElementById('lName2').value != "" &&
            document.getElementById('telefono').value != "" &&
            document.getElementById('correo').value != ""){
              document.getElementById("terminosCo").click();
              $('#message').html('').css('color', 'green');
          }
          else{
            $('#message').html('Porfavor ingrese todos los datos').css('color', 'red');
          }
        }
        function checkBox(){
          if (document.getElementById('checkb').checked) {
              document.getElementById('btnRegistrar').style.visibility = "visible";
          }
          else {
              document.getElementById('btnRegistrar').style.visibility = "hidden";
          }
        }
        $('#password, #confirm_password').on('keyup', function () {
          if ($('#password').val() != $('#confirm_password').val()) {
            $('#message').html('Contraseñas no coinciden').css('color', 'red');
          }
          else
            $('#message').html('').css('color', 'green');
          });

          $('#newpassword, #newconfirm_password').on('keyup', function () {
            if ($('#newpassword').val() != $('#newconfirm_password').val()) {
              $('#message2').html('Contraseñas no coinciden').css('color', 'red');
            }
            else
              $('#message2').html('').css('color', 'green');
            });

        function check(){
          if ($('#password').val() == $('#confirm_password').val()) {
            if ($('#password').val() != ""){
              document.getElementById('cambiarCont').submit();
            }
            else {
              alert("Porfavor ingrese la nueva contraseña.");
            }
          }
        }
        function check2(){
          if ($('#newpassword').val() == $('#newconfirm_password').val()) {
            if($('#oldpassword').val() != ""){
              if ($('#newpassword').val() != ""){
                document.getElementById('cambiarpassword').submit();
              }
              else {
                alert("Porfavor ingrese la nueva contraseña.");
              }
            }
            else{
              alert("Porfavor ingrese la contraseña actual.");
            }
          }
        }
        function submitRegistro(){
          document.getElementById('registrarEst').submit();
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
          function checkUser(){
            var books = $('#select-curso');
            var books2 = $('#select-estudiante');
            //if (document.getElementById('nombreEst').hasAttribute("value")) {
            if(books2.val() === ''){
              alert('Debe de seleccionar un estudiante.');
            }
            else{
                if(books.val() === ''){
                  alert('Debe de seleccionar un curso.');
                }
                else {
                  document.getElementById('matri').submit();
                }
            }
            //}
            // else {
            //   alert('Debe de ingresar la cédula de un estudiante primero.');
            // }
          }
        </script>
        </body>
</html>
