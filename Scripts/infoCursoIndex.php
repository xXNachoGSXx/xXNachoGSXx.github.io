<?php
include "conexion.php";
session_start();
if($_POST){
  $idCurso = $_POST['cur'];
  $sql = "call getInfoCurso($idCurso)";
  $res = $conn->query($sql);
  $row = mysqli_fetch_assoc($res);
  $users_arr = array();
  $users_arr[] = array("nombre" => $row['nombre'], "des" => $row['descripcion']
                      , "prof" => $row['profesor'], "hor" => $row['horario']
                      , "prec" => $row['precio'], "cupo" => $row['cuposdisponibles']);
  echo json_encode($users_arr);
}
 ?>
