<div class="container-fluid px-4">
    <h1 class="mt-4">Administrar Usuarios</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-users me-1"></i>
            Lista de Usuarios
            <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario">
                <i class="fas fa-plus me-1"></i>
                Agregar Usuario
            </button>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 10px;">#</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Foto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Llamamos al controlador para obtener la lista de usuarios.
                    $usuarios = ControladorUsuarios::ctrMostrarTodosLosUsuarios();

                    // Iteramos sobre cada usuario para mostrarlo en una fila de la tabla.
                    foreach ($usuarios as $key => $usuario) {
                        echo '<tr>';
                        echo '  <td>' . ($key + 1) . '</td>';
                        echo '  <td>' . htmlspecialchars($usuario["nombre"]) . '</td>';
                        echo '  <td>' . htmlspecialchars($usuario["usuario"]) . '</td>';
                        echo '  <td>' . htmlspecialchars($usuario["rol"]) . '</td>';
                        
                        // Mostramos la imagen si existe, si no, una por defecto.
                        if ($usuario["foto"] != "") {
                            echo '  <td><img src="' . htmlspecialchars($usuario["foto"]) . '" class="img-thumbnail" width="40px"></td>';
                        } else {
                            echo '  <td><img src="vistas/img/usuarios/default.png" class="img-thumbnail" width="40px"></td>';
                        }
                        
                        // Botones de acciones (Editar y Eliminar).
                        echo '  <td>
                                    <div class="btn-group">
                                        <button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>