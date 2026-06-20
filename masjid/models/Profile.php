<?php
// models/Profile.php

class Profile {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getProfile() {
        $stmt = $this->pdo->query("SELECT * FROM profiles LIMIT 1");
        $profile = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$profile) {
            $this->pdo->exec("INSERT INTO profiles (history, vision, mission) VALUES ('-', '-', '-')");
            $stmt = $this->pdo->query("SELECT * FROM profiles LIMIT 1");
            $profile = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $stmt2 = $this->pdo->query("SELECT * FROM contacts LIMIT 1");
        $contact = $stmt2->fetch(PDO::FETCH_ASSOC);
        
        if (!$contact) {
            $this->pdo->exec("INSERT INTO contacts (address, phone, whatsapp, email_1) VALUES ('-', '-', '-', '-')");
            $stmt2 = $this->pdo->query("SELECT * FROM contacts LIMIT 1");
            $contact = $stmt2->fetch(PDO::FETCH_ASSOC);
        }
        
        return array_merge($profile, $contact);
    }

    public function update($data) {
        $query = "UPDATE profiles SET history = :history, vision = :vision, mission = :mission";
        $params = [
            'history' => $data['history'],
            'vision' => $data['vision'],
            'mission' => $data['mission']
        ];
        
        if (array_key_exists('logo', $data)) {
            $query .= ", logo = :logo";
            $params['logo'] = $data['logo'];
        }
        
        if (array_key_exists('image', $data)) {
            $query .= ", image = :image";
            $params['image'] = $data['image'];
        }
        
        if (array_key_exists('hero_image', $data)) {
            $query .= ", hero_image = :hero_image";
            $params['hero_image'] = $data['hero_image'];
        }
        
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        $stmt2 = $this->pdo->prepare("
            UPDATE contacts 
            SET address = :address, 
                phone = :phone, 
                email_1 = :email
        ");
        
        $stmt2->execute([
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email']
        ]);

        return true;
    }
}
?>
