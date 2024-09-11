<?php
require_once __DIR__ . '/../../../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Preparar la consulta para obtener el usuario
        $query = "SELECT * FROM usuarios WHERE nombre_usuario = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Verificar si el usuario existe
        if ($stmt->rowCount() == 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar la contraseña
            if (password_verify($password, $usuario['contraseña'])) {
                // Iniciar sesión y redirigir al index.php
                session_start();
                $_SESSION['usuario'] = $usuario['nombre_usuario'];
                header("Location: \app_archivos\public\index.php");
                exit();
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Método de solicitud no válido.";
}

session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Si se desea destruir la sesión completamente, también se puede eliminar la cookie de sesión.
// Nota: Esto destruirá la sesión y no la información de la sesión.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión.
session_destroy();

// Redirigir al inicio de sesión
header("Location: /app_archivos/src/views/usuarios/login.php");
exit();

?>
