<?php
// models/Auth.php

class Auth {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login($username_or_email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :identifier OR email = :identifier LIMIT 1");
        $stmt->execute(['identifier' => $username_or_email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user->password)) {
            // Password is correct, start session
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['user_username'] = $user->username;
            $_SESSION['user_image'] = $user->image ?? '';
            return true;
        }

        return false;
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
    }

    public static function check() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    public static function requireLogin() {
        if (!self::check()) {
            header("Location: /masjid/admin/login.php");
            exit;
        }
    }
}
?>
