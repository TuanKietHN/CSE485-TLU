<?php
require_once '../data/flowers.php';
require_once 'helpers/image_helper.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $target_dir = "../images/";
    $allowed_types = array("jpg", "jpeg", "png", "gif", "webp");
    
    // Tìm vị trí của hoa cần sửa
    $index = -1;
    foreach($flowers as $key => $flower) {
        if($flower['id'] == $id) {
            $index = $key;
            break;
        }
    }
    
    if($index !== -1) {
        // Cập nhật thông tin cơ bản
        $flowers[$index]['name'] = $_POST['name'];
        $flowers[$index]['description'] = $_POST['description'];
        
        // Xử lý image 1
        if(!empty($_FILES['image']['name'])) {
            $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
            if(!in_array($file_extension, $allowed_types)) {
                die("Chỉ chấp nhận file ảnh có định dạng: " . implode(", ", $allowed_types));
            }
            
            $next_number = getNextImageNumber($target_dir);
            $new_filename = $next_number . "." . $file_extension;
            $target_file = $target_dir . $new_filename;
            
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Xóa ảnh cũ
                $old_image = "../" . $flowers[$index]['image'];
                if(file_exists($old_image)) {
                    unlink($old_image);
                }
                $flowers[$index]['image'] = 'images/' . $new_filename;
            }
        }
        
        // Xử lý image 2
        if(!empty($_FILES['image2']['name'])) {
            $file_extension2 = strtolower(pathinfo($_FILES["image2"]["name"], PATHINFO_EXTENSION));
            if(!in_array($file_extension2, $allowed_types)) {
                die("Chỉ chấp nhận file ảnh có định dạng: " . implode(", ", $allowed_types));
            }
            
            $next_number2 = getNextImageNumber($target_dir);
            $new_filename2 = $next_number2 . "." . $file_extension2;
            $target_file2 = $target_dir . $new_filename2;
            
            if(move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file2)) {
                // Xóa ảnh cũ
                $old_image2 = "../" . $flowers[$index]['image2'];
                if(file_exists($old_image2)) {
                    unlink($old_image2);
                }
                $flowers[$index]['image2'] = 'images/' . $new_filename2;
            }
        }
        
        // Lưu vào file
        file_put_contents('../data/flowers.php', '<?php $flowers = ' . var_export($flowers, true) . ';');
    }
    
    header("Location: index.php");
    exit();
} 