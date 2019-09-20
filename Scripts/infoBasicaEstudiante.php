<?php
include "conexion.php";
session_start();
$ced = $_POST['cedula'];
  if($_POST){
    $sql = "call getNombreEstudiante($ced)";
    $res = $conn->query($sql);
    $row = mysqli_fetch_assoc($res);
    $_SESSION["nombreEstudiante"] = $row['nombre']." ".$row['primerapellido']." ".$row['segundoapellido'];
    $_SESSION["cedulaEstudiante"] = $row['cedula'];
    header("Location: ../admin.php");
  }
?>
