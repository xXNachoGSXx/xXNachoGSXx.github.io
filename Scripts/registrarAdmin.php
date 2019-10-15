<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
  if($_POST){
    $cedula = $_POST["cedula"];
    $nombre = $_POST["fName"];
    $ln1 = $_POST["lName1"];
    $ln2 = $_POST["lName2"];
    $telefono = $_POST["telefonoRegistrar"];
    $usuario = $_POST["usuario"];
    $idCom = $_SESSION["idComunidad"];
    $tipo = 2;
    $sql = "call existeUsuario('$usuario')";
    $res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
    $row = mysqli_fetch_assoc($res);
    if($row["existe"] == 1){
      $_SESSION["infoGeneral"] = "Lo sentimos, este nombre de usuario ya está tomado.";
      header("Location: ../super.php");
    }else {
      $res->close();
      $conn->next_result();
      $sql = "call existePersona($cedula)";
      $res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
      $row = mysqli_fetch_assoc($res);
      if($row["existe"] == 1){
        $_SESSION["infoGeneral"] = "Lo sentimos, ya existe un administrador con esta cédula en el sistema.";
        header("Location: ../super.php");
      }else {
        $res->close();
        $conn->next_result();
        $call = mysqli_prepare($conn, 'CALL registrarAdmin(?,?,?,?,?,?,?,?,?)');
        $pas = sha1($cedula);
        mysqli_stmt_bind_param($call,'ssiisssis', $usuario, $pas,$tipo,$cedula,$nombre,$ln1,$ln2,$idCom,$telefono);
        mysqli_stmt_execute($call) or die ('Unable to execute query. '. mysqli_error($conn));
        $idComunidad = $_SESSION["idComunidad"];
        $sql = "call getAdminComunidad($idComunidad)";
        $res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
        $str = "";
        while ($row = $res->fetch_array()) {
            if(!empty($row['nombre'])) {
                $str .= '<tr>
              <td>'.$row['nombre']." ".$row['apellido1']." ".$row['apellido2']."</td>
              <td>".$row['telefono']."</td>
              <td>".$row['usuario']."</td>
              <td><a id='".$row['idpersona']."' onClick='reply_click(this.id)' data-toggle='modal' data-target='#desma' class='btn btn-sm btn-danger'><span style='color:white'class='glyphicon glyphicon-minus-sign'></span></a></td>
          </tr>";
            }
        }
        $_SESSION["infoComunidadAdmin"]=$str;

        $_SESSION["infoGeneral"] = "Administrador creado satisfactoriamente. Contraseña temporal: $cedula";
        header("Location: ../super.php");
      }
    }
  }
?>
