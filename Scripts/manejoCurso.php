<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
if($_POST){
  $idcur = $_POST['botonSiManejo'];
  echo $idcur;
  $sql = "call manejoCurso($idcur)";
  $conn->query($sql);
  $sql = "call getActivo($idcur)";
  $res = $conn->query($sql);
  $row = mysqli_fetch_assoc($res);
  $_SESSION["activo"] = $row['activo'];
  if($_SESSION["activo"] == 1){
      $_SESSION["infoGeneral"] = "El curso ha sido activado satisfactoriamente.";
  }
  else{
    $_SESSION["infoGeneral"] = "El curso ha sido desactivado satisfactoriamente.";
  }
  header("Location: ../cursos.php");
}
?>
