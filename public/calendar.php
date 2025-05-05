<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../config/database.php';

$userId = $_SESSION['user_id'];
$userRole = $_SESSION['user_role'];

// Handle new session scheduling
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $userRole === 'trainer') {
    $clientId = $_POST['client_id'] ?? null;
    $sessionDate = $_POST['session_date'] ?? null;
    $notes = trim($_POST['notes'] ?? '');

    if ($clientId && $sessionDate) {
        $stmt = $pdo->prepare("INSERT INTO sessions (trainer_id, client_id, session_date, notes) VALUES (?, ?, ?, ?)");
        $stmt->execute([$userId, $clientId, $sessionDate, $notes]);
        header('Location: calendar.php?success=1');
        exit;
    }
}

// Fetch sessions for the user
if ($userRole === 'trainer') {
    $stmt = $pdo->prepare("SELECT s.*, u.username AS client_name FROM sessions s JOIN users u ON s.client_id = u.id WHERE s.trainer_id = ? ORDER BY s.session_date ASC");
    $stmt->execute([$userId]);
    $sessions = $stmt->fetchAll();
    // Fetch clients for scheduling
    $stmtClients = $pdo->prepare("SELECT id, username FROM users WHERE role = 'client'");
    $stmtClients->execute();
    $clients = $stmtClients->fetchAll();
} else {
    // client view
    $stmt = $pdo->prepare("SELECT s.*, u.username AS trainer_name FROM sessions s JOIN users u ON s.trainer_id = u.id WHERE s.client_id = ? ORDER BY s.session_date ASC");
    $stmt->execute([$userId]);
    $sessions = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Calendario - FitConnect</title>
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
        .container {
            max-width: 800px;
            margin: 3rem auto;
        }
        .session-list {
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-calendar-alt"></i> Calendario</h1>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success" role="alert">Sesión programada correctamente.</div>
        <?php endif; ?>

        <?php if ($userRole === 'trainer'): ?>
            <form method="POST" action="calendar.php" class="mb-4">
                <div class="mb-3">
                    <label for="client_id" class="form-label">Cliente</label>
                    <select class="form-select" id="client_id" name="client_id" required>
                        <option value="" disabled selected>Seleccione un cliente</option>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?= htmlspecialchars($client['id']) ?>"><?= htmlspecialchars($client['username']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="session_date" class="form-label">Fecha y hora</label>
                    <input type="datetime-local" class="form-control" id="session_date" name="session_date" required />
                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label">Notas</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Notas adicionales"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Programar Sesión</button>
            </form>
        <?php endif; ?>

        <h2>Sesiones próximas</h2>
        <?php if (empty($sessions)): ?>
            <p>No hay sesiones programadas.</p>
        <?php else: ?>
            <ul class="list-group session-list">
                <?php foreach ($sessions as $session): ?>
                    <li class="list-group-item">
                        <?php if ($userRole === 'trainer'): ?>
                            Cliente: <?= htmlspecialchars($session['client_name']) ?><br />
                        <?php else: ?>
                            Entrenador: <?= htmlspecialchars($session['trainer_name']) ?><br />
                        <?php endif; ?>
                        Fecha y hora: <?= date('d/m/Y H:i', strtotime($session['session_date'])) ?><br />
                        Notas: <?= nl2br(htmlspecialchars($session['notes'])) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>
