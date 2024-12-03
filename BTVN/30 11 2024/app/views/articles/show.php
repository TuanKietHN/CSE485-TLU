<?php require_once VIEW_DIR . '/layouts/header.php'; ?>

<div class="container">
    <article class="blog-post">
        <h1 class="blog-post-title mb-3"><?= htmlspecialchars($article['title']) ?></h1>
        
        <div class="blog-post-meta text-muted mb-4">
            <span><i class="fas fa-user"></i> <?= htmlspecialchars($article['author_name']) ?></span>
            <span class="mx-2">|</span>
            <span><i class="fas fa-folder"></i> <?= htmlspecialchars($article['category_name']) ?></span>
            <span class="mx-2">|</span>
            <span><i class="fas fa-clock"></i> <?= date('d/m/Y H:i', strtotime($article['created_at'])) ?></span>
        </div>
        
        <div class="blog-post-content">
            <?= nl2br(htmlspecialchars($article['content'])) ?>
        </div>
        
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $article['author_id']): ?>
            <div class="mt-4">
                <a href="<?= BASE_URL ?>/articles/edit/<?= $article['id'] ?>" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Sửa
                </a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fas fa-trash"></i> Xóa
                </button>
            </div>
        <?php endif; ?>
    </article>
</div>

<!-- Modal Xác nhận xóa -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa bài viết này?
            </div>
            <div class="modal-footer">
                <form action="<?= BASE_URL ?>/articles/delete/<?= $article['id'] ?>" method="POST">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

<?php require_once VIEW_DIR . '/layouts/header.php'; ?>