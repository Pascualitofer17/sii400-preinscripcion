<?php
require_once "conexion.php";

class ModeloUsuarios {
    public static function mdlMostrarUsuarios($tabla, $item, $valor) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch();
        $stmt = null;
        return $resultado;
    }
    /**
     * Muestra TODOS los usuarios de la base de datos.
     * @param string $tabla El nombre de la tabla.
     * @return array Retorna un array con los datos de todos los usuarios.
     */
    public static function mdlMostrarTodosLosUsuarios($tabla) {
        
        // Preparamos la consulta para seleccionar todos los registros.
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        
        // Ejecutamos la consulta.
        $stmt->execute();
        
        // fetchAll() devuelve todas las filas del resultado.
        $resultado = $stmt->fetchAll();
        
        // Cerramos la conexión.
        $stmt = null;
        
        return $resultado;
    }
}