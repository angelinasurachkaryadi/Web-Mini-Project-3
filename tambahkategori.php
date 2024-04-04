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
        }
        .box {
            padding: 15px;
            border: 1px solid;
            background-color:white;
            color: black; 
            box-sizing: border-box;
            margin: 10px 0 25px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table tr {
            height: 30px;
        }
        .table tr td {
            padding: 5px 10px;
        }
    </style>

    <div class="section">
        <div class="container">
            <h3> Tambah Data Kategori</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" required>
                    <input type="submit" name="submit" value="submit" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){

                        $nama = ucwords($_POST['nama']);

                        $insert = mysqli_query($conn, "INSERT INTO category VALUES (
                                            null,
                                            '".$nama."')");
                        if($insert){
                            echo '<script>alert("Tambah Data Telah Berhasil")</script>';
                            echo '<script>window.location="kategori.php"</script>';
                        }else{
                            echo 'gagal' .mysqli_error($conn);
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>