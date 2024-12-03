<?php
abstract class BaseController {
    protected function render($view, $data = []) {
        $viewPath = VIEW_DIR . '/' . $view . '.php';
        if (file_exists($viewPath)) {
            extract($data);
            require_once $viewPath;
        } else {
            throw new Exception("View không tồn tại: $view");
        }
    }
    
    protected function redirect($url) {
        header("Location: " . BASE_URL . $url);
        exit();
    }
    
    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    
    protected function getParam($key, $default = null) {
        return $_GET[$key] ?? $default;
    }
    
    protected function postParam($key, $default = null) {
        return $_POST[$key] ?? $default;
    }
    
    protected function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    
    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
            $this->redirect('/auth/login');
        }
    }
}