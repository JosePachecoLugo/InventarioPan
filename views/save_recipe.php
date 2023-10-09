<?php
// Conexión a la base de datos
include_once "../includes/db.php";

// Procesar los datos del formulario
$nombre = $_POST['nombre'];
$ingredientes = $_POST['ingredientes'];
$instrucciones = $_POST['instrucciones'];
$imagen_url = $_POST['imagen_url'];

// Insertar la receta en la base de datos con la URL de la imagen
$sql = "INSERT INTO recetas (nombre, ingredientes, instrucciones, imagen_url) VALUES ('$nombre', '$ingredientes', '$instrucciones', '$imagen_url')";

if (mysqli_query($conexion, $sql)) {
    header("Location: recetas.php"); // Redirige de nuevo a la página principal
} else {
    echo "Error al agregar la receta: " . mysqli_error($conexion);
}

mysqli_close($conexion);

?>
