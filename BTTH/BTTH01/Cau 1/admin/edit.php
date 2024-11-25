<?php 
include '../header.php';
require_once '../data/flowers.php';

$id = $_GET['id'];
$flower = null;
foreach($flowers as $f) {
    if($f['id'] == $id) {
        $flower = $f;
        break;
    }
}

if(!$flower) {
    header("Location: index.php");
    exit();
}
?>

<h1 class="mb-4">Sửa Thông Tin Hoa</h1>

<form action="process_edit.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $flower['id']; ?>">
    
    <div class="mb-3">
        <label class="form-label">Tên hoa</label>
        <input type="text" class="form-control" name="name" value="<?php echo $flower['name']; ?>" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea class="form-control" name="description" rows="3" required><?php echo $flower['description']; ?></textarea>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Hình ảnh 1 hiện tại</label>
        <img src="../<?php echo $flower['image']; ?>" id="preview1" width="200">
        <input type="file" class="form-control mt-2" name="image" id="image1" accept="image/*">
        <small class="text-muted">Chỉ chọn ảnh nếu muốn thay đổi</small>
    </div>

    <div class="mb-3">
        <label class="form-label">Hình ảnh 2 hiện tại</label>
        <img src="../<?php echo $flower['image2']; ?>" id="preview2" width="200">
        <input type="file" class="form-control mt-2" name="image2" id="image2" accept="image/*">
        <small class="text-muted">Chỉ chọn ảnh nếu muốn thay đổi</small>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
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