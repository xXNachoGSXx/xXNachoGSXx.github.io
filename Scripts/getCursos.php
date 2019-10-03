<?php
include "conexion.php";
session_start();
if($_POST){
  $idCom = $_POST['com'];
  $sql = "call getNombresCursoCm($idCom)";
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
