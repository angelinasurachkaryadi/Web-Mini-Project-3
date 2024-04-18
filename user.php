<?php

@include 'config.php';
$produk = mysqli_query($conn, "SELECT * FROM product ORDER BY product_id DESC LIMIT 6");
if(mysqli_num_rows($produk) > 0)

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Parfum</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/user-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

    <?php require "navbar_user.php"; ?>

    <div class="container-fluid banner d-flex align-items-center">
        <div class="container  text-center text-white">
            <h1>Selamat Datang!</h1>
            <h3>Cari Parfum Apa?</h3>
            <form method="get" action="cari-produk.php">
                <div class="input-group input-group-lg my-4">
                    <input type="text" class="form-control" placeholder="Nama Produk" aria-label="Recipent's username" aria-describedby="basic-addon2" name="keyword">
                    <button type="submit" class="btn warna1">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid warna1 py-5">
        <div class="container text-center">
            <h3>Kategori</h3>

            <div class="row mt-5">
                <div class="col-md-4 my-4">
                    <div class="highlighted-kategori kategori-mykonos d-flex justify-content-center align-items-center"></div>
                        <h4 class="text-white"><a class="no-decoration" href="cari-produk.php?kategori=mykonos">mykonos</a></h4>
                </div>
                <div class="col-md-4 my-4">
                    <div class="highlighted-kategori kategori-saffnco"></div>
                        <h4 class="text-white"><a class="no-decoration" href="cari-produk.php?kategori=saffnco">saff n co</a></h4>
                </div>
                <div class="col-md-4 my-4">
                    <div class="highlighted-kategori kategori-kitschy"></div>
                        <h4 class="text-white"><a class="no-decoration" href="cari-produk.php?kategori=kitschy">kitschy</a></h4>
                </div>
                <div class="col-md-4 my-4">
                    <div class="highlighted-kategori kategori-onix"></div>
                        <h4 class="text-white"><a class="no-decoration" href="cari-produk.php?kategori=onix">onix</a></h4>
                </div>
                <div class="col-md-4 my-4">
                    <div class="highlighted-kategori kategori-vs"></div>
                        <h4 class="text-white"><a class="no-decoration" href="cari-produk.php?kategori=vs">victoria secret</a></h4>
                </div>
                <div class="col-md-4 my-4">
                    <div class="highlighted-kategori kategori-zara"></div>
                        <h4 class="text-white"><a class="no-decoration" href="cari-produk.php?kategori=zara">zara</a></h4>
                </div>
            </div>

        </div>
    </div>

    <div class="container-fluid warna3 py-5">
        <div class="container text-center">
        <h3>Tantang Kami</h3>
            <p class="fs-5 mt-3">
                Menyajikan rangkaian produk-produk brand parfum yang lagi viral dan terbaik<br>
                dengan informasi detail produk yang jelas dan lengkap seperti spl parfum,ketahanan,dan varian.<br>
                sehingga pelanggan dapat membuat keputusan pembelian yang tepat sesuai dengan preferensi serta kebutuhan<br>

            </p>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>

            <div class="row mt-5">
                <?php while($data = mysqli_fetch_array($produk)){ ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="image-box">
                            <img src="produk/<?php echo $data['product_image']; ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $data['product_name']; ?></h4>
                            <p class="card-text text-truncate"><?php echo substr($data['product_description'], 0, 100); ?>...</p>
                            <p class="card-text ">Rp<?php echo $data['product_price']; ?></p>
                            <a href="produk-detail.php?nama=<?php echo $data['product_name']; ?>" class="btn warna4">Lihat Details</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <a class="btn btn-outline-primary mt-3 p-3 fs-3" href="cari-produk.php">See More</a>
        </div>  
    </div>




    


</body>
</html>