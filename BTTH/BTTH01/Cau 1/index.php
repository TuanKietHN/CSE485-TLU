<?php 
include 'headerHome.php';
require_once 'data/flowers.php';
?>

<h1 class="text-center mb-4">14 loại hoa tuyệt đẹp thích hợp trồng để khoe hương sắc dịp xuân hè</h1>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-3"></div> 
        <div class="col-6"> 
            <?php foreach ($flowers as $flower): ?>
            <div class="card mb-12">
                
                <div class="card-body">
                    <h5 class="card-title"><?php echo $flower['name']; ?></h5>
                    <p class="card-text"><?php echo $flower['description']; ?></p>
                    <img src="<?php echo $flower['image']; ?>" class="card-img" alt="<?php echo $flower['name']; ?>">
                    <img src="<?php echo $flower['image2']; ?>" class="card-img mt-3" alt="<?php echo $flower['name']; ?>">
                </div>
                
            </div>
            <?php endforeach; ?>
        </div>
        <div class="col-3"></div> 
    </div>
</div>



<?php include 'footer.php'; ?>