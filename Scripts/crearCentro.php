<?php
include "conexion.php";
session_start();
if (!isset($_SESSION['user'])){
    header("Location: ../index.php");
}
    if($_POST){
        $nombre = $_POST['nombre'];
        $direccion =  $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $encargado = $_POST['encargado'];

        $call = mysqli_prepare($conn, 'CALL crearComunidad(?,?,?,?)');

      	mysqli_stmt_bind_param($call,'ssss', $nombre, $direccion,$telefono,$encargado);
      	mysqli_stmt_execute($call);

        $_SESSION["infoGeneral"] = "Centro comunitario creado satisfactoriamente.";
        header("Location: ../super.php");
    }
?>
