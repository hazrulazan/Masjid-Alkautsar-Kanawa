<?php
// models/User.php

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function update($data) {
        $query = "UPDATE users SET name = :name, username = :username, email = :email";
        $params = [
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'id' => $data['id']
        ];

        if (!empty($data['password'])) {
            $query .= ", password = :password";
            $params['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        if (array_key_exists('image', $data)) {
            $query .= ", image = :image";
            $params['image'] = $data['image'];
        }

        $query .= " WHERE id = :id";

        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($params);
    }
}
?>
