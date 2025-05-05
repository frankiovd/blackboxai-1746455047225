<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../config/database.php';

$userId = $_SESSION['user_id'];

// Fetch distinct users who have messaged with the current user
$sql = "
    SELECT DISTINCT
        CASE
            WHEN sender_id = ? THEN receiver_id
            ELSE sender_id
        END AS other_user_id
    FROM messages
    WHERE sender_id = ? OR receiver_id = ?
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$userId, $userId, $userId]);
$users = $stmt->fetchAll(PDO::FETCH_COLUMN);

?>

<?php include 'header.php'; ?>

<div class="container">
    <h1><i class="fas fa-envelope"></i> Mensajes</h1>
    <?php if (empty($users)): ?>
        <p>No tienes conversaciones aún.</p>
    <?php else: ?>
        <?php foreach ($users as $otherUserId): ?>
            <?php
            // Fetch username of the other user
            $stmtUser = $pdo->prepare("SELECT username FROM users WHERE id = ?");
            $stmtUser->execute([$otherUserId]);
            $otherUser = $stmtUser->fetch();
            ?>
            <a href="message_view.php?user_id=<?= htmlspecialchars($otherUserId) ?>" class="user-link">
                <i class="fas fa-user"></i> <?= htmlspecialchars($otherUser['username'] ?? 'Usuario') ?>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
