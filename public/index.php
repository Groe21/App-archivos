<?php

// Incluir la clase CarpetaDisplay
require_once __DIR__ . '/../src/views/carpetas/mostrarCarpetas.php';
require_once __DIR__ . '/../src/views/carpetas/eliminarCarpeta.php';

// Crear una instancia de la clase CarpetaDisplay
$carpetaDisplay = new CarpetaDisplay($pdo);

// Obtener el HTML para mostrar las carpetas
$htmlCarpetas = $carpetaDisplay->mostrarCarpetas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <link rel="stylesheet" href="assets\css\principal.css">
    <link rel="stylesheet" href="assets\css\boton.css">
    <link rel="stylesheet" href="assets\css\carpetas.css">
    <link rel="stylesheet" href="assets\css\menuBotones.css">
    <link rel="icon" href="assets/img/Logotipo.ico" type="image/png">
</head>
<body>

    <?php
    require_once __DIR__. '/../src/views/includes/header.php';
    require_once __DIR__. '/../src/views/includes/menuLateral.php';
    ?>

    <!-- Contenido donde se mostrarán las carpetas-->
    <section id="content" class="container my-5">
        <div class="row gx-2 gy-3">
            <?php echo $htmlCarpetas; ?>
        </div>
    </section>

    <!-- Pie de página con derechos reservados -->
    <footer class="text-center text-info py-3">
        &copy; 2024 Emilio Guerrero-21 Todos los derechos reservados.
    </footer>

    <!-- Modal para crear una nueva carpeta -->
    <div class="modal fade" id="crearCarpetaModal" tabindex="-1" aria-labelledby="crearCarpetaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearCarpetaModalLabel">Crear Nueva Carpeta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formCrearCarpeta" method="POST" action="\app_archivos\src\views\carpetas\crearCarpeta.php">
                        <div class="mb-3">
                            <label for="nombreCarpeta" class="form-label">Nombre de la Carpeta</label>
                            <input type="text" class="form-control" id="nombreCarpeta" name="nombreCarpeta" required>
                            <input type="hidden" id="idCarpetaPadre" name="id_carpeta_padre">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" form="formCrearCarpeta" class="btn btn-warning">Crear Carpeta</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación de eliminación de una carpeta-->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-danger text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta carpeta? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-light" id="confirmDelete">Eliminar Carpeta</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de éxito de eliminación -->
    <div class="modal fade" id="deleteSuccessModal" tabindex="-1" aria-labelledby="deleteSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-success text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSuccessModalLabel">Éxito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    La carpeta se ha eliminado correctamente.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Éxito de creación de una carpeta -->
    <div class="modal fade" id="exitoModal" tabindex="-1" aria-labelledby="exitoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-success text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="exitoModalLabel">¡Éxito!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    La carpeta se ha creado exitosamente.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets\js\esconderMenu.js">
        
    </script>
    <script src="assets\js\eliminarCarpeta.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Verificar si hay una variable de sesión establecida en el backend
            <?php if (isset($_SESSION['carpeta_creada']) && $_SESSION['carpeta_creada'] === true): ?>
                var myModal = new bootstrap.Modal(document.getElementById('exitoModal'));
                myModal.show();
                
                // Limpiar la variable de sesión para que no se muestre en la próxima carga
                <?php unset($_SESSION['carpeta_creada']); ?>
                
                // Añadir un evento al botón de cerrar para redirigir después de cerrar el modal
                document.querySelector('#exitoModal .btn-close').addEventListener('click', function() {
                    window.location.href = window.location.pathname;
                });
            <?php endif; ?>
        });
    </script>

</body>
</html>