<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
unset($_SESSION["nombreEstudiante"]);
$ced = $_POST['cedula'];
  if($_POST){
    $sql = "call getNombreEstudiante($ced)";
    $res = $conn->query($sql);
    if (mysqli_num_rows($res)==0) {
      $_SESSION["infoGeneral"] = "El usuario no existe. Favor registrarlo o digite una nueva cédula.";
      header("Location: ../admin.php");
    }
    else{
      $row = mysqli_fetch_assoc($res);
      $_SESSION["nombreEstudiante"] = 'value="'.$row['nombre']." ".$row['primerapellido']." ".$row['segundoapellido'].'"';
      $_SESSION["cedulaEstudiante"] = $row['cedula'];
      header("Location: ../admin.php");
    }
  }
?>
