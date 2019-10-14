<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
if($_POST){
  $id = $_SESSION['id'];
  $cedula = $_POST["ced"];
  $nombre = $_POST["nom"];
  $ln1 = $_POST["lN1"];
  $ln2 = $_POST["lN2"];
  $telefono = $_POST["tel"];
  $usuario = $_POST["us"];

  $call = mysqli_prepare($conn, 'CALL actualizarAdmin(?,?,?,?,?,?,?)');

  mysqli_stmt_bind_param($call,'isssssi', $cedula,$nombre,$ln1,$ln2, $telefono,$usuario,$id);
  mysqli_stmt_execute($call);
  $sql = "call getinfoadmin($id)";
  $res = $conn->query($sql);
  $row = mysqli_fetch_assoc($res);
  $_SESSION["infoAdmin"]=serialize($row);
  $_SESSION["infoGeneral"] = "Modificación de datos realizada satisfactoriamente.";
  header("Location: ../admin.php");
}
 ?>
