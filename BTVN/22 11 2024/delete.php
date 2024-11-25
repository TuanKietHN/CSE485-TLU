<?php
if (isset($_GET['id'])) {
    $data = json_decode(file_get_contents('data/products.json'), true);
    $id = (int)$_GET['id'];
    
    // Lọc ra các sản phẩm không bị xóa
    $data['products'] = array_filter($data['products'], function($product) use ($id) {
        return $product['id'] !== $id;
    });
    
    // Lưu lại vào file
    file_put_contents('data/products.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
    header("Location: index.php");
}
?> 