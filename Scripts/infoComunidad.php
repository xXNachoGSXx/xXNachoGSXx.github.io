<?php
  include "conexion.php";
  session_start();
  $idComunidad = $_POST['select-comunidad'];
  if($_POST){
    $sql = "call getInfoComunidad($idComunidad)";
    $res = $conn->query($sql);
    $row = mysqli_fetch_assoc($res);
    //echo $row['ubicacion'];
    $_SESSION["infoComunidad"]=serialize($row);
    header("Location: ../super.php");
  }
?>
