<?php
class AuthController extends BaseController {
    private $memberModel;
    
    public function __construct() {
        $this->memberModel = new Member();
    }
    
    public function login() {
        if ($this->isPost()) {
            try {
                $username = trim($_POST['username']);
                $password = $_POST['password'];
                
                $member = $this->memberModel->findByUsername($username);
                
                if (!$member || !password_verify($password, $member['password'])) {
                    throw new Exception('Tên đăng nhập hoặc mật khẩu không đúng');
                }
                
                $_SESSION['user_id'] = $member['id'];
                $_SESSION['username'] = $member['username'];
                
                $this->redirect('/');
                
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        
        $this->render('auth/login', [
            'error' => $error ?? null
        ]);
    }
    
    public function register() {
        if ($this->isPost()) {
            try {
                $data = [
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'password' => $_POST['password'],
                    'password_confirm' => $_POST['password_confirm']
                ];
                
                if ($data['password'] !== $data['password_confirm']) {
                    throw new Exception('Mật khẩu xác nhận không khớp');
                }
                
                if ($this->memberModel->register($data)) {
                    $_SESSION['success'] = 'Đăng ký thành công! Vui lòng đăng nhập.';
                    $this->redirect('/auth/login');
                }
                
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        
        $this->render('auth/register', [
            'error' => $error ?? null
        ]);
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('/auth/login');
    }
}