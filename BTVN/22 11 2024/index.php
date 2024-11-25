<?php include 'header.php'; ?>

    <h1 class="mb-4">Danh sách sản phẩm</h1>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fas fa-plus-circle"></i> Thêm mới 
        </a>
    </div>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá thành</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $jsonFile = __DIR__ . '/data/products.json';
            
            if (!file_exists($jsonFile)) {
                die("Không tìm thấy file: " . $jsonFile);
            }

            $jsonContent = file_get_contents($jsonFile);
            if ($jsonContent === false) {
                die("Không thể đọc file");
            }

            $data = json_decode($jsonContent, true);
            
            if (isset($data['products']) && is_array($data['products']) && !empty($data['products'])) {
                foreach($data['products'] as $product) {
                    echo "<tr>";
                    echo "<td>".$product['name']."</td>";
                    echo "<td>".$product['price']." VND</td>";
                    echo "<td>
                            <a href='#' class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editModal' 
                               data-id='".$product['id']."' data-name='".$product['name']."' data-price='".$product['price']."'>
                                <i class='fas fa-edit'></i>
                            </a>
                        </td>";
                    echo "<td>
                            <button type='button' class='btn btn-danger btn-sm' 
                                    data-bs-toggle='modal' 
                                    data-bs-target='#deleteModal' 
                                    data-id='".$product['id']."'
                                    data-name='".$product['name']."'>
                                <i class='fas fa-trash-alt'></i>
                            </button>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>Không có dữ liệu</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm sản phẩm mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="add.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá</label>
                            <input type="number" class="form-control" name="price" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sửa sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="edit.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="name" id="edit_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá</label>
                            <input type="number" class="form-control" name="price" id="edit_price" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editModal = document.getElementById('editModal')
            editModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget
                var id = button.getAttribute('data-id')
                var name = button.getAttribute('data-name')
                var price = button.getAttribute('data-price')
                
                editModal.querySelector('#edit_id').value = id
                editModal.querySelector('#edit_name').value = name
                editModal.querySelector('#edit_price').value = price
            })
        })
    </script>

    <!-- Modal Xác nhận xóa -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa sản phẩm "<span id="productName"></span>"?
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
            
            document.getElementById('productName').textContent = name;
            document.getElementById('confirmDelete').href = 'delete.php?id=' + id;
        });
    });
    </script>

<?php include 'footer.php'; ?>
