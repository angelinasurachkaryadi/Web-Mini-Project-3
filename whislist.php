<?php
session_start();

// Include your config file here
@include 'config.php';

// Initialize an empty array for wishlist items
$wishlist_items = [];

// Check if wishlist session variable is set and not empty
if(isset($_SESSION['whislist']) && !empty($_SESSION['whislist'])) {
    // Fetch wishlist items from session variable
    $wishlist_items = $_SESSION['whislist'];

    // Handle removing item from wishlist
    if(isset($_POST['remove_from_wishlist'])) {
        $remove_product_id = $_POST['remove_from_wishlist'];
        $key = array_search($remove_product_id, $wishlist_items); // Find the key of the product_id in the wishlist array
        if($key !== false) {
            unset($wishlist_items[$key]); // Remove the item from wishlist array
            $_SESSION['whislist'] = $wishlist_items; // Update the wishlist session variable
            // Redirect back to wishlist.php after removing item
            header("Location: cari-produk.php");
            exit();
        } else {
            echo "Product not found in wishlist.";
        }
    }

    // Query the database to get details of wishlist items
    // For simplicity, let's assume your product table is named 'product'
    // You might need to modify the query to match your database structure
    if(!empty($wishlist_items)) {
        $wishlist_product_ids = implode(',', $wishlist_items);
        $query = "SELECT * FROM product WHERE product_id IN ($wishlist_product_ids)";
        $result = mysqli_query($conn, $query);

        // Fetch the wishlist items' details
        $wishlist_products = [];
        while($row = mysqli_fetch_assoc($result)) {
            $wishlist_products[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/user-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<?php require "navbar_user.php"; ?> 

<div class="container-fluid py-5">
    <div class="container">
        <h1 class="text-center mb-3">Wishlist</h1>
        <br>
        <br>
        <div class="row">
            <?php if(isset($wishlist_products) && !empty($wishlist_products)): ?>
                <?php foreach($wishlist_products as $product): ?>
                <div class="col-md-5 mb-5">
                    <div class="card">
                        <img src="produk/<?php echo $product['product_image']; ?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                            <p class="card-text"><?php echo $product['product_description']; ?></p>
                            <p class="card-text">Rp <?php echo $product['product_price']; ?></p>
                            <form method="post" action="">
                                <input type="hidden" name="remove_from_wishlist" value="<?php echo $product['product_id']; ?>">
                                <button type="submit" class="btn warna3" name="remove_item">Hapus dari Wishlist</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col">
                    <p>Wishlist Anda kosong.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
    
</body>
</html>




