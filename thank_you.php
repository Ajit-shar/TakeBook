<?php
session_start();
include 'config.php';

// Check if order_id is set in the query string
if (!isset($_GET['order_id'])) {
    header('Location: home.php');
    exit();
}

$order_id = $_GET['order_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="css/thank_you_style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="thank_you">
            <h1>Thank You!</h1>
            <p>Your order has been placed successfully.</p>
            <p>Your Order ID is: <?php echo htmlspecialchars($order_id); ?></p>
            <p>We appreciate your business and hope you enjoy your products.</p>
            <a href="home.php" class="btn">Continue Shopping</a>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>