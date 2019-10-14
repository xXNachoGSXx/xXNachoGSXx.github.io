<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
if($_POST){
  $idCom = $_SESSION["idComunidad"];
  $activo = $_POST['act'];
  $sql = "call getNombresCursoCm($idCom,$activo)";
  $res = $conn->query($sql);
  $users_arr = array();
  while( $row = $res->fetch_array() ){
    $comid = $row['idcurso'];
    $name = $row['nombre'];
    $users_arr[] = array("id" => $comid, "name" => $name);
  }
  echo json_encode($users_arr);
}
?>
