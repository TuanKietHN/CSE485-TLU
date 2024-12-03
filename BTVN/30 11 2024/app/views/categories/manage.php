<?php require_once VIEW_DIR . '/layouts/header.php'; ?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Quản lý danh mục</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-plus"></i> Thêm danh mục
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Số bài viết</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($categories as $category): ?>
                            <tr>
                                <td><?= $category['id'] ?></td>
                                <td>
                                    <span class="category-name" data-id="<?= $category['id'] ?>">
                                        <?= htmlspecialchars($category['name']) ?>
                                    </span>
                                    <form class="edit-form d-none" data-id="<?= $category['id'] ?>">
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm" 
                                                   value="<?= htmlspecialchars($category['name']) ?>">
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-sm cancel-edit">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <?= $category['article_count'] ?> bài viết
                                    </span>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($category['created_at'])) ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm edit-category" 
                                            data-id="<?= $category['id'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <?php if ($category['article_count'] == 0): ?>
                                        <button type="button" class="btn btn-danger btn-sm" 
                                                onclick="confirmDelete(<?= $category['id'] ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-danger btn-sm" disabled 
                                                title="Không thể xóa danh mục đang có bài viết">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Thêm danh mục -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm danh mục mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= BASE_URL ?>/categories/create" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Xác nhận xóa danh mục
function confirmDelete(id) {
    if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
        window.location.href = '<?= BASE_URL ?>/categories/delete/' + id;
    }
}

// Xử lý chỉnh sửa danh mục
document.addEventListener('DOMContentLoaded', function() {
    // Bật form chỉnh sửa
    document.querySelectorAll('.edit-category').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const nameSpan = document.querySelector(`.category-name[data-id="${id}"]`);
            const editForm = document.querySelector(`.edit-form[data-id="${id}"]`);
            
            nameSpan.classList.add('d-none');
            editForm.classList.remove('d-none');
        });
    });
    
    // Hủy chỉnh sửa
    document.querySelectorAll('.cancel-edit').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.edit-form');
            const id = form.dataset.id;
            const nameSpan = document.querySelector(`.category-name[data-id="${id}"]`);
            
            form.classList.add('d-none');
            nameSpan.classList.remove('d-none');
        });
    });
    
    // Xử lý submit form chỉnh sửa
    document.querySelectorAll('.edit-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const id = this.dataset.id;
            const newName = this.querySelector('input').value;
            
            fetch('<?= BASE_URL ?>/categories/update/' + id, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'name=' + encodeURIComponent(newName)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const nameSpan = document.querySelector(`.category-name[data-id="${id}"]`);
                    nameSpan.textContent = newName;
                    this.classList.add('d-none');
                    nameSpan.classList.remove('d-none');
                } else {
                    alert('Có lỗi xảy ra khi cập nhật danh mục');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi cập nhật danh mục');
            });
        });
    });
});
</script>

<?php require_once VIEW_DIR . '/layouts/footer.php'; ?>