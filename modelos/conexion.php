<?php
class Conexion {
    public static function conectar() {
        $host = 'localhost';
        $dbname = 'preinscripcion';
        $user = 'root';
        $pass = '';

        try {
            $link = new PDO("mysql:host=" . $host . ";dbname=" . $dbname . ";charset=utf8", $user, $pass);
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $link;
        } catch (PDOException $e) {
            die("❌ Error al conectar a la base de datos: " . $e->getMessage());
        }
    }
}