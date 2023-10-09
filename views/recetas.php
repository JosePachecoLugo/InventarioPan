<?php
include_once "../includes/header.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Recetas de Panes</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Recetas de Panes</h1>

    <a href="add_recipe.php">Agregar Receta</a>

    <div class="recipes">
        <?php
        // Conexión a la base de datos
        include_once "../includes/db.php";  // Archivo para la conexión a la base de datos

        $sql = "SELECT * FROM recetas";
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="recipe">';
                echo '<img src="' . $row['imagen_url'] . '" alt="Imagen de la receta">';
                echo '<h2>' . $row['nombre'] . '</h2>';
                echo '<p><strong>Ingredientes:</strong> ' . $row['ingredientes'] . '</p>';
                echo '<p><strong>Instrucciones:</strong> ' . $row['instrucciones'] . '</p>';
                echo '</div>';
            }
        } else {
            echo 'No hay recetas disponibles.';
        }

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
<?php include "../includes/footer.php"; ?>