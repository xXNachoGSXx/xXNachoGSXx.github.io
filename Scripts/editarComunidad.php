<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
if($_POST){
  $nombre = $_POST['nombre'];
  $ubi = $_POST['ubi'];
  $tel = $_POST['tel'];
  $enc = $_POST['enc'];
  $idComunidad = $_SESSION["idComunidad"];

  $call = mysqli_prepare($conn, 'CALL actualizarcomunidad(?,?,?,?,?)');

  mysqli_stmt_bind_param($call,'issss', $idComunidad,$nombre, $tel,$enc,$ubi);
  mysqli_stmt_execute($call);

  $sql = "call getInfoComunidad($idComunidad)";
  $res = $conn->query($sql);
  $row = mysqli_fetch_assoc($res);
  $_SESSION["infoComunidad"]=serialize($row);

  echo "<script>
       alert('Modificación realizada satisfactoriamente.');
       window.location.replace('../super.php');
       </script>";

}
 ?>
