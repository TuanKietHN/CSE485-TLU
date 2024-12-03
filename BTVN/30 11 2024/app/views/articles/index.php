<?php require_once VIEW_DIR . '/layouts/header.php'; ?>

<div class="container">
    <h1>Danh sách bài viết</h1>

    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="<?= BASE_URL ?>/articles/create" class="btn btn-primary mb-3">Tạo bài viết mới</a>
    <?php endif; ?>

    <div class="row">
        <?php foreach($articles as $article): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($article['title'] ?? 'No Title') ?></h5>
                        <p class="card-text">
                            <?= substr(htmlspecialchars($article['content'] ?? 'No Content'), 0, 100) ?>...
                        </p>
                        <div class="card-footer">
                            <small>
                                Danh mục: <?= htmlspecialchars($article['category_name'] ?? 'No Category') ?><br>
                                Tác giả: <?= htmlspecialchars($article['author_name'] ?? 'Unknown Author') ?>
                            </small>
                        </div>
                        <a href="<?= BASE_URL ?>/articles/show/<?= $article['id'] ?>" class="btn btn-info">Xem thêm</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once VIEW_DIR . '/layouts/footer.php'; ?>
