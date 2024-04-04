<?php

@include 'config.php';

session_start();
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
            max-width: 800px;
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
        .input-control {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        .input-control:last-child {
            margin-bottom: 20px;
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
            <h3> Tambah Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">--Pilih Kategori--</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                        <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input_control" placeholder="Nama Produk" required>
                    <input type="text" name="harga" class="input_control" placeholder="Harga" required>
                    <input type="file" name="gambar" class="input_control" required>
                    <textarea class="input_control" name="deskripsi" placeholder="Deskripsi"></textarea><br>
                    <select class="input-control" name="status"><br>
                        <option value="">--Pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="submit" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        $kategori = $_POST['kategori'];
                        $nama = $_POST['nama'];
                        $harga = $_POST['harga'];
                        $deskripsi = $_POST['deskripsi'];
                        $status = $_POST['status'];

                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'produk'.time().'.'.$type2;

                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                        if(!in_array($type2, $tipe_diizinkan)){

                            echo '<script>alert("")Format file tidak diizinkan</script>';

                        }else{

                            move_uploaded_file($tmp_name, './produk/'.$newname);

                            $insert = mysqli_query($conn, "INSERT INTO product VALUES (
                                        null,
                                        '".$kategori."',
                                        '".$nama."',
                                        '".$harga."',
                                        '".$deskripsi."',
                                        '".$newname."',
                                        '".$status."',
                                        null
                                            ) ");

                            if($insert){
                                echo '<script>alert("Tambah Data Telah Berhasil")</script>';
                                echo '<script>window.location="produk.php"</script>';
                            }else{
                                echo 'gagal'.mysqli_error($conn);
                            }

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