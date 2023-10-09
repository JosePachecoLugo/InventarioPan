<?php
include_once "../includes/db.php";

$sql = "SELECT * FROM ventas";
$result = $conexion->query($sql);

$ventas = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $ventas[] = $row;
    }
}

$conexion->close();

header('Content-Type: application/json');
echo json_encode($ventas);
?>
