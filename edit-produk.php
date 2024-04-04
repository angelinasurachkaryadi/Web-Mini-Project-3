<?php

@include 'config.php';

session_start();

$produk = mysqli_query($conn, "SELECT * FROM product WHERE product_id = '".$_GET['id']."' ");
$p = mysqli_fetch_object($produk);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

</head>

<body>
    <?php require "navbar.php"; ?>

    <style>
    .section {
        padding: 25px 0;
        background-color: paleturquoise;
        color: black;
        text-align: center;
    }
    .container {
        max-width: 1000px; /* Ubah nilai max-width sesuai kebutuhan Anda */
        margin: 0 auto;
        text-align: left;
    }
    .box {
        padding: 20px;
        border: 1px solid #ccc;
        background-color: white;
        color: black;
        box-sizing: border-box;
        margin-top: 20px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
    }
    .form-group img {
        display: block;
        margin-bottom: 10px;
    }
    .form-group input[type="file"] {
        margin-top: 5px;
    }
    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group input[type="email"],
    .form-group select,
    .form-group textarea {
        width: calc(100% - 10px); /* Menjadikan lebar input lebih panjang */
        padding: 10px;
        margin-top: 5px;
    }
    .btn {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        width: 100%;
    }
    .btn:hover {
        background-color: #45a049;
    }
</style>


    <div class="section">
        <div class="container">
            <h3> Edit Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">--Pilih Kategori--</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id)? 'selected':''; ?>><?php echo $r['category_name'] ?></option>
                        <?php } ?>
                    </select>
                    <br>
                    <br>
                    <input type="text" name="nama" class="input_control" placeholder="Nama Produk" value="<?php echo $p->product_name ?>" required>
                    <br>
                    <br>
                    <input type="text" name="harga" class="input_control" placeholder="Harga" value="<?php echo $p->product_price ?>" required>
                    <br>
                    <br>
                    <img src="produk/<?php echo $p->product_image ?>" width="100px">
                    <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                    <input type="file" name="gambar" class="input_control">
                    <br>
                    <br>
                    <textarea class="input_control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->product_description ?></textarea><br>
                    <select class="input-control" name="status"><br>
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo ($p->product_status == 1)? 'selected':''; ?>>Aktif</option>
                        <option value="0" <?php echo ($p->product_status == 0)? 'selected':''; ?>>Tidak Aktif</option>
                    </select>
                    <br>
                    <br>
                    <input type="submit" name="submit" value="submit" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        $kategori   = $_POST['kategori'];
                        $nama       = $_POST['nama'];
                        $harga      = $_POST['harga'];
                        $deskripsi  = $_POST['deskripsi'];
                        $status     = $_POST['status'];
                        $foto       = $_POST['foto'];

                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        if($filename != ''){
                            $type1 = explode('.', $filename);
                            $type2 = $type1[1];

                            $newname = 'produk'.time().'.'.$type2;

                            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                            if(!in_array($type2, $tipe_diizinkan)){

                                echo '<script>alert("")Format file tidak diizinkan</script>';
    
                            }else{
                                unlink('./produk/'.$foto);
                                move_uploaded_file($tmp_name, './produk/'.$newname);
                                $namagambar = $newname;

                            }

                        }else{

                            $namagambar = $foto;

                        }

                        $update = mysqli_query($conn, "UPDATE product SET 
                                                category_id = '".$kategori."',
                                                product_name = '".$nama."',
                                                product_price = '".$harga."',
                                                product_description = '".$deskripsi."',
                                                product_image = '".$namagambar."', 
                                                product_status = '".$status."'
                                                WHERE  product_id = '".$p->product_id."' ");

                        if($update){
                            echo '<script>alert("Edit Data Telah Berhasil")</script>';
                            echo '<script>window.location="produk.php"</script>';

                        }else{
                            echo 'Mohon Maaf!Tidak Berhasil '.mysqli_error($conn);
                        }
                        
                        
                    }
                ?>
            </div>
        </div>
    </div>

    <script>
        CKEDITOR.replace(  'deskripsi' );
    </script>
</body>
</html>