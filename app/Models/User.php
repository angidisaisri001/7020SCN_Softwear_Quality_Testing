<?php
class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function register($data) {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, phone, dob, gender) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$data['name'], $data['email'], password_hash($data['password'], PASSWORD_BCRYPT), $data['phone'], $data['dob'], $data['gender']]);
    }

    public function login($email, $password, $role) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? AND role = ?");
        $stmt->execute([$email, $role]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getAllPatients() {
        $stmt = $this->db->query("SELECT * FROM users WHERE role = 'patient'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}