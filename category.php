<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="css/product_style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="product">
            <h1>BCA</h1>
            <h1>First Semester</h1>
            <div class="product_box">
                <?php
                $sql = "SELECT * FROM product where cat_id = 1 and semester_id = 1";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="product_card">';
                        echo '<div class="product_image">';
                        echo '<img src="admin/images/' . $row['image'] . '">';
                        echo '</div>';
                        echo '<div class="product_tag">';
                        echo '<h4>' . $row['name'] . '</h4>';
                        echo '<p class="product_price">NRs.' . $row['rent_price'] . '</p>';
                        if ($row['stock'] > 0) {
                            echo '<p class="product_stock">In Stock</p>';
                        } else {
                            echo '<p class="product_stock">Out of Stock</p>';
                        }
                        echo '<a href="cart.php?id=' . $row['id'] . '" class="product_btn">Add to cart</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="product">
            <h1>Second Semester</h1>
            <div class="product_box">
                <?php
                $sql = "SELECT * FROM product where cat_id = 1 and semester_id = 2";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="product_card">';
                        echo '<div class="product_image">';
                        echo '<img src="admin/images/' . $row['image'] . '">';
                        echo '</div>';
                        echo '<div class="product_tag">';
                        echo '<h4>' . $row['name'] . '</h4>';
                        echo '<p class="product_price">NRs.' . $row['rent_price'] . '</p>';
                        if ($row['stock'] > 0) {
                            echo '<p class="product_stock">In Stock</p>';
                        } else {
                            echo '<p class="product_stock">Out of Stock</p>';
                        }
                        echo '<a href="cart.php?id=' . $row['id'] . '" class="product_btn">Add to cart</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="product">
            <h1>Third Semester</h1>
            <div class="product_box">
                <?php
                $sql = "SELECT * FROM product where cat_id = 1 and semester_id = 3";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="product_card">';
                        echo '<div class="product_image">';
                        echo '<img src="admin/images/' . $row['image'] . '">';
                        echo '</div>';
                        echo '<div class="product_tag">';
                        echo '<h4>' . $row['name'] . '</h4>';
                        echo '<p class="product_price">NRs.' . $row['rent_price'] . '</p>';
                        if ($row['stock'] > 0) {
                            echo '<p class="product_stock">In Stock</p>';
                        } else {
                            echo '<p class="product_stock">Out of Stock</p>';
                        }
                        echo '<a href="cart.php?id=' . $row['id'] . '" class="product_btn">Add to cart</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="product">
            <h1>Fourth Semester</h1>
            <div class="product_box">
                <?php
                $sql = "SELECT * FROM product where cat_id = 1 and semester_id = 4";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="product_card">';
                        echo '<div class="product_image">';
                        echo '<img src="admin/images/' . $row['image'] . '">';
                        echo '</div>';
                        echo '<div class="product_tag">';
                        echo '<h4>' . $row['name'] . '</h4>';
                        echo '<p class="product_price">NRs.' . $row['rent_price'] . '</p>';
                        if ($row['stock'] > 0) {
                            echo '<p class="product_stock">In Stock</p>';
                        } else {
                            echo '<p class="product_stock">Out of Stock</p>';
                        }
                        echo '<a href="cart.php?id=' . $row['id'] . '" class="product_btn">Add to cart</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="product">
            <h1>BBM</h1>
            <h1>First Semester</h1>
            <div class="product_box">
                <?php
                $sql = "SELECT * FROM product where cat_id = 2 and semester_id = 1";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="product_card">';
                        echo '<div class="product_image">';
                        echo '<img src="admin/images/' . $row['image'] . '">';
                        echo '</div>';
                        echo '<div class="product_tag">';
                        echo '<h4>' . $row['name'] . '</h4>';
                        echo '<p class="product_price">NRs.' . $row['rent_price'] . '</p>';
                        if ($row['stock'] > 0) {
                            echo '<p class="product_stock">In Stock</p>';
                        } else {
                            echo '<p class="product_stock">Out of Stock</p>';
                        }
                        echo '<a href="cart.php?id=' . $row['id'] . '" class="product_btn">Add to cart</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="product">
            <h1>Second Semester</h1>
            <div class="product_box">
                <?php
                $sql = "SELECT * FROM product where cat_id = 2 and semester_id = 2";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="product_card">';
                        echo '<div class="product_image">';
                        echo '<img src="admin/images/' . $row['image'] . '">';
                        echo '</div>';
                        echo '<div class="product_tag">';
                        echo '<h4>' . $row['name'] . '</h4>';
                        echo '<p class="product_price">NRs.' . $row['rent_price'] . '</p>';
                        if ($row['stock'] > 0) {
                            echo '<p class="product_stock">In Stock</p>';
                        } else {
                            echo '<p class="product_stock">Out of Stock</p>';
                        }
                        echo '<a href="cart.php?id=' . $row['id'] . '" class="product_btn">Add to cart</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="product">
            <h1>Third Semester</h1>
            <div class="product_box">
                <?php
                $sql = "SELECT * FROM product where cat_id = 2 and semester_id = 3";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="product_card">';
                        echo '<div class="product_image">';
                        echo '<img src="admin/images/' . $row['image'] . '">';
                        echo '</div>';
                        echo '<div class="product_tag">';
                        echo '<h4>' . $row['name'] . '</h4>';
                        echo '<p class="product_price">NRs.' . $row['rent_price'] . '</p>';
                        if ($row['stock'] > 0) {
                            echo '<p class="product_stock">In Stock</p>';
                        } else {
                            echo '<p class="product_stock">Out of Stock</p>';
                        }
                        echo '<a href="cart.php?id=' . $row['id'] . '" class="product_btn">Add to cart</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="product">
            <h1>Fourth Semester</h1>
            <div class="product_box">
                <?php
                $sql = "SELECT * FROM product where cat_id = 2 and semester_id = 4";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="product_card">';
                        echo '<div class="product_image">';
                        echo '<img src="admin/images/' . $row['image'] . '">';
                        echo '</div>';
                        echo '<div class="product_tag">';
                        echo '<h4>' . $row['name'] . '</h4>';
                        echo '<p class="product_price">NRs.' . $row['rent_price'] . '</p>';
                        if ($row['stock'] > 0) {
                            echo '<p class="product_stock">In Stock</p>';
                        } else {
                            echo '<p class="product_stock">Out of Stock</p>';
                        }
                        echo '<a href="cart.php?id=' . $row['id'] . '" class="product_btn">Add to cart</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="product">
            <h1>Fifth Semester</h1>
            <div class="product_box">
                <?php
                $sql = "SELECT * FROM product where cat_id = 2 and semester_id = 5";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="product_card">';
                        echo '<div class="product_image">';
                        echo '<img src="admin/images/' . $row['image'] . '">';
                        echo '</div>';
                        echo '<div class="product_tag">';
                        echo '<h4>' . $row['name'] . '</h4>';
                        echo '<p class="product_price">NRs.' . $row['rent_price'] . '</p>';
                        if ($row['stock'] > 0) {
                            echo '<p class="product_stock">In Stock</p>';
                        } else {
                            echo '<p class="product_stock">Out of Stock</p>';
                        }
                        echo '<a href="cart.php?id=' . $row['id'] . '" class="product_btn">Add to cart</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
<script src="cart.js"></script>

</html>