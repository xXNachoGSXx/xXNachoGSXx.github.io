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
    $telefono = $_POST["telefono"];
    $usuario = $_POST["usuario"];
    $idCom = $_SESSION["idComunidad"];
    $tipo = 2;
    $call = mysqli_prepare($conn, 'CALL registrarAdmin(?,?,?,?,?,?,?,?,?)');
    mysqli_stmt_bind_param($call,'ssiisssii', $usuario, $cedula,$tipo,$cedula,$nombre,$ln1,$ln2,$idCom,$telefono);
    mysqli_stmt_execute($call);
    $idComunidad = $_SESSION["idComunidad"];
    $sql = "call getAdminComunidad($idComunidad)";
    $res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
    //$row = mysqli_fetch_array($res);
    $str = "";
    while ($row = $res->fetch_array()) {
        if(!empty($row['nombre'])) {
            $str .= '<tr>
          <td>'.$row['nombre']." ".$row['apellido1']." ".$row['apellido2']."</td>
          <td>".$row['telefono']."</td>
          <td>".$row['usuario']."</td>
      </tr>";
        }
    }
    $_SESSION["infoComunidadAdmin"]=$str;

    echo "<script>
         alert('Administrador creado. Contraseña temporal: $cedula');
         window.location.replace('../super.php');
         </script>";
  }
?>
