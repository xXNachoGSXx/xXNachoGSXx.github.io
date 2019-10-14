<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
if($_POST){
  $nombre = $_POST['nombre'];
  $descripcion =  $_POST['descripcion'];
  $profesor = $_POST['profe'];
  $cupos = $_POST['cupos'];
  $precio = $_POST['precio'];
  $horario = $_POST['horario'];
  $duracion = $_POST['duracion'];
  $idComunidad = $_SESSION["idComunidad"];
  echo $idComunidad;

  $call = mysqli_prepare($conn, 'CALL crearcurso(?,?,?,?,?,?,?,?)');
  mysqli_stmt_bind_param($call,'sssisiis', $nombre, $descripcion,$profesor,$cupos,$horario,$idComunidad,$precio,$duracion);
  mysqli_stmt_execute($call);

  $_SESSION["infoGeneral"] = "Curso creado satisfactoriamente.";
  header("Location: ../cursos.php");
}
 ?>
