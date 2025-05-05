<?php
// User model for FitConnect

require_once __DIR__ . '/../config/database.php';

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Register a new user
    public function register($username, $email, $password, $role) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password_hash, role) VALUES (:username, :email, :password_hash, :role)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password_hash' => $password_hash,
            ':role' => $role
        ]);
    }

    // Find user by email
    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    // Verify user login
    public function verifyLogin($email, $password) {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return false;
    }
}
?>
