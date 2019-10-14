<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
if($_POST){
  $cedula = $_POST["select-estudiante"];
  $sql = "call eliminarEstudiante($cedula)";
  $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
  $_SESSION["infoGeneral"] = "El estudiante fue eliminado satisfactoriamente de la base de datos.";
  header("Location: ../super.php");
}
?>
