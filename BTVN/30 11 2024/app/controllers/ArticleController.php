<?php
class ArticleController extends BaseController {
    private $articleModel;
    private $categoryModel;
    
    public function __construct() {
        $this->articleModel = new Article();
        $this->categoryModel = new Category();
    }
    
    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        $options = [
            'limit' => $limit,
            'offset' => $offset
        ];
        
        if (isset($_GET['category'])) {
            $options['category_id'] = (int)$_GET['category'];
        }
        
        $articles = $this->articleModel->findAll($options);
        $categories = $this->categoryModel->findAll();
        
        $this->render('articles/index', [
            'articles' => $articles,
            'categories' => $categories,
            'currentPage' => $page
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
        $this->requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'category_id' => (int)$_POST['category_id'],
                'author_id' => $_SESSION['user_id']
            ];
            
            if (empty($data['title']) || empty($data['content'])) {
                $error = "Vui lòng điền đầy đủ thông tin";
            } else {
                if ($this->articleModel->create($data)) {
                    $this->redirect('/articles');
                } else {
                    $error = "Có lỗi xảy ra, vui lòng thử lại";
                }
            }
        }
        
        $categories = $this->categoryModel->findAll();
        $this->render('articles/create', [
            'categories' => $categories,
            'error' => $error ?? null
        ]);
    }
    
    public function edit($id) {
        $this->requireLogin();
        
        $article = $this->articleModel->findById($id);
        if (!$article || $article['author_id'] != $_SESSION['user_id']) {
            $this->render('shared/error');
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'category_id' => (int)$_POST['category_id'],
                'author_id' => $_SESSION['user_id']
            ];
            
            if (empty($data['title']) || empty($data['content'])) {
                $error = "Vui lòng điền đầy đủ thông tin";
            } else {
                if ($this->articleModel->update($id, $data)) {
                    $this->redirect("/articles/show/$id");
                } else {
                    $error = "Có lỗi xảy ra, vui lòng thử lại";
                }
            }
        }
        
        $categories = $this->categoryModel->findAll();
        $this->render('articles/edit', [
            'article' => $article,
            'categories' => $categories,
            'error' => $error ?? null
        ]);
    }
    
    public function delete($id) {
        $this->requireLogin();
        
        $article = $this->articleModel->findById($id);
        if (!$article || $article['author_id'] != $_SESSION['user_id']) {
            $this->render('shared/error');
            return;
        }
        
        if ($this->articleModel->delete($id)) {
            $this->redirect('/articles');
        } else {
            $error = "Có lỗi xảy ra, vui lòng thử lại";
            $this->render('articles/show', [
                'article' => $article,
                'error' => $error
            ]);
        }
    }
}