<?php
include_once "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombreUsuario = $_POST['cliente'];
    $productos = $_POST['productos'];
    $cantidades = $_POST['cantidades'];

    // Comenzar una transacción para garantizar la consistencia de la base de datos
    $conexion->begin_transaction();

    try {
        // Insertar datos del usuario en la tabla de usuarios (por ejemplo, si tienes una tabla de usuarios)
        $stmt = $conexion->prepare("INSERT INTO clientes (nombre) VALUES (?)");
        $stmt->bind_param("s", $nombreUsuario);
        $stmt->execute();
        $stmt->close();

        // Iterar sobre los productos vendidos
        foreach ($productos as $indice => $producto) {
            $cantidad = $cantidades[$indice];

            // Realizar la venta (actualizar stock y registrar la venta)
            $stmt = $conexion->prepare("SELECT existencia FROM inventario WHERE codigo = ?");
            $stmt->bind_param("s", $producto);
            $stmt->execute();
            $stmt->bind_result($stockActual);
            $stmt->fetch();
            $stmt->close();

            if ($cantidad <= $stockActual) {
                $nuevoStock = $stockActual - $cantidad;
                $totalVendido = $cantidad;

                // Actualizar el stock en la tabla de inventario
                $stmt = $conexion->prepare("UPDATE inventario SET existencia = ? WHERE codigo = ?");
                $stmt->bind_param("is", $nuevoStock, $producto);
                $stmt->execute();
                $stmt->close();

                // Registrar la venta en la tabla de ventas
                $fecha = date('Y-m-d H:i:s'); // Obtener la fecha actual
                $stmt = $conexion->prepare("INSERT INTO ventas (codigo_producto, stock_restante, total_vendido, fecha) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("siss", $producto, $nuevoStock, $totalVendido, $fecha);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("No hay suficiente stock para el producto $producto.");
            }
        }

        // Confirmar la transacción
        $conexion->commit();

        // Cerrar la conexión a la base de datos
        $conexion->close();

        echo "Venta realizada con éxito.";

    } catch (Exception $e) {
        // Si ocurre un error, deshacer la transacción y mostrar un mensaje de error
        $conexion->rollback();
        $conexion->close();
        echo "Error en la venta: " . $e->getMessage();
    }
}
?>

?>
