<?php

@include 'config.php';

session_start();

// Inisialisasi variabel error untuk pesan kesalahan login
$login_error = '';

if(isset($_POST['submit'])){

   // Memeriksa apakah kunci 'name' ada dalam array $_POST sebelum mengaksesnya
   $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
   // Memeriksa apakah kunci 'email' ada dalam array $_POST sebelum mengaksesnya
   $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
   // Memeriksa apakah kunci 'password' ada dalam array $_POST sebelum mengaksesnya
   $pass = isset($_POST['password']) ? $_POST['password'] : '';
   // Memeriksa apakah kunci 'cpassword' ada dalam array $_POST sebelum mengaksesnya
   $cpass = isset($_POST['cpassword']) ? $_POST['cpassword'] : '';
   // Memeriksa apakah kunci 'user_type' ada dalam array $_POST sebelum mengaksesnya
   $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : '';

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user.php');

      }
     
   }else{
      // Atur pesan kesalahan untuk login yang gagal
      $login_error = 'Email atau password Anda salah!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Login</h3>
      <?php
      // Tampilkan pesan kesalahan jika login gagal
      if(!empty($login_error)){
         echo '<span class="error-msg">'.$login_error.'</span>';
      };
      ?>
      <input type="email" name="email" required placeholder="Masukkan email">
      <input type="password" name="password" required placeholder="Masukkan password">
      <input type="submit" name="submit" value="Login Sekarang" class="form-btn">
      <p>Belum punya akun? <a href="registrasi.php">Registrasi Sekarang</a></p>
   </form>

</div>

</body>
</html>