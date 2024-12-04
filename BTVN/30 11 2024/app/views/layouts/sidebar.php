<div class="sidebar">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Danh mục</h5>
        </div>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                <?php foreach($categories as $category): ?>
                    <li class="mb-2">
                        <a href="<?= BASE_URL ?>/categories/articles/<?= $category['id'] ?>" class="text-decoration-none">
                            <?= htmlspecialchars($category['name']) ?>
                            <span class="badge bg-secondary float-end">
                                <?= $category['article_count'] ?>
                            </span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    
    <?php if(isset($_SESSION['user_id'])): ?>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Tác vụ nhanh</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?= BASE_URL ?>/article/create" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Viết bài mới
                    </a>
                    <a href="<?= BASE_URL ?>/members/profile" class="btn btn-info btn-sm">
                        <i class="fas fa-user"></i> Trang cá nhân
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>