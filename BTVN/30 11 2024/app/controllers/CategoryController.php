<?php
class CategoryController extends BaseController {
    private $categoryModel;
    private $articleModel;
    
    public function __construct() {
        $this->categoryModel = new Category();
        $this->articleModel = new Article();
    }
    
    public function index() {
        $categories = $this->categoryModel->findAll();
        $this->render('categories/index', ['categories' => $categories]);
    }
    
    public function articles($id) {
        $category = $this->categoryModel->findById($id);
        if (!$category) {
            $this->redirect('/');
            return;
        }
        
        $options = [
            'category_id' => $id,
            'limit' => 10
        ];
        
        $articles = $this->articleModel->findAll($options);
        
        $this->render('categories/articles', [
            'category' => $category,
            'articles' => $articles
        ]);
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $name = trim($_POST['name']);
                $categoryId = $this->categoryModel->create($name);
                
                if ($categoryId) {
                    $this->redirect('/categories');
                    return;
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        
        $this->render('categories/create', [
            'error' => $error ?? null
        ]);
    }
}