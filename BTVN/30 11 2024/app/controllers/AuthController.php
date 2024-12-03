<?php
class AuthController extends BaseController {
    private $memberModel;
    
    public function __construct() {
        $this->memberModel = new Member();
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $username = trim($_POST['username']);
                $password = $_POST['password'];
                
                $member = $this->memberModel->findByUsername($username);
                
                if (!$member || !password_verify($password, $member['password'])) {
                    throw new Exception('Tên đăng nhập hoặc mật khẩu không đúng');
                }
                
                // Lưu thông tin đăng nhập vào session
                $_SESSION['user_id'] = $member['id'];
                $_SESSION['username'] = $member['username'];
                
                $this->redirect('/');
                return;
                
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        
        $this->render('auth/login', [
            'error' => $error ?? null
        ]);
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $data = [
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'password' => $_POST['password']
                ];
                
                $memberId = $this->memberModel->create($data);
                
                if ($memberId) {
                    $_SESSION['success'] = 'Đăng ký thành công! Vui lòng đăng nhập.';
                    $this->redirect('/auth/login');
                    return;
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