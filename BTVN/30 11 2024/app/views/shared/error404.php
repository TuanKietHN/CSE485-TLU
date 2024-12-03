<?php require_once VIEW_DIR . '/layouts/header.php'; ?>

<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8 text-center">
            <div class="error-template">
                <!-- Icon 404 sử dụng SVG -->
                <svg class="mb-4" width="200" height="200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 13H11V7H13M13 17H11V15H13M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2Z" 
                          fill="#dc3545"/>
                </svg>
                
                <!-- Tiêu đề lỗi -->
                <h1 class="display-1 text-danger mb-4">404</h1>
                <h2 class="h3 mb-4">Oops! Trang không tồn tại</h2>
                
                <!-- Thông báo lỗi -->
                <div class="error-details mb-4">
                    Xin lỗi, trang bạn đang tìm kiếm không tồn tại hoặc đã bị di chuyển.
                </div>
                
                <!-- Các gợi ý và liên kết hữu ích -->
                <div class="error-actions">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card bg-light mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Bạn có thể thử:</h5>
                                    <ul class="list-unstyled text-start">
                                        <li><i class="fas fa-check text-success me-2"></i> Kiểm tra lại đường dẫn URL</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Quay lại trang trước</li>
                                        <li><i class="fas fa-check text-success me-2"></i> Truy cập trang chủ</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Các nút điều hướng -->
                    <div class="d-flex justify-content-center gap-3">
                        <a href="javascript:history.back()" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại
                        </a>
                        <a href="<?= BASE_URL ?>" class="btn btn-primary">
                            <i class="fas fa-home me-2"></i>Trang chủ
                        </a>
                        <a href="<?= BASE_URL ?>/contact" class="btn btn-info text-white">
                            <i class="fas fa-envelope me-2"></i>Liên hệ hỗ trợ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bài viết gợi ý -->
    <?php if (!empty($suggestedArticles)): ?>
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="text-center mb-4">Có thể bạn quan tâm</h3>
            <div class="row">
                <?php foreach($suggestedArticles as $article): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <?php if (!empty($article['image'])): ?>
                        <img src="<?= BASE_URL ?>/public/uploads/articles/<?= $article['image'] ?>" 
                             class="card-img-top" alt="<?= htmlspecialchars($article['title']) ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($article['title']) ?></h5>
                            <p class="card-text text-muted">
                                <?= htmlspecialchars(substr($article['content'], 0, 100)) ?>...
                            </p>
                            <a href="<?= BASE_URL ?>/articles/show/<?= $article['id'] ?>" 
                               class="btn btn-outline-primary btn-sm">Đọc thêm</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Thêm CSS tùy chỉnh -->
    <style>
        .error-template {
            padding: 40px 15px;
        }
        
        .error-details {
            font-size: 1.2rem;
            color: #6c757d;
        }
        
        .error-actions {
            margin-top: 15px;
            margin-bottom: 15px;
        }
        
        .error-actions .btn {
            margin-right: 10px;
        }
        
        .card {
            transition: transform 0.2s;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        @media (max-width: 768px) {
            .error-template h1 {
                font-size: 6rem;
            }
            
            .error-actions .btn {
                margin-bottom: 10px;
                width: 100%;
            }
            
            .error-actions .d-flex {
                flex-direction: column;
            }
        }
    </style>
</div>

<?php require_once VIEW_DIR . '/layouts/footer.php'; ?>