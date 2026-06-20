<?php
// models/Management.php

class Management {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM mosque_managements ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM mosque_managements WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO mosque_managements (title, description, icon) 
            VALUES (:title, :description, :icon)
        ");
        return $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'icon' => $data['icon']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE mosque_managements 
            SET title = :title, description = :description, icon = :icon
            WHERE id = :id
        ");
        return $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'icon' => $data['icon'],
            'id' => $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM mosque_managements WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
