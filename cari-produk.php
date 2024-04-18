<?php

@include 'config.php';

$kategori = mysqli_query($conn, "SELECT * FROM category");

if (isset($_GET['role'])) {
    if ($_GET['role'] == 'termahal') {
        $produk = mysqli_query($conn, "SELECT * FROM product ORDER BY product_price DESC");
    } elseif ($_GET['role'] == 'termurah') {
        $produk = mysqli_query($conn, "SELECT * FROM product ORDER BY product_price ASC");
    }
} elseif (isset($_GET['order'])) {
    if ($_GET['order'] == 'asc') {
        $produk = mysqli_query($conn, "SELECT * FROM product ORDER BY product_price ASC");
    } elseif ($_GET['order'] == 'desc') {
        $produk = mysqli_query($conn, "SELECT * FROM product ORDER BY product_price DESC");
    }
} else

if(isset($_GET['keyword'])){
    $produk = mysqli_query($conn, "SELECT * FROM product WHERE product_name LIKE '%{$_GET['keyword']}%'");
}

else if(isset($_GET['category'])){
    $k = mysqli_query($conn, "SELECT category_id FROM category WHERE category_name='$_GET[category]'");
    $category_id = mysqli_fetch_array($k);

    $produk = mysqli_query($conn, "SELECT * FROM product WHERE category_id='$category_id[category_id]'");
}

else{
    $produk =  mysqli_query($conn, "SELECT * FROM product");
            
}

$countData = mysqli_num_rows($produk);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/user-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<style>
.banner-produk{
    height: 45vh;
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('img/bg-parfum.jpg');
    background-position: 50% 30%;
}
.image-box{
    height: 250px;
}
.image-box img{
    height: 100%;
    width: 100%;
    object-fit: cover;
    object-position: center;
}
</style>

    <?php require "navbar_user.php"; ?> 

    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Parfum</h1>

        </div> 
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Kategori Brand</h3>
                <ul class="list-group">
                    <?php while($kategori_data = mysqli_fetch_array($kategori)){ ?>
                    <a class="no-decoration" href="cari-produk.php?category=<?php echo $kategori_data['category_name']; ?>">
                        <li class="list-group-item"><?php echo $kategori_data['category_name']; ?></li>
                    </a>
                    <?php } ?>
                </ul>

                <div class="text-center mt-3">
                    <a href="cari-produk.php?role=termurah" class="btn warna1">Produk Termurah</a>
                    <br>
                    <br>
                    <a href="cari-produk.php?role=termahal" class="btn warna2">Produk Termahal</a>
                </div>


            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Parfum</h3>
                <div class="row">
                    <?php
                        if($countData<1){
                    ?>
                        <h4 class="text-center my-5">Parfum yang kamu cari tidak tersedia!</h4>
                    <?php
                        }
                    ?>
                    <?php while($data = mysqli_fetch_array($produk)){?>
                    <div class="col-md-5 mb-5">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="produk/<?php echo $data['product_image']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $data['product_name']; ?></h4>
                                <p class="card-text text-truncate"><?php echo substr($data['product_description'], 0, 100); ?>...</p>
                                <p class="card-text "><?php echo $data['product_price']; ?></p>
                                <a href="produk-detail.php?product_name=<?php echo $data['product_name']; ?>" class="btn warna4">Lihat Details</a>
                             </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>