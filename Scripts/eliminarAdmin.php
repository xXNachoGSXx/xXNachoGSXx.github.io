<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
if($_POST){
  $idAdmin = $_POST['botonSi'];
  $sql = "call eliminarusuario($idAdmin)";
  $res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
  $idComunidad = $_SESSION["idComunidad"];
  // $res->close();
  // $conn->next_result();
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
        <td><a id='".$row['idpersona']."' onClick='reply_click(this.id)' data-toggle='modal' data-target='#desma' class='btn btn-sm btn-danger'><span style='color:white'class='glyphicon glyphicon-minus-sign'></span></a></td>
    </tr>";
      }
  }
  $_SESSION["infoComunidadAdmin"]=$str;
  $_SESSION["infoGeneral"] = "Administrador eliminado satisfactoriamente.";
  header("Location: ../super.php");
}
?>
