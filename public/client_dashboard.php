<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../config/database.php';

$userId = $_SESSION['user_id'];

// Placeholder: Fetch routines and progress for the client
// For now, we will show static content or empty placeholders

?>

<?php include 'header.php'; ?>

<div class="container">
    <h1><i class="fas fa-tachometer-alt"></i> Dashboard Cliente</h1>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Rutinas
        </div>
        <div class="card-body">
            <p>Aquí podrás ver tus rutinas asignadas por tu entrenador.</p>
            <p><em>Funcionalidad en desarrollo.</em></p>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Progreso
        </div>
        <div class="card-body">
            <p>Aquí podrás ver tu progreso y estadísticas.</p>
            <p><em>Funcionalidad en desarrollo.</em></p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
