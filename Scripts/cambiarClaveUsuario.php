<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
if($_POST){
  $oldpas =  crypt($_POST['oldpassword'], '$5$YourSaltyStringz$');
  $pas =  crypt($_POST['newpassword'], '$5$YourSaltyStringz$');
  echo $oldpas;
  $id = $_SESSION['id'];
}
 ?>
