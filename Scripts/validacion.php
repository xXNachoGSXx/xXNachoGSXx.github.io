<?php
include "conexion.php";
session_start();
unset ($_SESSION['infoComunidad']);
    if($_POST){
        $usuario = $_POST['usuario'];
        $clave =  $_POST['clave'];

        $call = mysqli_prepare($conn, 'CALL validarUser(?, ?, @res, @ptipo,@pid)');

      	mysqli_stmt_bind_param($call,'ss', $usuario, $clave);
      	mysqli_stmt_execute($call);

      	$select = mysqli_query($conn, 'SELECT @res, @ptipo, @pid');
      	$result = mysqli_fetch_assoc($select);
        if($result){
          $procOutput_res = $result['@res'];
          if($procOutput_res != 0){
            $procOutput_userTipo = $result['@ptipo'];
            if($procOutput_userTipo == 1){
              header("Location: ../super.php");
            }
            else{
              $procOutput_idUSer = $result['@pid'];
              $sql = "call getidcomunidad($procOutput_idUSer)";
              $res = $conn->query($sql);
              $row = mysqli_fetch_assoc($res);
              $_SESSION["idComunidad"]=$row['idcomunidad'];
              header("Location: ../admin.php");
            }
          }
          else{
            echo "<SCRIPT type='text/javascript'>
               alert('Usuario o Contraseña inválidos');
               window.location.replace('../index.php');
               </SCRIPT>";
          }
        }
        else{
          echo "<SCRIPT type='text/javascript'>
             alert('Ocurrio un error con la Base de Datos, por favor intente denuevo más tarde.');
             window.location.replace('../index.php');
             </SCRIPT>";
        }
    }
?>