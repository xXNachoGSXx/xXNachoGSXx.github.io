<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
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
