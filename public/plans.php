<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'trainer') {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../config/database.php';

$userId = $_SESSION['user_id'];

// Handle new plan submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $planType = $_POST['plan_type'] ?? '';

    if ($title && in_array($planType, ['exercise', 'nutrition'])) {
        $stmt = $pdo->prepare("INSERT INTO plans (trainer_id, client_id, title, description, plan_type) VALUES (?, NULL, ?, ?, ?)");
        $stmt->execute([$userId, $title, $description, $planType]);
        header('Location: plans.php?success=1');
        exit;
    } else {
        $error = "Por favor, complete todos los campos correctamente.";
    }
}

// Fetch plans created by the trainer
$stmt = $pdo->prepare("SELECT * FROM plans WHERE trainer_id = ? ORDER BY created_at DESC");
$stmt->execute([$userId]);
$plans = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Planes - FitConnect</title>
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
        textarea.form-control {
            resize: vertical;
        }
        .plan-list {
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-file-alt"></i> Planes de Ejercicio y Nutrición</h1>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success" role="alert">Plan creado correctamente.</div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="plans.php" novalidate>
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" required value="<?= htmlspecialchars($_POST['title'] ?? '') ?>" />
            </div>
            <div class="mb-3">
                <label for="plan_type" class="form-label">Tipo de Plan</label>
                <select class="form-select" id="plan_type" name="plan_type" required>
                    <option value="" disabled selected>Seleccione un tipo</option>
                    <option value="exercise" <?= (($_POST['plan_type'] ?? '') === 'exercise') ? 'selected' : '' ?>>Ejercicio</option>
                    <option value="nutrition" <?= (($_POST['plan_type'] ?? '') === 'nutrition') ? 'selected' : '' ?>>Nutrición</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="5" required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Crear Plan</button>
        </form>

        <h2>Planes creados</h2>
        <?php if (empty($plans)): ?>
            <p>No has creado planes aún.</p>
        <?php else: ?>
            <ul class="list-group plan-list">
                <?php foreach ($plans as $plan): ?>
                    <li class="list-group-item">
                        <strong><?= htmlspecialchars($plan['title']) ?></strong> (<?= htmlspecialchars($plan['plan_type']) ?>)<br />
                        <?= nl2br(htmlspecialchars($plan['description'])) ?><br />
                        <small class="text-muted">Creado el <?= date('d/m/Y H:i', strtotime($plan['created_at'])) ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>
