<?php
include "conexion.php";
session_start();
unset ($_SESSION['infoComunidad']);
unset ($_SESSION['infoComunidadAdmin']);
unset ($_SESSION['infoCurso']);
unset($_SESSION["nombreEstudiante"]);
unset($_SESSION["idComunidad"]);
unset($_SESSION["clase"]);
unset($_SESSION["nuevo"]);
unset($_SESSION["id"]);
unset($_SESSION["historialmatricula"]);
unset($_SESSION["infoAdmin"]);
    if($_POST){
        $usuario = $_POST['usuario'];
        $clave =  sha1($_POST['clave']);
        $call = mysqli_prepare($conn, 'CALL validarUser(?, ?, @res, @ptipo,@pid)');

      	mysqli_stmt_bind_param($call,'ss', $usuario, $clave);
      	mysqli_stmt_execute($call);

      	$select = mysqli_query($conn, 'SELECT @res, @ptipo, @pid');
      	$result = mysqli_fetch_assoc($select);
        if($result){
          $procOutput_res = $result['@res'];
          if($procOutput_res != 0){
            $procOutput_userTipo = $result['@ptipo'];
            $_SESSION["user"] = $usuario;
            $_SESSION["tipo"] = $procOutput_userTipo;
            $_SESSION["clase"] = "btn btn-primary hide";
            if($procOutput_userTipo == 1){
              header("Location: ../super.php");
            }
            else{
              $procOutput_idUSer = $result['@pid'];
              $sql = "call getidcomunidad($procOutput_idUSer)";
              $res = $conn->query($sql);
              $row = mysqli_fetch_assoc($res);
              $_SESSION["idComunidad"]=$row['idcomunidad'];
              $res->close();
              $conn->next_result();
              $sql = "call getNuevo($procOutput_idUSer)";
              $res = $conn->query($sql);
              $row = mysqli_fetch_assoc($res);
              $_SESSION["nuevo"]=$row['nuevo'];
              $_SESSION["id"]=$procOutput_idUSer;
              $res->close();
              $conn->next_result();
              $sql = "call getinfoadmin($procOutput_idUSer)";
              $res = $conn->query($sql);
              $row = mysqli_fetch_assoc($res);
              $_SESSION["infoAdmin"]=serialize($row);
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
