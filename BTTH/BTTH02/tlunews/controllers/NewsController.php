<?php
class NewsController {
    private $newsModel;
    private $categoryModel;
    
    public function __construct() {
        $this->newsModel = new News();
        $this->categoryModel = new Category();
    }
    
    public function detail($id) {
        $news = $this->newsModel->getNewsById($id);
        $categories = $this->categoryModel->getAllCategories();
        require 'views/news/detail.php';
    }
}
