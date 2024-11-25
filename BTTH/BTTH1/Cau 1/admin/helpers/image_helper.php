<?php
function getNextImageNumber($target_dir) {
    $highest_number = 0;
    
    // Quét thư mục images
    $files = glob($target_dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
    
    foreach($files as $file) {
        // Lấy tên file không có extension
        $filename = pathinfo($file, PATHINFO_FILENAME);
        if(is_numeric($filename) && intval($filename) > $highest_number) {
            $highest_number = intval($filename);
        }
    }
    
    return $highest_number + 1;
} 