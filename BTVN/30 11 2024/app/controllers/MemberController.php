<?php
class MemberController extends BaseController {
    private $memberModel;
    private $articleModel;
    
    public function __construct() {
        $this->memberModel = new Member();
        $this->articleModel = new Article();
    }
    
    public function profile() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/auth/login');
        }
        
        $userId = $_SESSION['user']['id'];
        $member = $this->memberModel->findById($userId);
        $articles = $this->articleModel->getByAuthor($userId);
        
        $this->render('member/profile', [
            'member' => $member,
            'articles' => $articles
        ]);
    }
    
    public function update() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/auth/login');
        }
        
        if ($this->isPost()) {
            try {
                $data = [
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email'])
                ];
                
                if (!empty($_POST['new_password'])) {
                    if ($_POST['new_password'] !== $_POST['password_confirm']) {
                        throw new Exception('Mật khẩu xác nhận không khớp');
                    }
                    $data['password'] = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                }
                
                if ($this->memberModel->update($_SESSION['user']['id'], $data)) {
                    $_SESSION['success'] = 'Cập nhật thông tin thành công!';
                    $_SESSION['user']['username'] = $data['username'];
                    $_SESSION['user']['email'] = $data['email'];
                }
                
                $this->redirect('/member/profile');
                
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        
        $member = $this->memberModel->findById($_SESSION['user']['id']);
        $this->render('member/profile', [
            'member' => $member,
            'error' => $error ?? null
        ]);
    }
}