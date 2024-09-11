<?php
require_once __DIR__ . '/../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los IDs de las carpetas a eliminar desde el JSON enviado
    $data = json_decode(file_get_contents('php://input'), true);
    $ids = $data['ids'] ?? [];

    if (!empty($ids)) {
        try {
            $sql = "DELETE FROM carpetas WHERE id IN (" . implode(',', array_fill(0, count($ids), '?')) . ")";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($ids);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No se proporcionaron IDs de carpetas.']);
    }
}
