<!DOCTYPE html>
<html>
<head>
    <title>Quản trị tin tức</title>
    
</head>
<body>
    <div class="admin-container">
        <h1>Quản lý tin tức</h1>
        <a href="<?php echo BASE_URL; ?>/admin/addNews" class="btn">Thêm tin mới</a>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Danh mục</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
            <?php foreach($news as $item): ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['title']; ?></td>
                <td><?php echo $item['category_name']; ?></td>
                <td><?php echo $item['created_at']; ?></td>
                <td>
                    <a href="<?php echo BASE_URL; ?>/admin/editNews/<?php echo $item['id']; ?>">Sửa</a>
                    <a href="<?php echo BASE_URL; ?>/admin/deleteNews/<?php echo $item['id']; ?>" 
                       onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
