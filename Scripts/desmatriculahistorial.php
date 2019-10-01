

<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
unset($_SESSION["historialmatricula"]);
$curso = $_SESSION["idCur"];
$iduser = $_SESSION['id'];
if($_POST){
  $idmat = $_POST['botonSi'];
  $sql = "call desmatricularsimple($idmat)";
  $res = $conn->query($sql) or die ('Unable to execute query. '. mysqli_error($conn));


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
  echo "<script>
       alert('Estudiante desmatriculado satisfactoriamente');
       window.location.replace('../admin.php');
       </script>";
}
?>
