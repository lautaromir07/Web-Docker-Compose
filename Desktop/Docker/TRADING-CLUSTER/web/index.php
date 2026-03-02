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

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && $password === $user['password']) { // Simple check for the demo
        $_SESSION['user_id'] = $user['id'];
        header('Location: dashboard/dashboard.php');
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Trading Cluster</title>
    <style>
        body { background: #0f172a; color: white; font-family: sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .login-card { background: #1e293b; padding: 2rem; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.5); width: 300px; }
        h1 { font-size: 1.5rem; margin-bottom: 1.5rem; text-align: center; color: #38bdf8; }
        input { width: 100%; padding: 10px; margin-bottom: 1rem; border-radius: 6px; border: 1px solid #334155; background: #0f172a; color: white; box-sizing: border-box; }
        button { width: 100%; padding: 10px; border-radius: 6px; border: none; background: #0ea5e9; color: white; font-weight: bold; cursor: pointer; }
        button:hover { background: #0284c7; }
        .error { color: #f87171; font-size: 0.8rem; margin-bottom: 1rem; text-align: center; }
        .node-info { position: absolute; bottom: 10px; right: 10px; font-size: 0.7rem; color: #64748b; }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>Trading System</h1>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
        <div style="margin-top: 1rem; text-align: center; font-size: 0.9rem;">
            <a href="register.php" style="color: #38bdf8; text-decoration: none;">¿No tienes cuenta? Regístrate</a>
        </div>
    </div>
    <div class="node-info">Host IP: <?php echo $_SERVER['SERVER_ADDR']; ?></div>
</body>
</html>
