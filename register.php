<?php
include 'config.php';
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $address = trim($_POST['address']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $errors = [];

    if (empty($name))
        $errors[] = "Full name is required";
    if (!preg_match('/^[\w\.\-]+@[\w\-]+\.[a-zA-Z]{2,4}$/', $email))
        $errors[] = "Valid email is required";
    if (empty($contact))
        $errors[] = "Contact is required";
    if (!preg_match('/^(98|97|96)\d{8}$/', $contact))
        $errors[] = "Contact must be 10 digits and start with 98, 97, or 96";
    if (empty($address))
        $errors[] = "Address is required";
    if (empty($password))
        $errors[] = "Password is required";
    if ($password !== $confirm_password)
        $errors[] = "Passwords do not match";

    if (empty($errors)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Sanitize inputs
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $contact = mysqli_real_escape_string($conn, $contact);
        $address = mysqli_real_escape_string($conn, $address);

        // Insert data into the database
        $sql = "INSERT INTO customer (full_name, email, contact, address, password) VALUES ('$name', '$email', '$contact', '$address', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Customer added successfully');</script>";
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <h1>Register</h1>
        <form method="post" onsubmit="return validateForm()">
            <div>
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label>Contact</label>
                <input type="text" name="contact" required>
            </div>
            <div>
                <label>Address</label>
                <input type="text" name="address" required>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required>
            </div>
            <div>
                <button type="submit" name="submit">Register</button>
            </div>
            <div>
                <p>Already have an account? <a href="index.php">Login</a></p>
            </div>
        </form>
    </div>
</body>
<script src="validate.js">

</script>

</html>