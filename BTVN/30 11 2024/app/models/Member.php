<?php
require_once __DIR__ . '/BaseModel.php';

class Member extends BaseModel {
    protected $table = 'members';
    
    public function findByUsername($username) {
        $query = "SELECT * FROM {$this->table} WHERE username = :username";
        return $this->executeQuery($query, ['username' => $username])->fetch();
    }
    
    public function findByEmail($email) {
        $query = "SELECT * FROM {$this->table} WHERE email = :email";
        return $this->executeQuery($query, ['email' => $email])->fetch();
    }
    
    public function create($data) {
        if (empty($data['username']) || empty($data['password']) || empty($data['email'])) {
            throw new Exception("Vui lòng điền đầy đủ thông tin");
        }
        
        // Kiểm tra username và email đã tồn tại chưa
        if ($this->findByUsername($data['username'])) {
            throw new Exception("Tên đăng nhập đã tồn tại");
        }
        
        if ($this->findByEmail($data['email'])) {
            throw new Exception("Email đã tồn tại");
        }
        
        // Mã hóa mật khẩu
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        return parent::create($data);
    }
}