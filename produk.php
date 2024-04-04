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
            max-width: 1200px; /* Lebar maksimum kontainer */
            margin: 0 auto; 
        }
        .box {
            padding: 15px;
            border: 1px solid;
            background-color:white;
            color: black; 
            box-sizing: border-box;
            margin: 10px 0 25px 0;
            overflow-x: auto; /* Membuat tabel dapat digulir horizontal jika terlalu lebar */
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Tetapkan lebar kolom tetap */
        }
        .table th,
        .table td {
            padding: 10px; /* Penyesuaian padding agar lebih luas */
            word-wrap: break-word; /* Pemecahan kata jika konten terlalu panjang */
        }
        .table img {
            max-width: 100%; /* Membatasi lebar gambar agar tidak melebihi kolom */
            height: auto; /* Biarkan tinggi gambar disesuaikan secara otomatis */
        }
    </style>
    <div class="section">
        <div class="container">
            <h3> Data Produk</h3>
            <div class="box">
                <p><a href="tambah-produk.php" style="display: block; color: crimson; text-decoration: none; font-family: 'Poppins', sans-serif; text-align: left;">Tambah Produk</a></p>
                <table border ="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $produk = mysqli_query($conn, "SELECT * FROM product LEFT JOIN category USING (category_id) ORDER BY product_id DESC");
                            if(mysqli_num_rows($produk) > 0){
                            while($row = mysqli_fetch_array($produk)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><?php echo $row['product_name'] ?></td>
                            <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                            <td><?php echo $row['product_description'] ?></td>
                            <td><a href="produk/<?php echo $row['product_image'] ?>" target="_blank"><img src="produk/<?php echo $row['product_image'] ?>" width="50px"></a></td>
                            <td><?php echo ($row['product_status'] == 0)? 'Tidak Aktif' : 'Aktif'; ?></td>
                            <td>
                                <a href="edit-produk.php?id=<?php echo $row['product_id'] ?>">Edit</a> || <a href="hapuskategori.php?idp=<?php echo $row['product_id'] ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                            <tr>
                                <td colspan="8">Tidak Ada Data Produk</td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>