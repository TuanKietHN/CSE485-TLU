<?php


require_once __DIR__ . '/BaseModel.php';  // Sử dụng đường dẫn tuyệt đối

class Article extends BaseModel {
    protected $table = 'articles';
    
    public function findAll($options = []) {
        $sql = "SELECT a.*, c.name as category_name, m.username as author_name 
                FROM articles a 
                LEFT JOIN categories c ON a.category_id = c.id 
                LEFT JOIN members m ON a.author_id = m.id";
        
        $conditions = [];
        $params = [];
        
        if (isset($options['category_id'])) {
            $conditions[] = "a.category_id = :category_id";
            $params['category_id'] = $options['category_id'];
        }
        
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
        
        $sql .= " ORDER BY a.created_at DESC";
        
        if (isset($options['limit'])) {
            $sql .= " LIMIT :offset, :limit";
            $params['offset'] = $options['offset'] ?? 0;
            $params['limit'] = $options['limit'];
        }
        
        return $this->executeQuery($sql, $params)->fetchAll();
    }
    
    public function findById($id) {
        $sql = "SELECT a.*, c.name as category_name, m.username as author_name 
                FROM articles a 
                LEFT JOIN categories c ON a.category_id = c.id 
                LEFT JOIN members m ON a.author_id = m.id 
                WHERE a.id = :id";
        return $this->executeQuery($sql, ['id' => $id])->fetch();
    }
    
    public function getByAuthor($authorId) {
        $sql = "SELECT a.*, c.name as category_name 
                FROM articles a 
                LEFT JOIN categories c ON a.category_id = c.id 
                WHERE a.author_id = :author_id 
                ORDER BY a.created_at DESC";
                
        return $this->executeQuery($sql, ['author_id' => $authorId])->fetchAll();
    }
    
    public function create($data) {
        $sql = "INSERT INTO articles (title, slug, content, excerpt, category_id, author_id, status) 
                VALUES (:title, :slug, :content, :excerpt, :category_id, :author_id, :status)";
        return $this->executeQuery($sql, $data);
    }
    
    public function update($id, $data) {
        $data['id'] = $id;
        $sql = "UPDATE articles 
                SET title = :title, 
                    slug = :slug,
                    content = :content, 
                    excerpt = :excerpt,
                    category_id = :category_id,
                    updated_at = CURRENT_TIMESTAMP
                WHERE id = :id";
        return $this->executeQuery($sql, $data);
    }
    
    public function delete($id) {
        $sql = "DELETE FROM articles WHERE id = :id";
        return $this->executeQuery($sql, ['id' => $id]);
    }
    
    public function incrementViews($id) {
        $sql = "UPDATE articles SET views = views + 1 WHERE id = :id";
        return $this->executeQuery($sql, ['id' => $id]);
    }
}