<?php
  include "conexion.php";
  session_start();
  $idCurso = $_POST['select-curso'];
  if($_POST){
    $sql = "call getInfoCurso($idCurso)";
    $res = $conn->query($sql);
    $row = mysqli_fetch_assoc($res);
    $_SESSION["infoCurso"]=serialize($row);

    $res->close();
    $conn->next_result();
    $sql = "call matriculados($idCurso)";
    $res = $conn->query($sql);
    $str = "";
    while ($row = $res->fetch_array()) {
        if(!empty($row['nombre'])) {
          $str .= '<tr>
          <td>'.$row['cedula'].'</td>
          <td>'.$row['nombre'].'</td>
          <td>'.$row['primerapellido'].'</td>
          <td>'.$row['segundoapellido'].'</td>
          <td class="text-center"> <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#desma"><span class="glyphicon glyphicon-remove"></span> Desmatricular</a></td>
          </tr>';
        }
    }
    $_SESSION["infoMatricula"]=$str;
    header("Location: ../cursos.php");
  }
?>
