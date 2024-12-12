<?php
session_start();
include "config.php";

if (strlen($_SESSION['ADMIN_LOGIN']) == 0) {
    header('location:login.php');
    exit();
} else {
    if (isset($_GET['rid'])) {
        $rid = $_GET['rid'];

        // Fetch product_id and quantity of the returned product
        $fetchProductQuery = $conn->prepare("SELECT product_id, quantity FROM order_details WHERE id = ?");
        $fetchProductQuery->bind_param("i", $rid);
        $fetchProductQuery->execute();
        $fetchProductQuery->bind_result($product_id, $quantity);
        $fetchProductQuery->fetch();
        $fetchProductQuery->close();

        // Update the return status and returned date
        $updateQuery = $conn->prepare("UPDATE order_details SET return_status = 1, returned_date = ? WHERE id = ?");
        $currentDate = date('Y-m-d');
        $updateQuery->bind_param("si", $currentDate, $rid);

        if ($updateQuery->execute()) {
            // Update the stock
            $updateStockQuery = $conn->prepare("UPDATE product SET stock = stock + ? WHERE id = ?");
            $updateStockQuery->bind_param("ii", $quantity, $product_id);
            if ($updateStockQuery->execute()) {
                echo "<script>alert('Return status updated and stock increased successfully.')</script>";
            } else {
                echo "Error updating stock: " . $updateStockQuery->error;
            }
            $updateStockQuery->close();
        } else {
            echo "Error updating return status: " . $updateQuery->error;
        }

        $updateQuery->close();
    }

    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];

        // Fetch order details
        $sql = "SELECT od.*, p.name, p.rent_price 
                FROM order_details od 
                JOIN product p ON od.product_id = p.id 
                WHERE od.order_id = $order_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $order_details = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "No order details found.";
            exit();
        }
    } else {
        echo "No order ID provided.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/category_manage.css">
</head>

<body>
    <?php include "header.php"; ?>
    <div>
        <h3>Order Details</h3>
    </div>
    <div>
        <table border="1px">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Rent Price</th>
                    <th>Quantity</th>
                    <th>Months</th>
                    <th>Amount</th>
                    <th>Issued Date</th>
                    <th>Return Till</th>
                    <th>Return Date</th>
                    <th>Return Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($order_details as $detail) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detail['name']); ?></td>
                        <td><?php echo htmlspecialchars($detail['rent_price']); ?></td>
                        <td><?php echo htmlspecialchars($detail['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($detail['months']); ?></td>
                        <td><?php echo htmlspecialchars($detail['amount']); ?></td>
                        <td><?php echo htmlspecialchars($detail['issued_date']); ?></td>
                        <td><?php echo htmlspecialchars($detail['return_till']); ?></td>
                        <td><?php echo htmlspecialchars($detail['returned_date']); ?></td>
                        <td><?php echo $detail['return_status'] == 0 ? "Pending" : "Returned"; ?></td>
                        <td>
                            <?php if ($detail['return_status'] == 0) { ?>
                                <a href="order_details.php?order_id=<?php echo $order_id; ?>&rid=<?php echo $detail['id']; ?>"><button
                                        class="edit">Mark as Returned</button></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>