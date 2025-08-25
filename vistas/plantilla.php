<?php
// Siempre iniciar la sesión primero.
session_start();

// =================================================================
// BLOQUE DE LÓGICA DE ACCIONES (ANTES DE CUALQUIER HTML)
// =================================================================
// Este bloque se encarga de acciones que no dibujan HTML, como cerrar sesión.
if (isset($_GET["ruta"]) && $_GET["ruta"] == "salir") {
    // Si la ruta es "salir", incluye el módulo que destruye la sesión y termina el script.
    include "modulos/salir.php";
}

// =================================================================
// A PARTIR DE AQUÍ COMIENZA A DIBUJARSE LA PÁGINA
// =================================================================
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Preinscripción</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
        body { background-color: #f8f9fa; }
        .wrapper { display: flex; width: 100%; align-items: stretch; }
        #sidebar-wrapper { min-height: 100vh; width: 250px; margin-left: -250px; transition: margin .25s ease-out; background-color: #343a40; }
        #sidebar-wrapper.toggled { margin-left: 0; }
        #page-content-wrapper { flex: 1; min-width: 0; }
        @media (min-width: 768px) {
            #sidebar-wrapper { margin-left: 0; }
            #page-content-wrapper { min-width: 0; width: 100%; }
            #sidebar-wrapper.toggled { margin-left: -250px; }
        }
    </style>
</head>
<body>

<?php
// Ahora, decidimos qué estructura de página mostrar
if (isset($_SESSION["sesion_iniciada"]) && $_SESSION["sesion_iniciada"] == "ok") {
    
    // Si el usuario está logueado, dibuja la estructura principal del panel
    echo '<div class="d-flex" id="wrapper">';
    
    include "modulos/menu.php";
    
    echo '<div id="page-content-wrapper">';
    include "modulos/encabezado.php";

    // Enrutador de contenido para usuarios logueados
    if (isset($_GET["ruta"])) {
        $rutasPermitidas = ["inicio", "usuarios", "carreras", "estudiantes", "preinscripcion"];
        if (in_array($_GET["ruta"], $rutasPermitidas)) {
            include "modulos/" . $_GET["ruta"] . ".php";
        } else {
            include "modulos/error404.php";
        }
    } else {
        include "modulos/inicio.php";
    }
    
    include "modulos/piedepagina.php";
    echo '</div>'; // Cierre de page-content-wrapper
    echo '</div>'; // Cierre de wrapper
    
} else {
    // Si el usuario no está logueado, muestra el login
    include "modulos/sesion.php";
    $controlador = new ControladorUsuarios();
    $controlador->ctrIngresoUsuario();
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $("#sidebarToggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
</body>
</html>