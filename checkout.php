<?php
session_start();
include 'config.php';

if (!isset($_SESSION['USER_LOGIN']) || $_SESSION['USER_LOGIN'] != 'yes') {
    header('location:index.php');
    exit();
} else {
    $user_id = $_SESSION['USER_ID'];

    $name = "";
    $contact = "";
    $address = "";
    $total = 0;
    $error = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = trim($_POST['name']);
        $contact = trim($_POST['contact']);
        $address = trim($_POST['address']);
        $total = trim($_POST['total']);
        $payment_method = $_POST['payment_method'];

        if (empty($name)) {
            $error = "Name is required.";
        } elseif (empty($contact)) {
            $error = "Contact is required.";
        } elseif (!preg_match('/^(98|97|96)\d{8}$/', $contact)) {
            $error = "Invalid contact number. It must start with 98, 97, or 96 and be exactly 10 digits.";
        } elseif (empty($address)) {
            $error = "Address is required.";
        } else {
            $conn->autocommit(FALSE); // Start transaction
            $orderSuccess = true;

            foreach ($_SESSION['cart'] as $item) {
                $product_id = $item['id'];
                $quantity = $item['quantity'];

                $stockQuery = $conn->prepare("SELECT stock FROM product WHERE id = ?");
                $stockQuery->bind_param("i", $product_id);
                $stockQuery->execute();
                $stockResult = $stockQuery->get_result();
                $stockRow = $stockResult->fetch_assoc();

                if ($stockRow['stock'] < $quantity) {
                    $error = "Insufficient stock for product ID: $product_id";
                    $orderSuccess = false;
                    break;
                }

                $stockQuery->close();
            }

            if ($orderSuccess) {
                $orderQuery = $conn->prepare("INSERT INTO orders (customer_id, full_name, contact, address, total) VALUES (?, ?, ?, ?, ?)");
                $orderQuery->bind_param("isssi", $user_id, $name, $contact, $address, $total);

                if ($orderQuery->execute()) {
                    $order_id = $orderQuery->insert_id;

                    foreach ($_SESSION['cart'] as $item) {
                        $product_id = $item['id'];
                        $quantity = $item['quantity'];
                        $months = $item['months'];
                        $issued_date = date('Y-m-d');
                        $return_till = date('Y-m-d', strtotime($issued_date . ' + ' . $months . ' months'));
                        $price = $item['rent_price'] * $quantity * $months;

                        $orderDetailQuery = $conn->prepare("INSERT INTO order_details (order_id, product_id, quantity, months, amount, issued_date, return_till) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $orderDetailQuery->bind_param("iiidsss", $order_id, $product_id, $quantity, $months, $price, $issued_date, $return_till);

                        if (!$orderDetailQuery->execute()) {
                            $orderSuccess = false;
                            $error = "Error: " . $orderDetailQuery->error;
                            break;
                        }

                        $updateStockQuery = $conn->prepare("UPDATE product SET stock = stock - ? WHERE id = ?");
                        $updateStockQuery->bind_param("ii", $quantity, $product_id);

                        if (!$updateStockQuery->execute()) {
                            $orderSuccess = false;
                            $error = "Error updating stock: " . $updateStockQuery->error;
                            break;
                        }
                    }
                } else {
                    $orderSuccess = false;
                    $error = "Error: " . $orderQuery->error;
                }
            }

            if ($orderSuccess) {
                if ($payment_method == 'cod') {
                    $conn->commit();
                    unset($_SESSION['cart']);
                    header('Location: thank_you.php?order_id=' . $order_id);
                    exit();
                } elseif ($payment_method == 'khalti') {


                    unset($_SESSION['cart']);
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => json_encode(array(
                            "return_url" => "http://localhost/project/take_book/thank_you.php?order_id=$order_id",
                            "website_url" => "http://localhost/project/take_book/home.php",
                            "amount" => $total * 100, // Amount in paisa
                            "purchase_order_id" => "Order_$order_id",
                            "purchase_order_name" => "Rental Order",
                            "customer_info" => array(
                                "name" => $name,
                                // "email" => "user@example.com",
                                "phone" => $contact
                            )
                        )),
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: Key live_secret_key_68791341fdd94846a146f0457ff7b455',
                            'Content-Type: application/json',
                        ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);

                    $responseData = json_decode($response, true);

                    if (isset($responseData['payment_url'])) {

                        header('Location: ' . $responseData['payment_url']);
                        $conn->commit();
                        exit();
                    } else {
                        $error = "Error: Unable to initiate payment.";
                    }
                }

            } else {
                $conn->rollback();
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout</title>
        <link rel="stylesheet" href="css/checkout_style.css">
    </head>

    <body>
        <?php include 'header.php'; ?>
        <main>
            <div class="checkout">
                <h1>Checkout</h1>
                <div class="checkout_items">
                    <?php
                    $total = 0;
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $item) {
                            $itemTotal = $item['rent_price'] * $item['quantity'] * $item['months'];
                            $total += $itemTotal;
                            echo '<div class="checkout_item">';
                            echo '<div class="checkout_image">';
                            echo '<img src="admin/images/' . $item['image'] . '">';
                            echo '</div>';
                            echo '<div class="checkout_details">';
                            echo '<h4>' . htmlspecialchars($item['name']) . '</h4>';
                            echo '<p class="checkout_price">NRs.' . htmlspecialchars($item['rent_price']) . ' per month</p>';
                            echo '<p class="checkout_quantity">Quantity: ' . htmlspecialchars($item['quantity']) . '</p>';
                            echo '<p class="checkout_months">Months: ' . htmlspecialchars($item['months']) . '</p>';
                            echo '<p class="checkout_item_total">Item Total: NRs.' . htmlspecialchars($itemTotal) . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Your cart is empty.</p>';
                    }
                    ?>
                </div>
                <div class="checkout_total">
                    <?php echo '<p>Total: NRs.' . htmlspecialchars($total); ?></p>
                </div>
                <div class="checkout_form">
                    <h1>Shipping Details</h1>
                    <?php if (!empty($error)) {
                        echo '<p class="error">' . htmlspecialchars($error) . '</p>';
                    } ?>
                    <form action="checkout.php" method="POST">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

                        <label for="contact">Contact:</label>
                        <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($contact); ?>"
                            required>

                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>"
                            required>

                        <input type="hidden" name="total" value="<?php echo htmlspecialchars($total); ?>">

                        <!-- Payment Method -->
                        <label>Payment Method:</label><br>
                        <label for="cod">Cash on Delivery</label>
                        <input type="radio" id="cod" name="payment_method" value="cod" required><br>
                        <label for="khalti">Khalti</label>
                        <input type="radio" id="khalti" name="payment_method" value="khalti" required><br>

                        <button type="submit" class="checkout_btn">Place Order</button>
                    </form>
                </div>
            </div>
        </main>
        <?php include 'footer.php'; ?>
    </body>

    </html>

    <?php
}
?>