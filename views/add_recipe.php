<?php
include_once "../includes/header.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Agregar Receta</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Agregar Receta</h1>

    <form action="save_recipe.php" method="post">
        <label for="nombre">Nombre de la Receta:</label>
        <input type="text" name="nombre" required><br>

        <label for="ingredientes">Ingredientes:</label>
        <textarea name="ingredientes" required></textarea><br>

        <label for="instrucciones">Instrucciones:</label>
        <textarea name="instrucciones" required></textarea><br>

        <label for="imagen_url">URL de la Imagen:</label>
        <input type="url" name="imagen_url" required><br>

        <input type="submit" value="Agregar Receta">
    </form>
</body>
</html>
<?php include "../includes/footer.php"; ?>