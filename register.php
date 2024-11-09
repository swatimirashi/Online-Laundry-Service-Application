<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $fullname = strtoupper($_POST['fname']);
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if (!empty($fullname) && !empty($email) && !empty($contact) && !empty($address) && !empty($password) && !empty($cpassword))
    {
        $query = mysqli_query($conn, "SELECT email,contact FROM registration WHERE email='$email' OR contact='$contact'
        UNION SELECT email,contact FROM admin_login WHERE email='$email' OR contact='$contact' 
        UNION SELECT email,contact FROM delivery_boy WHERE email='$email' OR contact='$contact'");
        if (mysqli_num_rows($query) == 0) 
        {
            $sql = "INSERT INTO registration(fname, email, contact, address, password, cpassword) VALUES('$fullname', '$email', '$contact', '$address', '$password', '$cpassword')";
            if (mysqli_query($conn, $sql)) 
            {
                echo "<script>alert('Successfully Registered'); window.location='login.php';</script>";
                exit();
            } 
            else 
            {
                echo "<script>alert('Error in registration')</script>";
            }
        } 
        else 
        {
            echo "<script>alert('Email or Contact already exists')</script>";
        }
    }
    else 
    {
        echo "<script>alert('Please fill the all information')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form login and Register</title>
    <link rel="stylesheet" href="register3.css">
    <link rel="stylesheet" href="nav.css">
</head>
<body>

    <style>
        body {
            background-image: url('laundry4.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>

    <button class="back-button" onclick="document.location = 'startup.html'">&larr;</button>
    <button class="front-button" onclick="document.location = 'register.php'">&rarr;</button>
    
    <div class="signup">
        <h1>Registration Form</h1>
        <form method="POST" action="register.php" autocomplete="off" onsubmit="return validation()">
            <label for="fname">Full Name</label>
            <input type="text" id="fname" name="fname" placeholder="Full Name" required>
            <span id="fnamee" class="error"></span>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <span id="emaill" class="error"></span>

            <label for="contact">Contact No.</label>
            <input type="tel" id="contact" name="contact" placeholder="Contact Number" required>
            <span id="contactt" class="error"></span>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" placeholder="Address" required>
            <span id="addresss" class="error"></span>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <span id="passwordd" class="error"></span>

            <label for="cpassword">Confirm Password</label>
            <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
            <span id="cpasswordd" class="error"></span>
            <input type="submit" name="submit" value="Submit">
        </form>
        <p class="already">Already have an account?<a href="login.php">Login</a></p>
    </div>
    <script src="register3.js"></script>
</body>
</html>