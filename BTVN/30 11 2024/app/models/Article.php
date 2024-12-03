<?php


require_once __DIR__ . '/BaseModel.php';  // Sử dụng đường dẫn tuyệt đối

class Article extends BaseModel {
    protected $table = 'articles';
    
    public function findAll($options = []) {
        $query = "SELECT a.*, c.name as category_name, m.username as author_name 
                 FROM {$this->table} a
                 LEFT JOIN categories c ON a.category_id = c.id
                 LEFT JOIN members m ON a.author_id = m.id";
        
        $params = [];
        $conditions = [];
        
        if (!empty($options['category_id'])) {
            $conditions[] = "a.category_id = :category_id";
            $params['category_id'] = $options['category_id'];
        }
        
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }
        
        $query .= " ORDER BY a.created_at DESC";
        
        if (isset($options['limit'])) {
            $query .= " LIMIT :limit";
            $params['limit'] = (int)$options['limit'];
            
            if (isset($options['offset'])) {
                $query .= " OFFSET :offset";
                $params['offset'] = (int)$options['offset'];
            }
        }
        
        return $this->executeQuery($query, $params)->fetchAll();
    }
    
    public function findById($id) {
        $query = "SELECT a.*, c.name as category_name, m.username as author_name 
                 FROM {$this->table} a
                 LEFT JOIN categories c ON a.category_id = c.id
                 LEFT JOIN members m ON a.author_id = m.id
                 WHERE a.id = :id";
        return $this->executeQuery($query, ['id' => $id])->fetch();
    }
    
    public function create($data) {
        $requiredFields = ['title', 'content', 'category_id', 'author_id'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                throw new Exception("Thiếu trường bắt buộc: $field");
            }
        }
        
        return parent::create($data);
    }
    
    public function update($id, $data) {
        if (empty($data['title']) || empty($data['content'])) {
            throw new Exception("Tiêu đề và nội dung không được để trống");
        }
        
        return parent::update($id, $data);
    }
}