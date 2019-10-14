<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
if($_POST){
  $nombre = $_POST['nom'];
  $des = $_POST['des'];
  $prof = $_POST['prof'];
  $dur = $_POST['dur'];
  $hor = $_POST['hor'];
  $prec = $_POST['prec'];
  $cupo = $_POST['cupo'];
  $idCurso = $_SESSION["idCur"];
  $call = mysqli_prepare($conn, 'CALL actualizarCurso(?,?,?,?,?,?,?,?)');

  mysqli_stmt_bind_param($call,'issssssi', $idCurso,$nombre, $des,$prof,$dur,$hor,$prec,$cupo);
  mysqli_stmt_execute($call) or die ('Unable to execute query. '. mysqli_error($conn));
  $sql = "call getInfoCurso($idCurso)";
  $res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
  $row = mysqli_fetch_assoc($res);
  $_SESSION["infoCurso"]=serialize($row);
  $_SESSION["infoGeneral"] = "Modificación realizada satisfactoriamente.";
  header("Location: ../cursos.php");
}
?>
