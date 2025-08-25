<?php
// CONTROLADOR FRONTAL

// 1. Requerir los controladores
require_once "controladores/controlador-plantilla.php";
require_once "controladores/controlador-usuarios.php";

// 2. Requerir los modelos
require_once "modelos/modelo-usuarios.php";

// 3. Arrancar la aplicación
$plantilla = new ControladorPlantilla();
$plantilla->ctrTraerPlantilla();