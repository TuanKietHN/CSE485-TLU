<?php
require_once '../data/flowers.php';
require_once 'helpers/image_helper.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "../images/";
    $allowed_types = array("jpg", "jpeg", "png", "gif", "webp");
    
    // Kiểm tra xem cả 2 file có được upload không
    if(empty($_FILES["image"]["name"]) || empty($_FILES["image2"]["name"])) {
        die("Vui lòng chọn đầy đủ cả 2 ảnh!");
    }
    
    // Xử lý image 1
    $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    if(!in_array($file_extension, $allowed_types)) {
        die("Chỉ chấp nhận file ảnh có định dạng: " . implode(", ", $allowed_types));
    }
    
    // Xử lý image 2
    $file_extension2 = strtolower(pathinfo($_FILES["image2"]["name"], PATHINFO_EXTENSION));
    if(!in_array($file_extension2, $allowed_types)) {
        die("Chỉ chấp nhận file ảnh có định dạng: " . implode(", ", $allowed_types));
    }
    
    // Tạo tên file mới cho image 1
    $next_number = getNextImageNumber($target_dir);
    $new_filename = $next_number . "." . $file_extension;
    $target_file = $target_dir . $new_filename;
    
    // Tạo tên file mới cho image 2
    $next_number2 = $next_number + 1; // Tăng số thứ tự lên 1 để tránh trùng tên
    $new_filename2 = $next_number2 . "." . $file_extension2;
    $target_file2 = $target_dir . $new_filename2;
    
    // Thử upload cả 2 ảnh
    $upload1_success = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $upload2_success = move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file2);
    
    if ($upload1_success && $upload2_success) {
        // Tìm ID lớn nhất hiện tại
        $maxId = 0;
        foreach($flowers as $flower) {
            if($flower['id'] > $maxId) {
                $maxId = $flower['id'];
            }
        }
        
        // Thêm hoa mới vào mảng
        $new_flower = [
            'id' => $maxId + 1,
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'image' => 'images/' . $new_filename,
            'image2' => 'images/' . $new_filename2
        ];
        
        $flowers[] = $new_flower;
        
        // Lưu vào file
        file_put_contents('../data/flowers.php', '<?php $flowers = ' . var_export($flowers, true) . ';');
        
        header("Location: index.php");
        exit();
    } else {
        // Nếu upload thất bại, xóa file đã upload thành công (nếu có)
        if($upload1_success && file_exists($target_file)) {
            unlink($target_file);
        }
        if($upload2_success && file_exists($target_file2)) {
            unlink($target_file2);
        }
        die("Có lỗi xảy ra khi upload ảnh!");
    }
} 