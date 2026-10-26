<?php
// conexion.php

$host     = "localhost";
$usuario  = "app_comunicaciones";
$password = "mi_clave_segura123";
$dbname   = "contactos"; // <-- Reemplaza por el nombre exacto de tu BD

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $usuario, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>