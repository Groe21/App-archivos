<?php
class CarpetaView {
    private $pdo;

    public function __construct() {
        require_once __DIR__ . '/../../../config/config.php';
        
        global $pdo;
        if (!isset($pdo)) {
            throw new Exception("No se pudo conectar a la base de datos.");
        }
        $this->pdo = $pdo;
    }

    // Método para obtener los detalles de una carpeta
    public function obtenerDetallesCarpeta($idCarpeta) {
        $sql = "SELECT * FROM carpetas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $idCarpeta]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para generar el HTML para mostrar el contenido de la carpeta
    public function mostrarContenidoCarpeta($idCarpeta) {
        $carpeta = $this->obtenerDetallesCarpeta($idCarpeta);

        if (!$carpeta) {
            return "<p>Carpeta no encontrada.</p>";
        }

        $nombre = htmlspecialchars($carpeta['nombre']);
        $html = "<h2>$nombre</h2>";

        // Obtener subcarpetas usando la vista
        $sql = "SELECT * FROM vista_subcarpetas WHERE id_carpeta_padre = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $idCarpeta]);
        $subcarpetas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($subcarpetas)) {
            $html .= '
            <div class="alert text-center" role="alert">
                <strong>¡Carpeta vacía!</strong> Empiece a guardar <em>documentos, fotos, importantes</em>.
            </div>
            ';
        } else {
            $html .= '<div class="row gx-2 gy-3">';
            foreach ($subcarpetas as $subcarpeta) {
                $nombreSubcarpeta = htmlspecialchars($subcarpeta['nombre_carpeta']);
                $idSubcarpeta = intval($subcarpeta['id_carpeta']);
                $html .= '
                <div class="col-sm-6 col-md-4 col-lg-2 custom-lg-col d-flex justify-content-center folder-item">
                    <div class="folder-container">
                        <input type="checkbox" class="folder-checkbox" data-id="' . $idSubcarpeta . '">
                        <a href="verCarpeta.php?id=' . $idSubcarpeta . '" class="folder-link">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="folder-icon">
                                <path d="M10 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V8a2 2 0 00-2-2h-8l-2-2z"/>
                            </svg>
                            <div class="folder-name">' . $nombreSubcarpeta . '</div>
                        </a>
                    </div>
                </div>
                ';
            }
            $html .= '</div>';
        }

        // Mostrar archivos dentro de la carpeta
        $sql = "SELECT * FROM documentos WHERE id_carpeta = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $idCarpeta]);
        $archivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($archivos)) {
            $html .= '<ul>';
            foreach ($archivos as $archivo) {
                $nombreArchivo = htmlspecialchars($archivo['nombre']);
                $html .= '<li>' . $nombreArchivo . '</li>';
            }
            $html .= '</ul>';
        }

        return $html;
    }
}