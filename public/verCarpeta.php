<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/views/carpetas/verCarpeta.php';
require_once __DIR__ . '/../src/views/carpetas/mostrarCarpetas.php';
require_once __DIR__ . '/../src/views/carpetas/eliminarCarpeta.php';

$idCarpeta = isset($_GET['id']) ? intval($_GET['id']) : 0;

$carpetaView = new CarpetaView();
$contenidoCarpeta = $carpetaView->mostrarContenidoCarpeta($idCarpeta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Carpeta</title>
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

    <!-- Contenido -->
    <section id="content" class="container my-5">
        <?php echo $contenidoCarpeta; ?>
    </section>  

    <!-- Pie de página -->
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" form="formCrearCarpeta" class="btn btn-warning">Crear Carpeta</button>
                    </div>
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

    <!-- Modal para subir un archivo -->
<div class="modal fade" id="subirArchivoModal" tabindex="-1" aria-labelledby="subirArchivoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-info">
            <div class="modal-header">
                <h5 class="modal-title" id="subirArchivoModalLabel">Subir Archivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSubirArchivo" method="POST" action="ruta_a_tu_script_de_subida.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombreArchivo" class="form-label">Nombre del Archivo</label>
                        <input type="text" class="form-control" id="nombreArchivo" name="nombreArchivo" required>
                    </div>
                    <div class="mb-3">
                        <label for="archivo" class="form-label">Seleccionar Archivo</label>
                        <input type="file" class="form-control" id="archivo" name="archivo" required>
                    </div>
                    <input type="hidden" id="idCarpeta" name="idCarpeta" value="id_de_la_carpeta_actual">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="formSubirArchivo" class="btn btn-warning">Subir Archivo</button>
            </div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets\js\esconderMenu.js"></script>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var idCarpetaActual = <?php echo isset($idCarpeta) ? $idCarpeta : 'null'; ?>;

        var modalCrearCarpeta = document.getElementById('crearCarpetaModal');
        modalCrearCarpeta.addEventListener('show.bs.modal', function () {
            var inputIdCarpetaPadre = document.getElementById('idCarpetaPadre');
            if (idCarpetaActual) {
                inputIdCarpetaPadre.value = idCarpetaActual;
            } else {
                inputIdCarpetaPadre.value = '';
            }
        });
    });
    </script>

</body>
</html>