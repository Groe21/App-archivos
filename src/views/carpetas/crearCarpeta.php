<?php
session_start();

require_once __DIR__ . '/../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreCarpeta = $_POST['nombreCarpeta'] ?? '';

    if (!empty($nombreCarpeta)) {
        try {
            $idCarpetaPadre = $_POST['id_carpeta_padre'] ?? null;
            $idUsuario = 1;

            $sql = "INSERT INTO carpetas (nombre, id_usuario" . ($idCarpetaPadre ? ", id_carpeta_padre" : "") . ") VALUES (:nombre, :id_usuario" . ($idCarpetaPadre ? ", :id_carpeta_padre" : "") . ")";
            $stmt = $pdo->prepare($sql);

            $params = [
                ':nombre' => $nombreCarpeta,
                ':id_usuario' => $idUsuario
            ];

            if ($idCarpetaPadre) {
                $params[':id_carpeta_padre'] = intval($idCarpetaPadre);
            }

            $stmt->execute($params);

            $_SESSION['carpeta_creada'] = true;
            $redirectUrl = $idCarpetaPadre ? '/app_archivos/public/verCarpeta.php?id=' . $idCarpetaPadre : '/app_archivos/public/index.php';
            header('Location: ' . $redirectUrl);
            exit;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'El nombre de la carpeta es requerido.';
    }
} else {
    echo 'Método de solicitud no válido.';
}
?>