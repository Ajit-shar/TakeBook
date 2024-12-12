<?php
session_start();
include 'config.php';

// Check user login
if (strlen($_SESSION['USER_LOGIN']) == 0) {
    header('location:index.php');
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products</title>
        <link rel="stylesheet" href="css/product_style.css">
    </head>

    <body>
        <?php include 'header.php'; ?>
        <main>
            <div class="product">
                <h1>Our Products</h1>
                <div class="product_box">
                    <?php
                    // Fetch unsorted data from the database
                    $sql = "SELECT * FROM product";
                    $result = mysqli_query($conn, $sql);

                    // Store products in an array
                    $products = [];
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $products[] = $row;
                        }
                    }

                    // Merge Sort Implementation
                    function mergeSort($array, $key) {
                        if (count($array) <= 1) {
                            return $array;
                        }

                        $mid = floor(count($array) / 2);
                        $left = array_slice($array, 0, $mid);
                        $right = array_slice($array, $mid);

                        return merge(mergeSort($left, $key), mergeSort($right, $key), $key);
                    }

                    function merge($left, $right, $key) {
                        $sorted = [];
                        while (count($left) > 0 && count($right) > 0) {
                            if ($left[0][$key] <= $right[0][$key]) {
                                $sorted[] = array_shift($left);
                            } else {
                                $sorted[] = array_shift($right);
                            }
                        }

                        return array_merge($sorted, $left, $right);
                    }

                    // Sort products by name
                    $sortedProducts = mergeSort($products, 'name');

                    // Display sorted products
                    foreach ($sortedProducts as $row) {
                        echo '<div class="product_card">';
                        echo '<div class="product_image">';
                        echo '<img src="admin/images/' . $row['image'] . '">';
                        echo '</div>';
                        echo '<div class="product_tag">';
                        echo '<h4>' . $row['name'] . '</h4>';
                        echo '<p class="product_price">NRs.' . $row['rent_price'] . '</p>';
                        echo '<p class="product_stock">Stock: ' . $row['stock'] . '</p>';
                        if ($row['stock'] > 0) {
                            echo '<p class="product_stock">In Stock</p>';
                            echo '<a href="cart.php?id=' . $row['id'] . '" class="product_btn">Add to cart</a>';
                        } else {
                            echo '<p class="product_stock">Out of Stock</p>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </main>

        <?php include 'footer.php'; ?>
    </body>
    <script src="cart.js"></script>

    </html>
    <?php
}
?>
