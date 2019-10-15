<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
if($_POST){
  $pas =  sha1($_POST['password']);
  $id = $_SESSION['id'];
  $call = mysqli_prepare($conn, 'CALL cambiarClave(?,?)');

  mysqli_stmt_bind_param($call,'si', $pas, $id);
  mysqli_stmt_execute($call);

  $sql = "call getNuevo($procOutput_idUSer)";
  $res = $conn->query($sql);
  $row = mysqli_fetch_assoc($res);
  $_SESSION["id"]=$procOutput_idUSer;
  $_SESSION["nuevo"]=$row['nuevo'];
  $_SESSION["infoGeneral"] = "Contraseña actualizada satisfactoriamente.";
  header("Location: ../admin.php");
}
?>
