<?php
// models/Article.php

class Article {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll($limit = null) {
        $sql = "SELECT * FROM articles ORDER BY created_at DESC";
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM articles WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO articles (title, content, category, image, user_id) 
            VALUES (:title, :content, :category, :image, :user_id)
        ");
        return $stmt->execute([
            'title' => $data['title'],
            'content' => $data['content'],
            'category' => $data['category'],
            'image' => $data['image'],
            'user_id' => $data['user_id']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE articles 
            SET title = :title, content = :content, category = :category, image = :image
            WHERE id = :id
        ");
        return $stmt->execute([
            'title' => $data['title'],
            'content' => $data['content'],
            'category' => $data['category'],
            'image' => $data['image'],
            'id' => $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM articles WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    
    public function getCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM articles");
        return $stmt->fetchColumn();
    }
}
?>
