<?php require_once VIEW_DIR . '/layouts/header.php'; ?>

<div class="container">
    <h2>Chỉnh sửa bài viết</h2>
    
    <form action="<?= BASE_URL ?>/articles/update/<?= $article['id'] ?>" method="POST" class="mb-4">
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" 
                   value="<?= htmlspecialchars($article['title']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <?php foreach($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" 
                            <?= $category['id'] == $article['category_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="content" class="form-label">Nội dung</label>
            <textarea class="form-control" id="content" name="content" 
                      rows="10" required><?= htmlspecialchars($article['content']) ?></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="<?= BASE_URL ?>/articles/show/<?= $article['id'] ?>" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php require_once VIEW_DIR . '/layouts/header.php'; ?>