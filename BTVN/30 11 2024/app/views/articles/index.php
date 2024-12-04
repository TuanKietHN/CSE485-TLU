<?php require_once VIEW_DIR . '/layouts/header.php'; ?>

<div class="container mt-4">
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Danh sách bài viết</h2>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="<?= BASE_URL ?>/articles/create" class="btn btn-primary">Tạo bài viết mới</a>
        <?php endif; ?>
    </div>

    <div class="row">
        <?php foreach ($articles as $article): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <?php if ($article['image']): ?>
                        <img src="<?= BASE_URL ?>/uploads/<?= $article['image'] ?>" class="card-img-top" alt="<?= $article['title'] ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= $article['title'] ?></h5>
                        <p class="card-text"><?= $article['excerpt'] ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Bởi <?= $article['author_name'] ?> | 
                                <?= date('d/m/Y', strtotime($article['created_at'])) ?>
                            </small>
                            <div class="btn-group">
                                <a href="<?= BASE_URL ?>/articles/view/<?= $article['id'] ?>" class="btn btn-sm btn-outline-primary">Xem</a>
                                <?php if (isset($_SESSION['user']) && 
                                    ($_SESSION['user']['id'] == $article['author_id'] || 
                                     $_SESSION['user']['role'] == 'admin')): ?>
                                    <a href="<?= BASE_URL ?>/articles/edit/<?= $article['id'] ?>" class="btn btn-sm btn-outline-secondary">Sửa</a>
                                    <a href="<?= BASE_URL ?>/articles/delete/<?= $article['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">Xóa</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once VIEW_DIR . '/layouts/footer.php'; ?>
