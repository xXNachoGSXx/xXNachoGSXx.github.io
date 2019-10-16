<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
unset($_SESSION["nombreEstudiante"]);
  if($_POST){
    $ced = $_POST['cedulaR'];
    $nombre = $_POST['fName'];
    $ln1 =  $_POST['lName1'];
    $ln2 =  $_POST['lName2'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $err =0;
    $call = mysqli_prepare($conn, 'CALL crearEstudiante(?,?,?,?,?,?)');

    mysqli_stmt_bind_param($call,'isssss', $ced, $nombre, $ln1,$ln2,$telefono,$correo);
    mysqli_stmt_execute($call) or $err = 1;
    if($err == 0){
      $_SESSION["infoGeneral"] = "Estudiante creado satisfactoriamente.";
      header("Location: ../admin.php");
    }
    else {
      $_SESSION["infoGeneral"] = "Error, un estudiante con la misma cédula ya existe en el sistema.";
      header("Location: ../admin.php");
    }
  }
?>
