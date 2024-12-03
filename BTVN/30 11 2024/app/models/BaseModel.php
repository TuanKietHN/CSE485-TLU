<?php
require_once __DIR__ . '/../config/database.php';


abstract class BaseModel {
    protected $db;
    protected $table;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    protected function executeQuery($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            throw $e;
        }
    }

    public function findById($id) {
        return $this->executeQuery(
            "SELECT * FROM {$this->table} WHERE id = :id",
            ['id' => $id]
        )->fetch(PDO::FETCH_ASSOC);
    }

    public function findAll() {
        return $this->executeQuery("SELECT * FROM {$this->table}")->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function create($data) {
        $fields = array_keys($data);
        $sql = "INSERT INTO {$this->table} (" . implode(', ', $fields) . ") 
                VALUES (:" . implode(', :', $fields) . ")";
        
        if ($this->executeQuery($sql, $data)) {
            return $this->db->lastInsertId();
        }
        return false;
    }
    
    public function update($id, $data) {
        $fields = array_keys($data);
        $setClauses = array_map(function($field) {
            return "$field = :$field";
        }, $fields);
        
        $sql = "UPDATE {$this->table} SET " . implode(', ', $setClauses) . " WHERE id = :id";
        $data['id'] = $id;
        
        return $this->executeQuery($sql, $data)->rowCount() > 0;
    }
    
    public function delete($id) {
        return $this->executeQuery(
            "DELETE FROM {$this->table} WHERE id = :id",
            ['id' => $id]
        )->rowCount() > 0;
    }
}