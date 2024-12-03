<?php
class MemberController extends BaseController {
    private $memberModel;
    private $articleModel;
    
    public function __construct() {
        $this->memberModel = new Member();
        $this->articleModel = new Article();
    }
    
    public function profile() {
        $this->requireLogin();
        
        $member = $this->memberModel->findById($_SESSION['user_id']);
        $articles = $this->articleModel->getByAuthor($_SESSION['user_id']);
        
        $this->render('members/profile', [
            'member' => $member,
            'articles' => $articles
        ]);
    }
    
    public function update() {
        $this->requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'email' => trim($_POST['email']),
                'new_password' => $_POST['new_password'],
                'current_password' => $_POST['current_password']
            ];
            
            if ($this->memberModel->verifyPassword($_SESSION['user_id'], $data['current_password'])) {
                if ($this->memberModel->update($_SESSION['user_id'], $data)) {
                    $_SESSION['success'] = 'Cập nhật thông tin thành công';
                } else {
                    $_SESSION['error'] = 'Có lỗi xảy ra';
                }
            } else {
                $_SESSION['error'] = 'Mật khẩu hiện tại không đúng';
            }
        }
        
        $this->redirect('/members/profile');
    }
}