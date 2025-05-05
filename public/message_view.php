<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../config/database.php';

$userId = $_SESSION['user_id'];
$otherUserId = $_GET['user_id'] ?? null;

if (!$otherUserId || !is_numeric($otherUserId)) {
    header('Location: messages.php');
    exit;
}

// Fetch other user info
$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$otherUserId]);
$otherUser = $stmt->fetch();

if (!$otherUser) {
    header('Location: messages.php');
    exit;
}

// Handle new message submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = trim($_POST['message'] ?? '');
    if ($message !== '') {
        $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $otherUserId, $message]);
        header("Location: message_view.php?user_id=$otherUserId");
        exit;
    }
}

// Fetch messages between users
$sql = "
    SELECT sender_id, message, sent_at
    FROM messages
    WHERE (sender_id = ? AND receiver_id = ?)
       OR (sender_id = ? AND receiver_id = ?)
    ORDER BY sent_at ASC
";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId, $otherUserId, $otherUserId, $userId]);
$messages = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Conversación con <?= htmlspecialchars($otherUser['username']) ?> - FitConnect</title>
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
        .container {
            max-width: 600px;
            margin: 3rem auto;
            display: flex;
            flex-direction: column;
            height: 80vh;
        }
        .messages {
            flex-grow: 1;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            background-color: #f8f9fa;
        }
        .message {
            margin-bottom: 1rem;
            max-width: 70%;
            padding: 0.5rem 1rem;
            border-radius: 1rem;
            clear: both;
        }
        .message.sent {
            background-color: #1A73E8;
            color: white;
            float: right;
            text-align: right;
        }
        .message.received {
            background-color: #e9ecef;
            color: #212529;
            float: left;
            text-align: left;
        }
        .message-time {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
        form textarea {
            resize: none;
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
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-comments"></i> Conversación con <?= htmlspecialchars($otherUser['username']) ?></h1>
        <div class="messages" id="messages">
            <?php foreach ($messages as $msg): ?>
                <?php $sent = ($msg['sender_id'] == $userId); ?>
                <div class="message <?= $sent ? 'sent' : 'received' ?>">
                    <?= htmlspecialchars($msg['message']) ?>
                    <div class="message-time"><?= date('d/m/Y H:i', strtotime($msg['sent_at'])) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <form method="POST" action="message_view.php?user_id=<?= htmlspecialchars($otherUserId) ?>">
            <div class="mb-3">
                <textarea class="form-control" name="message" rows="3" placeholder="Escribe un mensaje..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>
    </div>
    <script>
        // Scroll to bottom of messages on page load
        const messagesDiv = document.getElementById('messages');
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    </script>
</body>
</html>
