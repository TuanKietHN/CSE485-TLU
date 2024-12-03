<!DOCTYPE html>
<html>
<head>
    <title><?php echo $news['title']; ?></title>
</head>
<body>
    <article>
        <h1><?php echo $news['title']; ?></h1>
        <img src="<?php echo BASE_URL; ?>/<?php echo $news['image']; ?>" alt="">
        <div class="meta">
            Danh mục: <?php echo $news['category_name']; ?> |
            Ngày đăng: <?php echo $news['created_at']; ?>
        </div>
        <div class="content">
            <?php echo $news['content']; ?>
        </div>
    </article>
</body>
</html>
