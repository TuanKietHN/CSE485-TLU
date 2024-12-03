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
    
    public function create($name) {
        if (empty($name)) {
            throw new Exception("Tên danh mục không được để trống");
        }
        return parent::create(['name' => $name]);
    }
}