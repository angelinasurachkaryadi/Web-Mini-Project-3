<?php

@include 'config.php';

if(isset($_GET['product_name'])) {
    $product_name = mysqli_real_escape_string($conn, $_GET['product_name']);
    
    // Lakukan query untuk mendapatkan detail produk berdasarkan nama produk
    $produk = "SELECT * FROM product WHERE product_name = '$product_name'";
    $result = mysqli_query($conn, $produk);

    // Periksa apakah hasil query mengembalikan baris data
    if(mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        // Jika tidak ada hasil, arahkan kembali ke halaman produk
        header("Location: cari-produk.php");
        exit();
    }
} else {
    // Jika parameter product_name tidak ada, arahkan kembali ke halaman produk
    header("Location: cari-produk.php");
    exit();
}

// Fungsi untuk menambahkan produk ke wishlist
if(isset($_POST['add_to_whislist'])) {
    // Simpan data produk ke dalam session atau database wishlist
    session_start();
    $_SESSION['whislist'][] = $data['product_id']; // Simpan product_id ke dalam session wishlist

    // Redirect ke halaman wishlist.php
    header("Location: whislist.php");
    exit();
}

// Fungsi untuk menambahkan produk ke wishlist
if(isset($_POST['checkout'])) {
    // Simpan data produk ke dalam session atau database wishlist
    session_start();
    $_SESSION['checkout'][] = $data['product_id']; // Simpan product_id ke dalam session wishlist

    // Redirect ke halaman wishlist.php
    header("Location: checkout.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Parfum</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/user-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<?php require "navbar_user.php"; ?> 

<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-4">
                <img src="produk/<?php echo $data['product_image']; ?>" class="w-100" alt="">
            </div>
            <div class="col-lg-6 offset-lg-1">
                <h1><?php echo $data['product_name']; ?></h1>
                <p class="fs-5">
                    <?php echo $data['product_description']; ?>
                </p>
                <p class="fs-3 warna2">
                    Rp <?php echo $data['product_price']; ?>
                </p>

                <!-- Form untuk menambahkan produk ke wishlist -->
                <form method="post" action="">
                    <button type="submit" class="btn btn-primary" name="add_to_whislist">
                        <i class="fas fa-heart"></i> Tambahkan ke Wishlist
                    </button>
                </form>
                <br>

                <form method="post" action="checkout.php">
                    <input type="hidden" name="product_id" value="<?php echo $data['product_id']; ?>">
                    <button type="submit" class="btn btn-success" name="checkout">
                        <i class="fas fa-shopping-cart"></i> Checkout
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
    
</body>
</html> 
