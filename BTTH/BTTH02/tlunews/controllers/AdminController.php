<?php
require_once 'config/config.php';

class AdminController {
    private $userModel;
    private $newsModel;
    private $categoryModel;
    
    public function __construct() {
        $this->userModel = new User();
        $this->newsModel = new News();
        $this->categoryModel = new Category();
    }
    
    public function index() {
        $this->checkAdmin();
        $news = $this->newsModel->getAllNews();
        require 'views/admin/index.php';
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sử dụng htmlspecialchars thay cho FILTER_SANITIZE_STRING
            $username = htmlspecialchars(trim($_POST['username'] ?? ''), ENT_QUOTES, 'UTF-8');
            $password = $_POST['password'] ?? '';
            
            if (empty($username) || empty($password)) {
                $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin';
                require ROOT_PATH . '/views/admin/login.php';
                return;
            }
            
            $user = $this->userModel->login($username, $password);
            
            if ($user) {
                $_SESSION['admin'] = $user;
                header('Location: ' . BASE_URL . '/admin');
                exit;
            } else {
                $_SESSION['error'] = 'Tên đăng nhập hoặc mật khẩu không đúng';
            }
        }
        require ROOT_PATH . '/views/admin/login.php';
    }
    
    public function logout() {
        unset($_SESSION['admin']);
        // Sửa thành đường dẫn tương đối
        header('Location: ' . BASE_URL);
        exit;
    }
    
    public function addNews() {
        $this->checkAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $target_dir = UPLOAD_PATH . '/';
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $fileName = time() . '_' . basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $fileName;
            
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = 'uploads/' . $fileName;
                
                $result = $this->newsModel->addNews(
                    htmlspecialchars($_POST['title']),
                    htmlspecialchars($_POST['content']),
                    $image_path,
                    (int)$_POST['category_id']
                );
                
                if ($result) {
                    $_SESSION['success'] = "Thêm tin tức thành công";
                } else {
                    $_SESSION['error'] = "Có lỗi xảy ra";
                }
            }
            
            header('Location: ' . BASE_URL . '/admin');
            exit;
        }
        
        $categories = $this->categoryModel->getAllCategories();
        require ROOT_PATH . '/views/admin/news/add.php';
    }
    
    public function editNews($id) {
        $this->checkAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $image = $_POST['current_image'];
            
            if ($_FILES['image']['name']) {
                // Xóa ảnh cũ
                $oldImage = ROOT_PATH . '/' . $_POST['current_image'];
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
                
                $fileName = time() . '_' . basename($_FILES["image"]["name"]);
                $target_file = UPLOAD_PATH . '/' . $fileName;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = 'uploads/' . $fileName;
                }
            }
            
            $result = $this->newsModel->updateNews(
                $id,
                htmlspecialchars($_POST['title']),
                htmlspecialchars($_POST['content']),
                $image,
                (int)$_POST['category_id']
            );
            
            if ($result) {
                $_SESSION['success'] = "Cập nhật tin tức thành công";
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra";
            }
            
            header('Location: ' . BASE_URL . '/admin');
            exit;
        }
        
        $news = $this->newsModel->getNewsById($id);
        $categories = $this->categoryModel->getAllCategories();
        require ROOT_PATH . '/views/admin/news/edit.php';
    }
    
    public function deleteNews($id) {
        $this->checkAdmin();
        
        // Xóa ảnh cũ
        $news = $this->newsModel->getNewsById($id);
        if (file_exists($news['image'])) {
            unlink($news['image']);
        }
        
        // Xóa tin tức
        $this->newsModel->deleteNews($id);
        
        header('Location: /tlu/tlunews/admin');
        exit;
    }
    
    private function checkAdmin() {
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }
    }
}
