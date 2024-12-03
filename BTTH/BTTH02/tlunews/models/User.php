<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function login($username, $password) {
        try {
            $sql = "SELECT * FROM users WHERE username = ? AND role = 1";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    public function register($username, $password, $role = 0) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
            $stmt = $this->db->getConnection()->prepare($sql);
            return $stmt->execute([$username, $hashedPassword, $role]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    public function checkRole($id) {
        try {
            $sql = "SELECT role FROM users WHERE id = ?";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result ? $result['role'] : false;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
