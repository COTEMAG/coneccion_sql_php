/*
En esta lección, conectaremos un formulario de registro HTML a una base de datos MySQL usando PHP. Este es un ejemplo común para crear un formulario de registro de usuario en un sitio web.

Requisitos
PHP (instalado en tu servidor o local con XAMPP, WAMP, o MAMP).
MySQL (puedes usar phpMyAdmin para crear y administrar la base de datos).
Un editor de código (VS Code, Sublime Text, etc.).
*/

/*
Estructura del proyecto
Vamos a crear un proyecto con la siguiente estructura:

/mi_proyecto/
├── index.php
├── register.php
└── database.php
*/

/*
Crear la base de datos
Primero, crearemos la base de datos y la tabla de usuarios.

Script SQL para la base de datos
*/

CREATE DATABASE mi_base_datos;

USE mi_base_datos;

CREATE TABLE usuarios (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

/*
Crear el formulario HTML (index.html)
Creamos un formulario de registro con campos para el nombre, email y contraseña.
*/

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form action="register.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Registrarse</button>
    </form>
</body>
</html>

/*
Crear el archivo de conexión a la base de datos (database.php)
Este archivo se encargará de conectar PHP con MySQL.
*/

<?php
// database.php

$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "mi_base_datos";

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>

/*
Crear el archivo para procesar el registro (register.php)
Este archivo recibirá los datos del formulario, los validará y los insertará en la base de datos.
*/

<?php
// Incluir la conexión a la base de datos
require 'database.php';

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validar que no estén vacíos
if (empty($nombre) || empty($email) || empty($password)) {
    die("Por favor, completa todos los campos.");
}

// Crear la consulta SQL
$sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso. ¡Bienvenido, $nombre!";
} else {
    echo "Error al registrar el usuario: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
