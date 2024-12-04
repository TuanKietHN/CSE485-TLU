<?php require_once VIEW_DIR . '/layouts/header.php'; ?>

<div class="container mt-4">
    <h2>Tạo bài viết mới</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    
    <form action="<?= BASE_URL ?>/article/create" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="content" class="form-label">Nội dung</label>
            <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Đăng bài</button>
        <a href="<?= BASE_URL ?>/articles" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php require_once VIEW_DIR . '/layouts/footer.php'; ?>