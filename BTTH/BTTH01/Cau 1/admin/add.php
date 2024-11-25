<?php 
include '../header.php';
?>

<h1 class="mb-4">Thêm Hoa Mới</h1>

<form action="process_add.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Tên hoa</label>
        <input type="text" class="form-control" name="name" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea class="form-control" name="description" rows="3" required></textarea>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Hình ảnh 1</label>
        <input type="file" class="form-control" name="image" id="image1" required accept="image/*">
        <div class="mt-2">
            <img id="preview1" src="#" alt="Ảnh xem trước 1" style="max-width: 200px; display: none;">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Hình ảnh 2</label>
        <input type="file" class="form-control" name="image2" id="image2" required accept="image/*">
        <div class="mt-2">
            <img id="preview2" src="#" alt="Ảnh xem trước 2" style="max-width: 200px; display: none;">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Thêm mới</button>
    <a href="index.php" class="btn btn-secondary">Hủy</a>
</form>

<script>
// Hàm xem trước ảnh
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const file = input.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(file);
    }
}

// Gắn sự kiện cho input file
document.getElementById('image1').addEventListener('change', function() {
    previewImage(this, 'preview1');
});

document.getElementById('image2').addEventListener('change', function() {
    previewImage(this, 'preview2');
});
</script>

<?php include '../footer.php'; ?> 