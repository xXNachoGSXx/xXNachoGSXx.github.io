<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
  if($_POST){
    $ced = $_POST["select-estudiante"];
    $curso = $_POST["select-curso"];
    $id = $_SESSION["id"];
    $sql = "call estamatriculado('$ced' , $curso)";
    $res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));
    $row = mysqli_fetch_assoc($res);
    if ($row['cant'] == 0){
      $res->close();
      $conn->next_result();
      $call = mysqli_prepare($conn, 'CALL matricular(?,?,?)');

      mysqli_stmt_bind_param($call,'ssi', $ced, $curso,$id);
      mysqli_stmt_execute($call);

      $iduser = $_SESSION['id'];
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
            <td class="text-center"> <a id="'.$row['matri'].'" onClick="reply_click(this.id)" href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#desma"><span class="glyphicon glyphicon-remove"></span> Desmatricular</a></td>
            </tr>';
          }
      }
      $_SESSION["historialmatricula"]=$str;
      unset($_SESSION["nombreEstudiante"]);
      $_SESSION["infoGeneral"] = "Estudiante matriculado satisfactoriamente.";
      header("Location: ../admin.php");
    }
    else{
      unset($_SESSION["nombreEstudiante"]);
      $_SESSION["infoGeneral"] = "Lo sentimos el estudiante ya está matriculado en este curso.";
      header("Location: ../admin.php");
    }

  }
?>
