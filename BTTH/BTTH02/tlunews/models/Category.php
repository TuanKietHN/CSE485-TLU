<?php
class Category {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    public function getAllCategories() {
        try {
            $sql = "SELECT * FROM categories ORDER BY name";
            return $this->db->getConnection()->query($sql)->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getCategoryById($id) {
        try {
            $sql = "SELECT * FROM categories WHERE id = ?";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }
}
