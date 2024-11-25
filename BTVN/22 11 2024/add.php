<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('data/products.json'), true);
    
    // Tìm ID lớn nhất hiện tại
    $maxId = 0;
    foreach($data['products'] as $product) {
        if($product['id'] > $maxId) {
            $maxId = $product['id'];
        }
    }
    
    // Thêm sản phẩm mới
    $newProduct = [
        'id' => $maxId + 1,
        'name' => $_POST['name'],
        'price' => (int)$_POST['price']
    ];
    
    $data['products'][] = $newProduct;
    
    // Lưu lại vào file
    file_put_contents('data/products.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
    header("Location: index.php");
}
?> 