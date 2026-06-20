<?php
// models/Organization.php

class Organization {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM organizations ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM organizations WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO organizations (name, position, image, linkedin, email) 
            VALUES (:name, :position, :image, :linkedin, :email)
        ");
        return $stmt->execute([
            'name' => $data['name'],
            'position' => $data['position'],
            'image' => $data['image'],
            'linkedin' => $data['linkedin'],
            'email' => $data['email']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE organizations 
            SET name = :name, position = :position, image = :image, linkedin = :linkedin, email = :email
            WHERE id = :id
        ");
        return $stmt->execute([
            'name' => $data['name'],
            'position' => $data['position'],
            'image' => $data['image'],
            'linkedin' => $data['linkedin'],
            'email' => $data['email'],
            'id' => $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM organizations WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
