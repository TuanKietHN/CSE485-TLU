<?php require_once VIEW_DIR . '/layouts/header.php'; ?>

<div class="container">
    <h1><?= htmlspecialchars($category['name']) ?></h1>
    
    <div class="row">
        <?php if (!empty($articles)): ?>
            <?php foreach($articles as $article): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= htmlspecialchars($article['title']) ?>
                            </h5>
                            <p class="card-text">
                                <?= substr(htmlspecialchars($article['content']), 0, 100) ?>...
                            </p>
                            <div class="card-footer">
                                <small class="text-muted">
                                    Tác giả: <?= htmlspecialchars($article['author_name']) ?>
                                </small>
                            </div>
                            <a href="<?= BASE_URL ?>/articles/show/<?= $article['id'] ?>" 
                               class="btn btn-primary">Xem thêm</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col">
                <p>Chưa có bài viết nào trong danh mục này.</p>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="mt-4">
        <a href="<?= BASE_URL ?>/categories" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại danh sách danh mục
        </a>
    </div>
</div>

<?php require_once VIEW_DIR . '/layouts/footer.php'; ?> 