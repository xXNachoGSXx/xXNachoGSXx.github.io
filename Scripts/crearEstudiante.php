<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
  if($_POST){
    $ced = $_POST['cedula'];
    $nombre = $_POST['fName'];
    $ln1 =  $_POST['lName1'];
    $ln2 =  $_POST['lName2'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $call = mysqli_prepare($conn, 'CALL crearEstudiante(?,?,?,?,?,?)');

    mysqli_stmt_bind_param($call,'isssss', $ced, $nombre, $ln1,$ln2,$telefono,$correo);
    mysqli_stmt_execute($call);
    echo "<script>
         alert('Estudiante creado satisfactoriamente');
         window.location.replace('../admin.php');
         </script>";
  }
?>
