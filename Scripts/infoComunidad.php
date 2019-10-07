<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
unset ($_SESSION['infoComunidad']);
unset ($_SESSION['infoComunidadAdmin']);
$idComunidad = $_POST['select-comunidad'];
$_SESSION["idComunidad"] = $idComunidad;
if($_POST){
    $sql = "call getInfoComunidad($idComunidad)";
    $res = $conn->query($sql);
    $row = mysqli_fetch_assoc($res);
    $_SESSION["infoComunidad"]=serialize($row);
    $res->close();
    $conn->next_result();
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
    $_SESSION["clase"] = "btn btn-primary";
    header("Location: ../super.php");
}
?>
