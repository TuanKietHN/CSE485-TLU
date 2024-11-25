<?php
function uploadImage($file) {
    $target_dir = "../images/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $newFileName = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $newFileName;

    // Kiểm tra định dạng
    if(!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        return false;
    }

    // Kiểm tra kích thước (2MB)
    if ($file["size"] > 2 * 1024 * 1024) {
        return false;
    }

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return "images/" . $newFileName;
    }
    return false;
}
?> 