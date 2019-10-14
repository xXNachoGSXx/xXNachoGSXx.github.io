<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
$idEstudiante = $_POST['botonSi'];
$curso = $_SESSION["idCur"];
$iduser = $_SESSION['id'];
if($_POST){
  $sql = "call desmatricular($curso,$idEstudiante)";
  $res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
  $sql = "call getInfoCurso($curso)";
  $res = $conn->query($sql);
  $row = mysqli_fetch_assoc($res);
  $_SESSION["infoCurso"]=serialize($row);
  $res->close();
  $conn->next_result();
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
  $res->close();
  $conn->next_result();
  $sql = "call getHistorial($iduser)";
  $res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
  $str = "";
  while ($row = $res->fetch_array()) {
      if(!empty($row['Estudiante'])) {
        $str .= '<tr>
        <td>'.$row['Curso'].'</td>
        <td>'.$row['Estudiante'].'</td>
        <td>'.$row['Ap1'].'</td>
        <td>'.$row['Ap2'].'</td>
        <td class="text-center"> <a id="'.$row['cedula'].'" onClick="reply_click(this.id)" href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#desma"><span class="glyphicon glyphicon-remove"></span> Desmatricular</a></td>
        </tr>';
      }
  }
$_SESSION["historialmatricula"]=$str;
  $_SESSION["infoGeneral"] = "Estudiante desmatriculado satisfactoriamente.";
  header("Location: ../cursos.php");
}
?>
