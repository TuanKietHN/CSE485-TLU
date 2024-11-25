<?php
require_once '../data/flowers.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Tìm và xóa hoa
    foreach($flowers as $key => $flower) {
        if($flower['id'] == $id) {
            // Xóa ảnh 1
            $image_path = "../" . $flower['image'];
            if(file_exists($image_path)) {
                unlink($image_path);
            }
            
            // Xóa ảnh 2
            $image_path2 = "../" . $flower['image2'];
            if(file_exists($image_path2)) {
                unlink($image_path2);
            }
            
            // Xóa khỏi mảng
            unset($flowers[$key]);
            break;
        }
    }
    
    // Reindex array
    $flowers = array_values($flowers);
    
    // Lưu vào file
    file_put_contents('../data/flowers.php', '<?php $flowers = ' . var_export($flowers, true) . ';');
}

header("Location: index.php");
exit(); 