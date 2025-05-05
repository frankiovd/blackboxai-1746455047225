<?php
session_start();
require_once __DIR__ . '/../models/User.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'trainer') {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../config/database.php';

$userId = $_SESSION['user_id'];

// Fetch existing profile data
$stmt = $pdo->prepare("SELECT * FROM profiles WHERE user_id = ?");
$stmt->execute([$userId]);
$profile = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $specialties = trim($_POST['specialties'] ?? '');
    $availability = trim($_POST['availability'] ?? '');
    $bio = trim($_POST['bio'] ?? '');

    if ($profile) {
        // Update existing profile
        $stmt = $pdo->prepare("UPDATE profiles SET specialties = ?, availability = ?, bio = ? WHERE user_id = ?");
        $stmt->execute([$specialties, $availability, $bio, $userId]);
    } else {
        // Insert new profile
        $stmt = $pdo->prepare("INSERT INTO profiles (user_id, specialties, availability, bio) VALUES (?, ?, ?, ?)");
        $stmt->execute([$userId, $specialties, $availability, $bio]);
    }
    header('Location: trainer_profile.php?success=1');
    exit;
}
?>

<?php include 'header.php'; ?>

<div class="container">
    <h1><i class="fas fa-user"></i> Perfil de Entrenador</h1>
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success" role="alert">Perfil actualizado correctamente.</div>
    <?php endif; ?>
    <form method="POST" action="trainer_profile.php" novalidate>
        <div class="mb-3">
            <label for="specialties" class="form-label">Especialidades</label>
            <textarea class="form-control" id="specialties" name="specialties" rows="3" placeholder="Ejemplo: Fuerza, Cardio, Yoga"><?= htmlspecialchars($profile['specialties'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
            <label for="availability" class="form-label">Disponibilidad</label>
            <textarea class="form-control" id="availability" name="availability" rows="3" placeholder="Ejemplo: Lunes a Viernes, 9am - 5pm"><?= htmlspecialchars($profile['availability'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
            <label for="bio" class="form-label">Biografía</label>
            <textarea class="form-control" id="bio" name="bio" rows="4" placeholder="Cuéntanos sobre ti"><?= htmlspecialchars($profile['bio'] ?? '') ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Guardar Perfil</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
