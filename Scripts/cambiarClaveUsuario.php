<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
if($_POST){
  $oldpas =  crypt($_POST['oldpassword'], '$5$YourSaltyStringz$');
  $pas =  crypt($_POST['newpassword'], '$5$YourSaltyStringz$');
  $id = $_SESSION['id'];
  //echo $oldpas;
  $call = mysqli_prepare($conn, 'CALL cambiarClaveUsuario(?,?, ?, @res)');

  mysqli_stmt_bind_param($call,'iss', $id,$oldpas, $pas);
  mysqli_stmt_execute($call);

  $select = mysqli_query($conn, 'SELECT @res');
  $result = mysqli_fetch_assoc($select);
  $procOutput_res = $result['@res'];
  if($procOutput_res == 1){
    echo "<SCRIPT type='text/javascript'>
       alert('Clave cambiada satisfactoriamente.');
       window.location.replace('../admin.php');
       </SCRIPT>";
  }
  else{
    echo "<SCRIPT type='text/javascript'>
       alert('Lo sentimos, la clave actual fue ingresada de forma incorrecta. Intentelo nuevamente.');
       window.location.replace('../admin.php');
       </SCRIPT>";
  }
}
 ?>
