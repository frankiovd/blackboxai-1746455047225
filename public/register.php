<?php
session_start();
require_once __DIR__ . '/../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    // Basic validation
    if (empty($username) || empty($email) || empty($password) || !in_array($role, ['trainer', 'client'])) {
        $error = "Please fill in all fields correctly.";
    } else {
        $userModel = new User($pdo);
        // Check if email already exists
        if ($userModel->findByEmail($email)) {
            $error = "Email is already registered.";
        } else {
            if ($userModel->register($username, $email, $password, $role)) {
                $_SESSION['user_email'] = $email;
                $_SESSION['user_role'] = $role;
                header('Location: dashboard.php');
                exit;
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registro - FitConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Open+Sans&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #FFFFFF;
            color: #212529;
        }
        h1 {
            font-family: 'Montserrat', sans-serif;
            color: #1A73E8;
            margin-bottom: 1rem;
        }
        .btn-primary {
            background-color: #1A73E8;
            border-color: #1A73E8;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #FF6B35;
            border-color: #FF6B35;
        }
        .form-container {
            max-width: 400px;
            margin: 3rem auto;
            padding: 2rem;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(26, 115, 232, 0.1);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1><i class="fas fa-dumbbell"></i> Registro FitConnect</h1>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="register.php" novalidate>
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" id="username" name="username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Tipo de usuario</label>
                <select class="form-select" name="role" required>
                    <option value="" disabled selected>Seleccione un rol</option>
                    <option value="trainer" <?= (($_POST['role'] ?? '') === 'trainer') ? 'selected' : '' ?>>Entrenador</option>
                    <option value="client" <?= (($_POST['role'] ?? '') === 'client') ? 'selected' : '' ?>>Cliente</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
            <p class="mt-3 text-center">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
        </form>
    </div>
</body>
</html>
