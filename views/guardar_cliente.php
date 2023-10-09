<?php
include_once "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente = $_POST['cliente'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];

    // La columna 'fecha' se llenará automáticamente con la fecha actual
    
    $sql = "INSERT INTO clientes (cliente, telefono, correo, direccion) 
            VALUES ('$cliente', '$telefono', '$correo', '$direccion')";

    if ($conexion->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar el cliente: ' . $conexion->error]);
    }
}

$conexion->close();
?>
