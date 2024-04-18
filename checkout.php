<?php
session_start();

// Include your config file here
@include 'config.php';

// Check if product_id is set in POST request
if(isset($_POST['product_id'])) {
    // Get product_id from POST request
    $product_id = $_POST['product_id'];

    // Query the database to get details of the selected product
    $query = "SELECT * FROM product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if($result) {
        // Fetch the product details
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Redirect back to product details page or any other appropriate action
    header("Location: produk-detail.php");
    exit(); // Stop further execution of the script
}

// Handle form submission for checkout
if(isset($_POST['submit_checkout'])) {
    // Retrieve and sanitize user input for delivery and payment information
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

    // You can perform further validation of the user input here

    // Now, you can proceed to process the order, update the database, send confirmation emails, etc.
    // For the sake of simplicity, let's assume the order processing here is successful
    $order_success = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/user-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<?php require "navbar_user.php"; ?> 

<div class="container-fluid py-5">
    <div class="container">
        <h1 class="text-center mb-3">Checkout</h1>
        <br>
        <br>
        <div class="row">
            <?php if(isset($product)): ?>
                <div class="col-md-5 mb-5">
                    <div class="card">
                        <img src="produk/<?php echo $product['product_image']; ?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                            <p class="card-text"><?php echo $product['product_description']; ?></p>
                            <p class="card-text">Rp <?php echo $product['product_price']; ?></p>
                            <!-- Add any additional checkout details here -->
                        </div>
                    </div>
                </div>
                <div class="col-md-7 mb-5">
                    <h3>Informasi Pengiriman dan Pembayaran</h3>
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Pengiriman</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="bank_transfer">Transfer Bank</option>
                                <option value="credit_card">Kartu Kredit</option>
                                <option value="cash">Cash</option>
                                <!-- Add more payment methods if needed -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit_checkout">Checkout</button>
                    </form>
                    <?php if(isset($order_success) && $order_success): ?>
                        <p class="mt-3 alert alert-success">Terima kasih sudah berbelanja di sini!</p>
                        <a href="user.php" class="btn btn-primary">Kembali ke Halaman Utama</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="col">
                    <p>Produk tidak ditemukan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
    
</body>
</html>
















