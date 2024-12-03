<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Sửa tin tức</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input type="text" name="title" class="form-control" value="<?php echo $news['title']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nội dung</label>
                <textarea name="content" class="form-control" rows="10" required><?php echo $news['content']; ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Ảnh hiện tại</label>
                <img src="/tlunews/<?php echo $news['image']; ?>" width="200">
                <input type="hidden" name="current_image" value="<?php echo $news['image']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Thay đổi ảnh</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select name="category_id" class="form-control" required>
                    <?php foreach($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>" 
                                <?php echo ($category['id'] == $news['category_id']) ? 'selected' : ''; ?>>
                            <?php echo $category['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="/tlu/tlunews/admin" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
