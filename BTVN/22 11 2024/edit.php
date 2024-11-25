<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('data/products.json'), true);
    
    $id = (int)$_POST['id'];
    $name = $_POST['name'];
    $price = (int)$_POST['price'];
    
    // Cập nhật sản phẩm
    foreach($data['products'] as &$product) {
        if($product['id'] === $id) {
            $product['name'] = $name;
            $product['price'] = $price;
            break;
        }
    }
    
    // Lưu lại vào file
    file_put_contents('data/products.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
    header("Location: index.php");
}
?> 