<?php
session_start();
include 'config.php';
if (strlen($_SESSION['USER_LOGIN']) == 0) {
    header('location:index.php');
} else {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Store Website</title>
        <link rel="stylesheet" href="css/style.css">

    </head>

    <body>
        <?php include 'header.php'; ?>
        <section>
            <div class="main">

                <div class="main_tag">
                    <h1>WELCOME TO<br><span>TAKE BOOK</span></h1>

                    <p>
                        Welcome to Take Book, we provide course books of Bachelor in Computer Application (BCA) Bachelor in
                        Bisuness Management(BBM) to rent in affordable price for students. We also provide books of other
                        courses.
                        We provide fast delivery, 24 x 7 services, best deal and secure payment.

                    </p>

                </div>

                <div class="main_img">
                    <img src="admin/images/table.jpeg">
                </div>

            </div>

        </section>




        <!--Services-->


        <div class="about">

            <div class="about_image">
                <img src="image/About Us.jpg">
            </div>
            <div class="about_tag">
                <h1>About Us</h1>
                <p>
                    By fasilitating second-hand book sales , We promote
                    affordibility and sutanibility within the BCA student community.
                </p>
                <p>
                    Our mission is to empower BCA students with the resources they need to succed .
                    We strive to provide a platform that promotes affordibility , knowledge sharing and
                    a sense of community.
                </p>
                <a href="aboutus.php" class="about_btn">Learn More</a>
            </div>

        </div>





        <!--Books-->

        <div class="featured_boks">

            <h1>Avaliable Books</h1>

            <div class="featured_book_box">

                <!-- get books from database -->
                <?php
                $sql = "SELECT * from product where stock>0 LIMIT 15";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="featured_book_card">';
                        echo '<div class="featurde_book_img">';
                        echo '<img src="admin/images/' . $row['image'] . '">';
                        echo '</div>';
                        echo '<div class="featurde_book_tag">';
                        echo '<h2>' . $row['name'] . '</h2>';
                        // echo '<div class="categories">' . $row['category'] . '</div>';
                        echo '<p class="book_price">NRs.' . $row['rent_price'] . '</p>';
                        echo '<a href="product.php" class="f_btn">Learn More</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>

        </div>




        <!--Arrivals-->

        <div class="arrivals">
            <h1>New Arrivals</h1>

            <div class="arrivals_box">
                <?php $sqli = "SELECT * from product where stock>0 ORDER BY id DESC LIMIT 10";
                $resulti = $conn->query($sqli);
                if ($resulti->num_rows > 0) {
                    while ($rowi = $resulti->fetch_assoc()) {
                        echo '<div class="arrivals_card">';
                        echo '<div class="arrivals_image">';
                        echo '<img src="admin/images/' . $rowi['image'] . '">';
                        echo '</div>';
                        echo '<div class="arrivals_tag">';
                        echo '<p>' . $rowi['name'] . '</p>';
                        echo '<a href="product.php" class="arrivals_btn">Learn More</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>

            </div>

        </div>


        <!--reviews-->

        <!-- <div class="reviews">
            <h1>Reviews</h1>

            <div class="review_box">

                <div class="review_card">
                    <i class="fa-solid fa-quote-right"></i>
                    <div class="card_top">
                        <img src="image/review_1.png">
                    </div>
                    <div class="card">
                        <h2>John Deo</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus eos doloribus iure
                            distinctio! Eos dolorem quam, nisi amet saepe totam, quas quidem laboriosam dolore,
                            tenetur itaque nostrum voluptas excepturi aut.
                        </p>
                        <div class="review_icon">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                    </div>
                </div>

                <div class="review_card">
                    <i class="fa-solid fa-quote-right"></i>
                    <div class="card_top">
                        <img src="image/review_2.png">
                    </div>
                    <div class="card">
                        <h2>John Deo</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus eos doloribus iure
                            distinctio! Eos dolorem quam, nisi amet saepe totam, quas quidem laboriosam dolore,
                            tenetur itaque nostrum voluptas excepturi aut.
                        </p>
                        <div class="review_icon">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                    </div>
                </div>

                <div class="review_card">
                    <i class="fa-solid fa-quote-right"></i>
                    <div class="card_top">
                        <img src="image/review_3.png">
                    </div>
                    <div class="card">
                        <h2>John Deo</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus eos doloribus iure
                            distinctio! Eos dolorem quam, nisi amet saepe totam, quas quidem laboriosam dolore,
                            tenetur itaque nostrum voluptas excepturi aut.
                        </p>
                        <div class="review_icon">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                    </div>
                </div>

                <div class="review_card">
                    <i class="fa-solid fa-quote-right"></i>
                    <div class="card_top">
                        <img src="image/review_4.png">
                    </div>
                    <div class="card">
                        <h2>John Deo</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus eos doloribus iure
                            distinctio! Eos dolorem quam, nisi amet saepe totam, quas quidem laboriosam dolore,
                            tenetur itaque nostrum voluptas excepturi aut.
                        </p>
                        <div class="review_icon">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                    </div>
                </div>

            </div>

        </div> -->
 
        <!--Footer-->

        <?php include 'footer.php'; ?>


    </body>

    </html>
<?php } ?>