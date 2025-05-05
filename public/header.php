<?php
session_start();
$userRole = $_SESSION['user_role'] ?? null;
$userEmail = $_SESSION['user_email'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitConnect - Tu plataforma de fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #212529;">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fas fa-dumbbell me-2"></i>FitConnect</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                <?php if ($userEmail): ?>
                    <?php if ($userRole === 'trainer'): ?>
                        <li class="nav-item"><a class="nav-link" href="trainer_profile.php">Perfil</a></li>
                        <li class="nav-item"><a class="nav-link" href="plans.php">Planes</a></li>
                        <li class="nav-item"><a class="nav-link" href="calendar.php">Calendario</a></li>
                    <?php elseif ($userRole === 'client'): ?>
                        <li class="nav-item"><a class="nav-link" href="client_dashboard.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="calendar.php">Calendario</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="messages.php">Mensajes</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="testimonials.php">Testimonios</a></li>
                <li class="nav-item"><a class="nav-link" href="bmi_calculator.php">Calculadora IMC</a></li>
            </ul>
            <?php if ($userEmail): ?>
                <span class="navbar-text me-3"><i class="fas fa-user me-2"></i><?= htmlspecialchars($userEmail) ?></span>
                <a href="logout.php" class="btn btn-outline-light"><i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión</a>
            <?php else: ?>
                <div class="navbar-nav">
                    <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión</a>
                    <a class="nav-link" href="register.php"><i class="fas fa-user-plus me-2"></i>Registrarse</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>
