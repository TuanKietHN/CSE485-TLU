<?php
class News {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function addNews($title, $content, $image, $category_id) {
        try {
            $sql = "INSERT INTO news (title, content, image, category_id) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->getConnection()->prepare($sql);
            return $stmt->execute([$title, $content, $image, $category_id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    public function updateNews($id, $title, $content, $image, $category_id) {
        try {
            $sql = "UPDATE news SET title = ?, content = ?, image = ?, category_id = ? WHERE id = ?";
            $stmt = $this->db->getConnection()->prepare($sql);
            return $stmt->execute([$title, $content, $image, $category_id, $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    public function deleteNews($id) {
        try {
            $sql = "DELETE FROM news WHERE id = ?";
            $stmt = $this->db->getConnection()->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    public function getAllNews() {
        try {
            $sql = "SELECT n.*, c.name as category_name 
                    FROM news n 
                    LEFT JOIN categories c ON n.category_id = c.id 
                    ORDER BY n.created_at DESC";
            return $this->db->getConnection()->query($sql)->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getNewsById($id) {
        try {
            $sql = "SELECT n.*, c.name as category_name 
                    FROM news n 
                    LEFT JOIN categories c ON n.category_id = c.id 
                    WHERE n.id = ?";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function getNewsByCategory($category_id) {
        try {
            $sql = "SELECT n.*, c.name as category_name 
                    FROM news n 
                    LEFT JOIN categories c ON n.category_id = c.id 
                    WHERE n.category_id = ?
                    ORDER BY n.created_at DESC";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute([$category_id]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function searchNews($keyword) {
        try {
            $sql = "SELECT n.*, c.name as category_name 
                    FROM news n 
                    LEFT JOIN categories c ON n.category_id = c.id 
                    WHERE n.title LIKE ? OR n.content LIKE ?
                    ORDER BY n.created_at DESC";
            $stmt = $this->db->getConnection()->prepare($sql);
            $keyword = "%$keyword%";
            $stmt->execute([$keyword, $keyword]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
}