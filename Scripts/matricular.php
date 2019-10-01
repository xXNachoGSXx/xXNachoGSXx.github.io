<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
  if($_POST){
    $ced = $_SESSION["cedulaEstudiante"];
    $curso = $_POST["select-curso"];
    $id = $_SESSION["id"];

    $sql = "call estamatriculado($ced , $curso)";
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
      //header("Location: ../admin.php");


      echo "<script>
           alert('Estudiante matriculado satisfactoriamente');
           window.location.replace('../admin.php');
           </script>";
    }
    else{
      echo "<script>
           alert('Lo sentimos el estudiante ha sido matriculado previamente');
           window.location.replace('../admin.php');
           </script>";
    }

  }
?>
