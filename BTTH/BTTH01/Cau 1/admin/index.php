<?php 
include '../header.php';
require_once '../data/flowers.php';
?>

<h1 class="mb-4">Quản lý Hoa</h1>
<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="add.php" class="btn btn-success">
        <i class="fas fa-plus-circle"></i> Thêm hoa mới
    </a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ảnh 1</th>
            <th>Ảnh 2</th>
            <th>Tên hoa</th>
            <th>Mô tả</th>
            <th style="width: 100px;">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($flowers as $flower): ?>
        <tr>
            <td><?php echo $flower['id']; ?></td>
            <td><img src="../<?php echo $flower['image']; ?>" width="100" alt="Ảnh 1"></td>
            <td><img src="../<?php echo $flower['image2']; ?>" width="100" alt="Ảnh 2"></td>
            <td><?php echo $flower['name']; ?></td>
            <td><?php echo $flower['description']; ?></td>
            <td>
                <div class="row g-1">
                    <div class="col-6">
                        <a href="edit.php?id=<?php echo $flower['id']; ?>" class="btn btn-warning btn-sm w-100">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-danger btn-sm w-100" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal" 
                                data-id="<?php echo $flower['id']; ?>"
                                data-name="<?php echo $flower['name']; ?>">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal Xác nhận xóa -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa hoa "<span id="flowerName"></span>"?
            </div>
            <div class="modal-footer">
                <a href="#" id="confirmDelete" class="btn btn-danger">Xóa</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        
        document.getElementById('flowerName').textContent = name;
        document.getElementById('confirmDelete').href = 'delete.php?id=' + id;
    });
});
</script>

<?php include '../footer.php'; ?> 