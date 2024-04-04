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
            <h3> Data Kategori</h3>
            <div class="box">
                <p><a href="tambahkategori.php" style="display: block; color: crimson; text-decoration: none; font-family: 'Poppins', sans-serif; text-align: left;">Tambah Kategori</a></p>
                <table border ="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $kategori = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id DESC");
                            while($row = mysqli_fetch_array($kategori)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td>
                                <a href="editkategori.php?id=<?php echo $row['category_id'] ?>">Edit</a> || <a href="hapuskategori.php?idk=<?php echo $row['category_id'] ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>