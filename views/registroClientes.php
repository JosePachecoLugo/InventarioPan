<?php
include "../includes/header.php";
?>

<style>

        .container {
            max-width: 400px;
            margin: auto;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
        }

        .form-group textarea {
            width: 100%;
            padding: 10px;
            height: 100px;
        }

        .form-group button {
            padding: 10px 20px;
            background-color: #3498db;
            border: none;
            color: white;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #2980b9;
        }

        .success-message {
            display: none;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            font-weight: bold;
            text-align: center;
        }
    </style>

    <div class="container">
        <h2>Registro de Clientes</h2>
        <form onsubmit="registrarCliente(event)">
            <div class="form-group">
                <label for="cliente">Cliente:</label>
                <input type="text" id="cliente" name="cliente" placeholder="Nombre del cliente" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" placeholder="Número de teléfono" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" placeholder="Correo electrónico" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" placeholder="Dirección" required>
            </div>
            <div class="form-group">
                <button type="submit">Registrar Cliente</button>
            </div>
        </form>

        <div id="successMessage" class="success-message">
            Cliente registrado exitosamente.
        </div>
    </div>
    <script>
        function registrarCliente(event) {
            event.preventDefault();

            const cliente = document.getElementById('cliente').value;
            const telefono = document.getElementById('telefono').value;
            const correo = document.getElementById('correo').value;
            const direccion = document.getElementById('direccion').value;

            const formData = new FormData();
            formData.append('cliente', cliente);
            formData.append('telefono', telefono);
            formData.append('correo', correo);
            formData.append('direccion', direccion);

            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Mostrar el mensaje de éxito
                        const successMessage = document.getElementById('successMessage');
                        successMessage.style.display = 'block';

                        // Limpiar los campos del formulario
                document.getElementById('cliente').value = '';
                document.getElementById('telefono').value = '';
                document.getElementById('correo').value = '';
                document.getElementById('direccion').value = '';

                        // Ocultar el mensaje después de 3 segundos (3000 milisegundos)
                        setTimeout(function() {
                            successMessage.style.display = 'none';
                        }, 3000);
                    } else {
                        console.error('Error al registrar el cliente');
                    }
                }
            };

            xhr.open('POST', 'guardar_cliente.php');
            xhr.send(formData);
        }
    </script>

<?php include "../includes/footer.php";
?>