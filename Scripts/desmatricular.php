<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
$idEstudiante = $_POST['botonSi'];
$curso = $_SESSION["idCur"];
if($_POST){
  $sql = "call desmatricular($curso,$idEstudiante)";
  $res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
  $sql = "call matriculados($curso)" or die ('Unable to execute query. '. mysqli_error($conn));;
  $res = $conn->query($sql);
  $str = "";
  while ($row = $res->fetch_array()) {
      if(!empty($row['nombre'])) {
        $str .= '<tr>
        <td>'.$row['cedula'].'</td>
        <td>'.$row['nombre'].'</td>
        <td>'.$row['primerapellido'].'</td>
        <td>'.$row['segundoapellido'].'</td>
        <td class="text-center"> <a id="'.$row['cedula'].'" onClick="reply_click(this.id)" href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#desma"><span class="glyphicon glyphicon-remove"></span> Desmatricular</a></td>
        </tr>';
      }
  }
  $_SESSION["infoMatricula"]=$str;

  echo "<script>
       alert('Estudiante desmatriculado satisfactoriamente');
       window.location.replace('../cursos.php');
       </script>";
}
?>
