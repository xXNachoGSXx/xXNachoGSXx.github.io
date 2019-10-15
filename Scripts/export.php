<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
$idCurso = $_SESSION["idCur"];
$sql = "call getNombreCurso($idCurso)";
$res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
$row = mysqli_fetch_assoc($res);
$nombre = $row['nombre'];
$nombre = str_replace(' ', '-', $nombre);
@header("Content-Disposition: attachment; filename=Estudiantes-$nombre.csv");
$res->close();
$conn->next_result();
$sql = "call matriculadosDescarga($idCurso)";
$res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
$data.="Cedula,Nombre,Primer Apellido, Segundo Apellido, Correo, Teléfono\n";
while ($row = $res->fetch_array()) {
  $data.=$row['cedula'].",";
  $data.=$row['nombre'].",";
  $data.=$row['primerapellido'].",";
  $data.=$row['segundoapellido'].",";
  $data.=$row['correo'].",";
  $data.=$row['telefono']."\n";
}
echo $data;
?>
