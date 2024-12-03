<?php
class CategoryController {
    private $newsModel;
    private $categoryModel;
    
    public function __construct() {
        $this->newsModel = new News();
        $this->categoryModel = new Category();
    }
    
    public function index($id = null) {
        if($id) {
            $news = $this->newsModel->getNewsByCategory($id);
        } else {
            $news = $this->newsModel->getAllNews();
        }
        $categories = $this->categoryModel->getAllCategories();
        require 'views/home/index.php';
    }
}