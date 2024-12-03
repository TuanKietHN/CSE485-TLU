<?php
class HomeController {
    private $newsModel;
    private $categoryModel;
    
    public function __construct() {       
        try {
            $this->newsModel = new News();
            $this->categoryModel = new Category();
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
    
    public function index() {
        try {
            $news = $this->newsModel->getAllNews();
            $categories = $this->categoryModel->getAllCategories();
            require 'views/home/index.php';
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
    
    public function search() {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $news = $this->newsModel->searchNews($keyword);
        $categories = $this->categoryModel->getAllCategories();
        require 'views/home/index.php';
    }
}
