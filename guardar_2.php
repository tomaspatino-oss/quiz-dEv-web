<?php
// guardar_2.php

// 1. Requerimos la misma conexión
require_once 'conexion.php';

// 2. Verificamos que los datos se hayan enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recibimos los datos del segundo formulario
    $nombre   = trim($_POST['nombre'] ?? '');
    $correo   = trim($_POST['correo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $mensaje  = trim($_POST['mensaje'] ?? '');

    // Validamos campos obligatorios
    if (!empty($nombre) && !empty($correo) && !empty($mensaje)) {

        try {
            // Preparamos la consulta SQL
            // Cambia 'tabla_trabajo' por el nombre real de tu segunda tabla en phpMyAdmin
            $sql = "INSERT INTO tabla_trabajo (nombre, correo, telefono, mensaje) VALUES (:nombre, :correo, :telefono, :mensaje)";
            
            $stmt = $conexion->prepare($sql);

            // Vinculamos los parámetros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':mensaje', $mensaje);

            // Ejecutamos la consulta
            if ($stmt->execute()) {
                echo "<script>
                        alert('¡Tu mensaje y solicitud han sido enviadas correctamente!');
                        window.location.href = 'index.html';
                      </script>";
            } else {
                echo "Hubo un error al registrar tu mensaje.";
            }

        } catch (PDOException $e) {
            echo "Error en la base de datos: " . $e->getMessage();
        }

    } else {
        echo "Por favor completa los campos obligatorios.";
    }

} else {
    header("Location: index.html");
    exit();
}
