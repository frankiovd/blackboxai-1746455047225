<?php
session_start();

$userRole = $_SESSION['user_role'] ?? null;
$userEmail = $_SESSION['user_email'] ?? null;

?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #212529;">
  <div class="container">
    <a class="navbar-brand" href="public/index.php" style="color: #1A73E8; font-family: 'Montserrat', sans-serif;">FitConnect</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Inicio</a>
        </li>
        <?php if ($userEmail): ?>
          <?php if ($userRole === 'trainer'): ?>
            <li class="nav-item">
              <a class="nav-link" href="trainer_profile.php">Perfil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="plans.php">Planes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="calendar.php">Calendario</a>
            </li>
          <?php elseif ($userRole === 'client'): ?>
            <li class="nav-item">
              <a class="nav-link" href="client_dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="calendar.php">Calendario</a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="messages.php">Mensajes</a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link" href="testimonials.php">Testimonios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="bmi_calculator.php">Calculadora IMC</a>
        </li>
      </ul>
      <?php if ($userEmail): ?>
      <span class="navbar-text me-3" style="color: #FFFFFF;">
        <?= htmlspecialchars($userEmail) ?>
      </span>
      <a href="logout.php" class="btn btn-outline-light">Cerrar sesión</a>
      <?php else: ?>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="login.php">Iniciar sesión</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Registrarse</a>
        </li>
      </ul>
      <?php endif; ?>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
