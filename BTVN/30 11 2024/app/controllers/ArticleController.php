<?php
class ArticleController extends BaseController {
    protected $articleModel;
    protected $categoryModel;
    
    public function __construct() {
        parent::__construct();
        
        $this->articleModel = new Article();
        $this->categoryModel = new Category();
    }
    
    public function index() {
        $articles = $this->articleModel->findAll();
        $this->render('articles/index', [
            'articles' => $articles
        ]);
    }
    
    public function show($id) {
        $article = $this->articleModel->findById($id);
        if (!$article) {
            $this->render('shared/error');
            return;
        }
        
        $this->render('articles/show', ['article' => $article]);
    }
    
    public function create() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/auth/login');
        }
        
        $categories = $this->categoryModel->getAll();
        $this->render('articles/create', [
            'categories' => $categories
        ]);
    }
    
    public function store() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/auth/login');
        }
        
        if ($this->isPost()) {
            try {
                $data = [
                    'title' => trim($_POST['title']),
                    'content' => trim($_POST['content']),
                    'category_id' => $_POST['category_id'],
                    'author_id' => $_SESSION['user']['id'],
                    'excerpt' => substr(strip_tags($_POST['content']), 0, 150),
                    'status' => 'published',
                    'slug' => $this->createSlug($_POST['title'])
                ];
                
                if ($this->articleModel->create($data)) {
                    $_SESSION['success'] = 'Tạo bài viết thành công!';
                    $this->redirect('/articles');
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        
        $categories = $this->categoryModel->getAll();
        $this->render('articles/create', [
            'categories' => $categories,
            'error' => $error ?? null
        ]);
    }
    
    public function edit($id) {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/auth/login');
        }
        
        $article = $this->articleModel->findById($id);
        if (!$article) {
            $this->render('shared/error404');
            return;
        }
        
        if ($article['author_id'] != $_SESSION['user']['id'] && $_SESSION['user']['role'] != 'admin') {
            $_SESSION['error'] = 'Bạn không có quyền sửa bài viết này!';
            $this->redirect('/articles');
        }
        
        $categories = $this->categoryModel->getAll();
        $this->render('articles/edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }
    
    public function update($id) {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/auth/login');
        }
        
        if ($this->isPost()) {
            try {
                $data = [
                    'title' => trim($_POST['title']),
                    'content' => trim($_POST['content']),
                    'category_id' => $_POST['category_id'],
                    'excerpt' => substr(strip_tags($_POST['content']), 0, 150),
                    'slug' => $this->createSlug($_POST['title'])
                ];
                
                if ($this->articleModel->update($id, $data)) {
                    $_SESSION['success'] = 'Cập nhật bài viết thành công!';
                    $this->redirect('/articles');
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        
        $article = $this->articleModel->findById($id);
        $categories = $this->categoryModel->getAll();
        $this->render('articles/edit', [
            'article' => $article,
            'categories' => $categories,
            'error' => $error ?? null
        ]);
    }
    
    public function delete($id) {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/auth/login');
        }
        
        $article = $this->articleModel->findById($id);
        if (!$article) {
            $this->render('shared/error404');
            return;
        }
        
        if ($article['author_id'] != $_SESSION['user']['id'] && $_SESSION['user']['role'] != 'admin') {
            $_SESSION['error'] = 'Bạn không có quyền xóa bài viết này!';
            $this->redirect('/articles');
        }
        
        if ($this->articleModel->delete($id)) {
            $_SESSION['success'] = 'Xóa bài viết thành công!';
        }
        
        $this->redirect('/articles');
    }
    
    public function view($id) {
        $article = $this->articleModel->findById($id);
        if (!$article) {
            $this->render('shared/error404');
            return;
        }
        
        $this->articleModel->incrementViews($id);
        
        $this->render('articles/view', [
            'article' => $article
        ]);
    }
    
    private function createSlug($title) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        return $slug;
    }
}