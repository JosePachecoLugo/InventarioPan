<?php
include_once "../includes/db.php";

$sql = "TRUNCATE TABLE ventas";  // Esta consulta vaciará la tabla
if ($conexion->query($sql) === TRUE) {
    echo "Tabla 'ventas' ha sido vaciada.";
} else {
    echo "Error al vaciar la tabla: " . $conexion->error;
}

$conexion->close();
?>
