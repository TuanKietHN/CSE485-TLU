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
    
    public function login($username, $password) {
        $query = "SELECT * FROM members 
                  WHERE (username = :username OR email = :username) 
                  AND status = 1";
        
        $member = $this->executeQuery($query, ['username' => $username])->fetch();
        
        if ($member && password_verify($password, $member['password'])) {
            return $member;
        }
        return false;
    }
    
    public function register($data) {
        try {
            // Kiểm tra username đã tồn tại
            $query = "SELECT id FROM members WHERE username = :username";
            if ($this->executeQuery($query, ['username' => $data['username']])->fetch()) {
                throw new Exception('Tên đăng nhập đã tồn tại');
            }
            
            // Kiểm tra email đã tồn tại
            $query = "SELECT id FROM members WHERE email = :email";
            if ($this->executeQuery($query, ['email' => $data['email']])->fetch()) {
                throw new Exception('Email đã tồn tại');
            }
            
            // Kiểm tra password_confirm (nhưng không lưu vào DB)
            if ($data['password'] !== $data['password_confirm']) {
                throw new Exception('Mật khẩu xác nhận không khớp');
            }
            
            // Hash mật khẩu
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            
            // Chỉ lưu các trường cần thiết vào DB
            $query = "INSERT INTO members (username, email, password, role, status) 
                     VALUES (:username, :email, :password, 'user', 1)";
                     
            return $this->executeQuery($query, [
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $hashedPassword
            ]);
            
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public function isAdmin($memberId) {
        $query = "SELECT role FROM members WHERE id = :id AND status = 1";
        $member = $this->executeQuery($query, ['id' => $memberId])->fetch();
        return $member && $member['role'] === 'admin';
    }
    
    public function updateProfile($id, $data) {
        $query = "UPDATE members 
                  SET username = :username,
                      email = :email,
                      updated_at = CURRENT_TIMESTAMP
                  WHERE id = :id";
                  
        return $this->executeQuery($query, [
            'id' => $id,
            'username' => $data['username'],
            'email' => $data['email']
        ]);
    }
    
    public function changePassword($id, $oldPassword, $newPassword) {
        // Kiểm tra mật khẩu cũ
        $member = $this->findById($id);
        if (!password_verify($oldPassword, $member['password'])) {
            throw new Exception('Mật khẩu cũ không đúng');
        }
        
        // Cập nhật mật khẩu mới
        $query = "UPDATE members 
                  SET password = :password,
                      updated_at = CURRENT_TIMESTAMP
                  WHERE id = :id";
                  
        return $this->executeQuery($query, [
            'id' => $id,
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ]);
    }
}