<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
  if($_POST){
    $ced = $_SESSION["cedulaEstudiante"];
    $curso = $_POST["select-curso"];
    $idCom = $_SESSION["idComunidad"];
    $call = mysqli_prepare($conn, 'CALL matricular(?,?)');

    mysqli_stmt_bind_param($call,'ss', $ced, $curso);
    mysqli_stmt_execute($call);

    echo "<script>
         alert('Estudiante matriculado satisfactoriamente');
         window.location.replace('../admin.php');
         </script>";
  }
?>
