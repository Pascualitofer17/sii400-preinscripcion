<?php
// =================================================================
// Script para Insertar el Usuario Administrador (Ejecutar una sola vez)
// =================================================================

// 1. Configuración de la conexión a la base de datos
$host = 'localhost';
$dbname = 'preinscripcion';
$user = 'root'; // Cambia esto por tu usuario de base de datos
$pass = '';     // Cambia esto por tu contraseña

// 2. Datos del usuario administrador a crear
$nombreAdmin = "Administrador Principal";
$usuarioAdmin = "admin";
$passwordPlano = "admin123"; // Contraseña en texto plano
$rolAdmin = "Administrador";

// 3. Proceso de inserción
try {
    // Crear una nueva conexión PDO
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Encriptar la contraseña usando un algoritmo seguro y moderno
    $passwordHash = password_hash($passwordPlano, PASSWORD_ARGON2ID);

    // Preparar la sentencia SQL para evitar inyección SQL
    $sql = "INSERT INTO usuarios (nombre, usuario, password, rol) VALUES (:nombre, :usuario, :password, :rol)";
    $stmt = $pdo->prepare($sql);

    // Vincular los parámetros
    $stmt->bindParam(':nombre', $nombreAdmin);
    $stmt->bindParam(':usuario', $usuarioAdmin);
    $stmt->bindParam(':password', $passwordHash);
    $stmt->bindParam(':rol', $rolAdmin);

    // Ejecutar la sentencia
    $stmt->execute();

    // Mensaje de éxito
    echo "✅ ¡Usuario administrador 'admin' creado con éxito!";

} catch (PDOException $e) {
    // Manejo de errores
    if ($e->getCode() == 23000) { // Código de error para clave duplicada
        die("❌ Error: El usuario 'admin' ya existe en la base de datos.");
    } else {
        die("❌ Error al conectar o insertar en la base de datos: " . $e->getMessage());
    }
}
?>