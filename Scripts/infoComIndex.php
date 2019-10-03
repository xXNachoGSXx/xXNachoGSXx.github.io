<?php
include "conexion.php";
session_start();
if($_POST){
  $idComunidad = $_POST['com'];
  $sql = "call getInfoComunidad($idComunidad)";
  $res = $conn->query($sql);
  $row = mysqli_fetch_assoc($res);
  $users_arr = array();
  $users_arr[] = array("nombre" => $row['nombre'], "ubi" => $row['ubicacion']
                      , "tel" => $row['telefono'], "enc" => $row['encargado']);
  echo json_encode($users_arr);
}
?>
