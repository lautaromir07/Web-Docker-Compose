<?php
session_start();
require 'db_config.php';

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard/dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        // Check if user exists
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $error = "El usuario ya existe.";
        } else {
            // Insert new user
            $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            if ($stmt->execute([$username, $password])) {
                $success = "Usuario registrado con éxito. Ya puedes iniciar sesión.";
            } else {
                $error = "Error al registrar el usuario.";
            }
        }
    } else {
        $error = "Por favor, rellena todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Trading Cluster</title>
    <style>
        body { background: #0f172a; color: white; font-family: sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .login-card { background: #1e293b; padding: 2rem; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.5); width: 300px; }
        h1 { font-size: 1.5rem; margin-bottom: 1.5rem; text-align: center; color: #38bdf8; }
        input { width: 100%; padding: 10px; margin-bottom: 1rem; border-radius: 6px; border: 1px solid #334155; background: #0f172a; color: white; box-sizing: border-box; }
        button { width: 100%; padding: 10px; border-radius: 6px; border: none; background: #10b981; color: white; font-weight: bold; cursor: pointer; }
        button:hover { background: #059669; }
        .error { color: #f87171; font-size: 0.8rem; margin-bottom: 1rem; text-align: center; }
        .success { color: #34d399; font-size: 0.8rem; margin-bottom: 1rem; text-align: center; }
        .links { margin-top: 1rem; text-align: center; font-size: 0.9rem; }
        .links a { color: #38bdf8; text-decoration: none; }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>Crear Cuenta</h1>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        <?php if (isset($success)) echo "<div class='success'>$success</div>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Nuevo Usuario" required>
            <input type="password" name="password" placeholder="Nueva Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
        <div class="links">
            <a href="index.php">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </div>
</body>
</html>
