<?php
session_start();
include 'config.php';

if (isset($_GET['action']) && isset($_GET['id'])) {
    $product_id = $_GET['id'];

    if ($product_id) {
        $sql = "SELECT * FROM product WHERE id = $product_id";
        $result = mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($result);
        $stock = $product['stock']; // Fetch the stock from the database

        if ($_GET['action'] == 'add') {
            if ($product) {
                if (isset($_SESSION['cart'][$product_id])) {
                    if ($_SESSION['cart'][$product_id]['quantity'] < $stock) { // Check stock availability
                        $_SESSION['cart'][$product_id]['quantity'] += 1;
                    }
                } else {
                    if ($stock > 0) { // Ensure stock is available before adding to cart
                        $_SESSION['cart'][$product_id] = [
                            'id' => $product['id'],
                            'name' => $product['name'],
                            'rent_price' => $product['rent_price'],
                            'quantity' => 1,
                            'months' => 1, // Default rental period is 1 month
                            'image' => $product['image'],
                            'stock' => $stock // Store stock information in session
                        ];
                    }
                }
            }
        } elseif ($_GET['action'] == 'remove') {
            if (isset($_SESSION['cart'][$product_id])) {
                if ($_SESSION['cart'][$product_id]['quantity'] > 1) {
                    $_SESSION['cart'][$product_id]['quantity'] -= 1;
                } else {
                    unset($_SESSION['cart'][$product_id]);
                }
            }
        } elseif ($_GET['action'] == 'delete') {
            if (isset($_SESSION['cart'][$product_id])) {
                unset($_SESSION['cart'][$product_id]);
            }
        } elseif ($_GET['action'] == 'update_months' && isset($_GET['months'])) {
            $months = intval($_GET['months']);
            if ($months > 0 && isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['months'] = $months;
            }
        }
    }

    header('Location: cart.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/cart_style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="cart">
            <h1>Your Shopping Cart</h1>
            <div class="cart_items">
                <?php
                if (!empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                        echo '<div class="cart_item">';
                        echo '<div class="cart_image">';
                        echo '<img src="admin/images/' . $item['image'] . '">';
                        echo '</div>';
                        echo '<div class="cart_details">';
                        echo '<h4>' . $item['name'] . '</h4>';
                        echo '<p class="cart_price">NRs.' . $item['rent_price'] . ' per month</p>';
                        echo '<div class="cart_quantity_controls">';
                        echo '<a href="cart.php?action=remove&id=' . $item['id'] . '" class="quantity_btn">-</a>';
                        echo '<span class="cart_quantity">' . $item['quantity'] . '</span>';
                        if ($item['quantity'] < $item['stock']) { // Check stock availability before showing add button
                            echo '<a href="cart.php?action=add&id=' . $item['id'] . '" class="quantity_btn">+</a>';
                        }
                        echo '</div>';
                        echo '<div class="cart_month_controls">';
                        echo '<label for="months_' . $item['id'] . '">Months:</label>';
                        echo '<select id="months_' . $item['id'] . '" class="months_select" data-id="' . $item['id'] . '">';
                        for ($i = 1; $i <= 12; $i++) {
                            $selected = $i == $item['months'] ? 'selected' : '';
                            echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                        }
                        echo '</select>';
                        echo '</div>';
                        echo '<a href="cart.php?action=delete&id=' . $item['id'] . '" class="cart_btn">Remove</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Your cart is empty.</p>';
                    echo '<a href="product.php" class="cart_btn">Continue Shopping</a>';
                }
                ?>
            </div>
            <?php if (!empty($_SESSION['cart'])): ?>
                <div class="cart_total">
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $total += $item['rent_price'] * $item['quantity'] * $item['months'];
                    }
                    echo '<p>Total: NRs.' . $total . '</p>';
                    ?>
                    <a href="checkout.php" class="checkout_btn">Checkout</a>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script src="cart.js"></script>
</body>

</html>