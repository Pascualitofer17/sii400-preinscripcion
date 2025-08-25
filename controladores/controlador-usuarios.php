<?php
class ControladorUsuarios {
    public function ctrIngresoUsuario() {
        if (isset($_POST["ingUsuario"])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"])) {
                $tabla = "usuarios";
                $item = "usuario";
                $valor = $_POST["ingUsuario"];
                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                if ($respuesta && password_verify($_POST["ingPassword"], $respuesta["password"])) {
                    $_SESSION["sesion_iniciada"] = "ok";
                    $_SESSION["id"] = $respuesta["id"];
                    $_SESSION["nombre"] = $respuesta["nombre"];
                    $_SESSION["usuario"] = $respuesta["usuario"];
                    $_SESSION["rol"] = $respuesta["rol"];

                    echo '<script> window.location = "inicio"; </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                            icon: "error", title: "Error al ingresar",
                            text: "Por favor vuelve a intentarlo.", confirmButtonText: "Cerrar"
                        });
                    </script>';
                }
            }
        }
    }
    /**
     * Llama al modelo para obtener la lista de todos los usuarios.
     * @return array La lista de usuarios.
     */
    public static function ctrMostrarTodosLosUsuarios() {
        
        $tabla = "usuarios";
        
        // Llamamos al nuevo método del modelo.
        $respuesta = ModeloUsuarios::mdlMostrarTodosLosUsuarios($tabla);
        
        // Devolvemos la respuesta para que la vista la pueda usar.
        return $respuesta;
    }
}