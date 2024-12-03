<?php require_once 'app/views/layouts/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thông tin tài khoản</h5>
                    <p class="card-text">
                        <strong>Tên đăng nhập:</strong> <?= htmlspecialchars($member['username']) ?><br>
                        <strong>Email:</strong> <?= htmlspecialchars($member['email']) ?><br>
                        <strong>Ngày tham gia:</strong> <?= date('d/m/Y', strtotime($member['created_at'])) ?>
                    </p>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" 
                            data-bs-target="#editProfileModal">
                        <i class="fas fa-edit"></i> Sửa thông tin
                    </button>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <h3>Bài viết của tôi</h3>
            <?php if (!empty($articles)): ?>
                <?php foreach($articles as $article): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($article['title']) ?></h5>
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="fas fa-folder"></i> <?= htmlspecialchars($article['category_name']) ?>
                                    <span class="mx-2">|</span>
                                    <i class="fas fa-clock"></i> 
                                    <?= date('d/m/Y H:i', strtotime($article['created_at'])) ?>
                                </small>
                            </p>
                            <a href="/articles/show/<?= $article['id'] ?>" class="btn btn-primary btn-sm">
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Bạn chưa có bài viết nào.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Sửa thông tin -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sửa thông tin tài khoản</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/members/update" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= htmlspecialchars($member['email']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Mật khẩu mới (để trống nếu không đổi)</label>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                    </div>
                    
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                        <input type="password" class="form-control" id="current_password" 
                               name="current_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'app/views/layouts/footer.php'; ?>