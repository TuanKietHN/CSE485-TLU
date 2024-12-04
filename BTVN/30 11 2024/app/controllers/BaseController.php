<?php
abstract class BaseController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    protected function render($view, $data = []) {
        extract($data);
        require_once VIEW_DIR . '/' . $view . '.php';
    }
    
    protected function redirect($url) {
        header('Location: ' . BASE_URL . $url);
        exit;
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