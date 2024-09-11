<?php
class CarpetaDisplay {
    private $pdo;


    public function __construct() {

        require_once __DIR__ . '/../../../config/config.php';
        
        global $pdo;
        if (!isset($pdo)) {
            throw new Exception("No se pudo conectar a la base de datos.");
        }
        $this->pdo = $pdo;
    }

    // Método para obtener todas las carpetas y generar el HTML
    public function mostrarCarpetas() {
        // Consultar todas las carpetas
        $sql = "SELECT * FROM carpetas";
        $stmt = $this->pdo->query($sql);
        $carpetas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $html = '';
    
        // Generar HTML para cada carpeta
        foreach ($carpetas as $carpeta) {
            $nombre = htmlspecialchars($carpeta['nombre']);
            $idCarpeta = intval($carpeta['id']); // Asumiendo que tienes un campo 'id' en tu base de datos
            $html .= '
            <div class="col-sm-6 col-md-4 col-lg-2 custom-lg-col d-flex justify-content-center folder-item">
                <div class="folder-container">
                    <input type="checkbox" class="folder-checkbox" data-id="' . $idCarpeta . '">
                    <a href="verCarpeta.php?id=' . $idCarpeta . '" class="folder-link">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="folder-icon">
                            <path d="M10 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V8a2 2 0 00-2-2h-8l-2-2z"/>
                        </svg>
                        <div class="folder-name">' . $nombre . '</div>
                    </a>
                </div>
            </div>
            ';
        }
        return $html;
    }    

    public function eliminarCarpeta($idCarpeta) {
        try {
            $sql = "DELETE FROM carpetas WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $idCarpeta]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
