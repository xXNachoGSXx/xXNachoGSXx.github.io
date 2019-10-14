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
                <li><a href="#" data-toggle="modal" data-target="#adminEst">Administrar Estudiantes</a></li>
                <li><a href="index.php">Cerrar Sesión</a></li>
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
                                          <option data-hidden="true" value="">Seleccione una comunidad</option>
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
                                <td>Dirección:</td>
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
                    <center>
                      <button type="button" class="<?php echo $_SESSION["clase"]; ?>" data-toggle='modal' data-target='#editarComunidad'>Editar</button>
                    </center>
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

    <div class="modal fade" id="desma" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">¡Atención!</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <p>Esta seguro que desea elminar a este administrador?</p>
                        <form action="Scripts/eliminarAdmin.php" method="POST">
                          <button type="submit" value="0" name="botonSi" class="btn btn-success btn-md" class="close" aria-hidden="true">Si</button>
                          <button onClick="reset()" class="btn btn-danger btn-md" class="close" data-dismiss="modal" aria-hidden="true">No</button>
                        </form>
                    </center>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
                </div>
                <div class="col-xs-4"></div>
            </form>
        </center>


    </section><!-- #services -->

    <div id="editarComunidad" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ediar Comunidad</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body text-center">
                    <div class="col-md-12 col-sm-12 no-padng">
                        <form action="Scripts/editarComunidad.php" method="POST" id="userRegisterFrm" class="log-frm" name="userRegisterFrm">
                                <label>Nombre</label>
                                <input type="text" value="<?php echo $fila['nombre']; ?>" name="nombre" class="form-control" required>
                                <label>Dirección</label>
                                <input type="text" value="<?php echo $fila['ubicacion']; ?>" name="ubi" class="form-control" required>
                                <label>Teléfono</label>
                                <input type="text" value="<?php echo $fila['telefono']; ?>" name="tel" class="form-control" required>
                                <label>Encargado</label>
                                <input type="text" value="<?php echo $fila['encargado']; ?>" name="enc" class="form-control" required>
                                <br>
                                <button type="submit" name="userRegBtn" class="btn btn-primary">Realizar cambios</button>
                        </form>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registrar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body text-center">
                    <div class="col-md-12 col-sm-12 no-padng">
                        <form action="Scripts/registrarAdmin.php" method="POST" id="registrarAdministrador" class="log-frm" name="registrarAdministrador">
                                <label>Cédula</label>
                                <input type="number" placeholder="Identificación" id="cedula" name="cedula" class="form-control" required>
                                <label>Nombre</label>
                                <input type="text" placeholder="Nombre" id="fName" name="fName" class="form-control" required>
                                <label>Primer Apellido</label>
                                <input type="text" placeholder="Primer Apellido" id="lName1" name="lName1" class="form-control" required>
                                <label>Segundo Apellido</label>
                                <input type="text" placeholder="Segundo Apellido" id="lName2" name="lName2" class="form-control" required>
                                <label>Teléfono</label>
                                <input type="text" placeholder="Teléfono" id="telefonoRegistrar" name="telefonoRegistrar" class="form-control" required>
                                <label>Nombre de Usuario</label>
                                <input type="text" placeholder="Nombre de Usuario" id="usuario" name="usuario" class="form-control" required>
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

    <div id="adminEst" class="modal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Administración de Estudiantes</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
                <div class="modal-body text-center">
                    <div class="col-md-12 col-sm-12 no-padng">
                      <?php
                        $res->close();
                        $conn->next_result();
                        $sql = "call getEstudiantes()";
                        $res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
                        ?>
                        <form action="Scripts/eliminarEstudiante.php" method="POST" id="elim">
                      <select class="form-control selectpicker" name="select-estudiante" id="select-estudiante" data-live-search="true">

                        <!-- <option data-hidden="true" value="">Seleccione un estudiante</option> -->
                        <?php while ($row = $res->fetch_array()) {
                        if (!empty($row['nombre'])) {?>
                        <option data-tokens="<?php echo $row['cedula']." ".$row['nombre']." ".$row['primerapellido']." ".$row['segundoapellido']; ?>" value="<?php echo $row['cedula']; ?>">
                          <?php echo $row['cedula']." - ".$row['nombre']." ".$row['primerapellido']." ".$row['segundoapellido']; ?>
                        </option>
                        <?php }
                        } ?>
                      </select>
                    </form>
                      <br>
                      <br>
                      <button id="conf" type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmacion">Eliminar</button>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmacion" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">¡Atención!</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <p>¿Esta seguro que desea eliminar al estudiante del sistema?</p>
                        <p>Esta operación es irreversible y causara que el estudiante sea desmatriculado de los cursos en que está presente.</p>
                        <p>Tomando esto en cuenta. ¿Desea continuar?</p>
                        <form action="Scripts/desmatricular.php" method="POST">
                          <button onclick="elim()" type="button" name="botonSi" class="btn btn-success btn-md" class="close" aria-hidden="true">Si</button>
                          <button class="btn btn-danger btn-md" class="close" data-dismiss="modal" aria-hidden="true">No</button>
                        </form>
                    </center>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <button id="terminosCo" data-toggle="modal" data-target="#terminos" style="display:none;"></button>
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
    if(document.getElementById('select-estudiante').length <=0 ){
      document.getElementById('conf').style.visibility = "hidden";
    }
    document.getElementById('btnRegistrar').style.visibility = "hidden";
    function reply_click(clicked_id){
      document.getElementsByName("botonSi")[0].value=clicked_id;
    }
    function reset(){
      document.getElementsByName("botonSi")[0].value=0;
    }
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
        function checkBox(){
          if (document.getElementById('checkb').checked) {
              document.getElementById('btnRegistrar').style.visibility = "visible";
          }
          else {
              document.getElementById('btnRegistrar').style.visibility = "hidden";
          }
        }
        function submitRegistro(){
          document.getElementById('registrarAdministrador').submit();
        }
        function chequear(){
          if(document.getElementById('cedula').value != "" &&
            document.getElementById('fName').value != "" &&
            document.getElementById('lName1').value != "" &&
            document.getElementById('lName2').value != "" &&
            document.getElementById('telefonoRegistrar').value != "" &&
            document.getElementById('usuario').value != ""){
            document.getElementById("terminosCo").click();
                $('#message').html('').css('color', 'green');
          }
          else{
            $('#message').html('Porfavor ingrese todos los datos').css('color', 'red');
          }
        }
        function elim(){
          document.getElementById('elim').submit();
        }
    </script>

    </body>
</html>
