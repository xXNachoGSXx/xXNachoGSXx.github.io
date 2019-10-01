<?php
  include "conexion.php";
  session_start();
  if (!isset($_SESSION['user'])){
      header("Location: ../index.php");
  }
  $iduser = $_SESSION['id'];
  $sql = "call eliminarHistorial($iduser)";
  $conn->query($sql);
  unset ($_SESSION['user']);
  header("Location: ../index.php");
?>
