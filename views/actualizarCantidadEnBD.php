<?php
include_once "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigoProducto = $_POST['codigo'];
    $cantidadVendida = $_POST['cantidadVendida'];
    $totalVenta = $_POST['totalVenta'];
    $fecha = $_POST['fecha'];

    // Actualizar la cantidad en la base de datos
    $sqlUpdateInventario = "UPDATE inventario SET existencia = existencia - $cantidadVendida WHERE codigo = '$codigoProducto'";
    if ($conexion->query($sqlUpdateInventario) !== TRUE) {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar la cantidad en la base de datos']);
        exit;
    }

    // Insertar los detalles de la venta en la tabla "ventas"
    $sqlInsertVenta = "INSERT INTO ventas (codigo_producto, cantidadVendida, total_vendido, fecha_venta) VALUES ('$codigoProducto', $cantidadVendida, $totalVenta, '$fecha')";
    if ($conexion->query($sqlInsertVenta) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al guardar los detalles de la venta']);
    }
}

$conexion->close();
?>

