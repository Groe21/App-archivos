<?php
require_once __DIR__ . '/../../../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        // Verificar si el usuario o correo ya existe
        $query = "SELECT * FROM usuarios WHERE nombre_usuario = :username OR correo = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            // Insertar nuevo usuario
            $query = "INSERT INTO usuarios (nombre_usuario, correo, contraseña, fecha_creacion) VALUES (:username, :email, :password, NOW())";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            echo "Usuario registrado exitosamente. Puedes iniciar sesión ahora.";
        } else {
            echo "El nombre de usuario o correo ya está en uso.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
