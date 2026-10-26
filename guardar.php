<?php
// guardar.php

// 1. Requerimos la conexión
require_once 'conexion.php';

// 2. Verificamos que los datos se hayan enviado por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recibimos los datos del formulario HTML
    $nombre   = trim($_POST['nombre'] ?? '');
    $correo   = trim($_POST['correo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');

    // Validamos que los campos obligatorios no estén vacíos
    if (!empty($nombre) && !empty($correo)) {

        try {
            // Preparamos la consulta SQL
            // Cambia 'tabla_clientes' por el nombre real de tu primera tabla en phpMyAdmin
            $sql = "INSERT INTO tabla_clientes (nombre, correo, telefono) VALUES (:nombre, :correo, :telefono)";
            
            $stmt = $conexion->prepare($sql);

            // Vinculamos los parámetros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);

            // Ejecutamos la consulta
            if ($stmt->execute()) {
                // Redireccionamos a la página principal con un aviso de éxito
                echo "<script>
                        alert('¡Datos guardados con éxito!');
                        window.location.href = 'index.html';
                      </script>";
            } else {
                echo "Hubo un error al guardar los datos.";
            }

        } catch (PDOException $e) {
            echo "Error en la base de datos: " . $e->getMessage();
        }

    } else {
        echo "Por favor completa todos los campos requeridos.";
    }

} else {
    // Si intentan entrar directamente a guardar.php sin enviar el formulario
    header("Location: index.html");
    exit();
}
