<?php
require_once __DIR__ . '/BaseModel.php';

class Category extends BaseModel {
    protected $table = 'categories';
    
    public function findAll() {
        $query = "SELECT c.*, COUNT(a.id) as article_count 
                 FROM {$this->table} c
                 LEFT JOIN articles a ON c.id = a.category_id
                 GROUP BY c.id
                 ORDER BY c.name ASC";
        return $this->executeQuery($query)->fetchAll();
    }
    
    public function canDelete($id) {
        $query = "SELECT COUNT(*) FROM articles WHERE category_id = :id";
        $count = $this->executeQuery($query, ['id' => $id])->fetchColumn();
        return $count == 0;
    }
    
    public function create($data) {
        if (is_string($data)) {
            $data = ['name' => $data];
        }
        
        if (empty($data['name'])) {
            throw new Exception("Tên danh mục không được để trống");
        }
        
        $existingCategory = $this->findByName($data['name']);
        if ($existingCategory) {
            throw new Exception("Danh mục này đã tồn tại");
        }
        
        $sql = "INSERT INTO categories (name) VALUES (:name)";
        return $this->executeQuery($sql, $data);
    }
    
    public function findByName($name) {
        $sql = "SELECT * FROM categories WHERE name = :name";
        return $this->executeQuery($sql, ['name' => $name])->fetch();
    }
    
    public function getAll() {
        $sql = "SELECT * FROM categories ORDER BY name ASC";
        return $this->executeQuery($sql)->fetchAll();
    }
    
    public function findById($id) {
        $sql = "SELECT * FROM categories WHERE id = :id";
        return $this->executeQuery($sql, ['id' => $id])->fetch();
    }
    
    public function update($id, $data) {
        $data['id'] = $id;
        $sql = "UPDATE categories SET name = :name WHERE id = :id";
        return $this->executeQuery($sql, $data);
    }
    
    public function delete($id) {
        $sql = "DELETE FROM categories WHERE id = :id";
        return $this->executeQuery($sql, ['id' => $id]);
    }
    
    public function getArticleCount($id) {
        $sql = "SELECT COUNT(*) as count FROM articles WHERE category_id = :id";
        $result = $this->executeQuery($sql, ['id' => $id])->fetch();
        return $result['count'];
    }
}