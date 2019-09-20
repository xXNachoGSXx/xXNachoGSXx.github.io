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

        //Aqui hay que ver como devolverse a la pantalla anterior limpiando todo pero
        //aun con el mismo usuario, esta en duro ahorita
        echo "<script>
             alert('Centro creado satisfactoriamente');
             window.location.replace('../super.php');
             </script>";
    }
?>
