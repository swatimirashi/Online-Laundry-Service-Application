<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) 
{
    $user_type = $_POST['user_type'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) 
    {
        if ($user_type == 'user') 
        {
            $table = 'registration';
            $redirect_page = 'home.php';
        } elseif ($user_type == 'admin') 
        {
            $table = 'admin_login';
            $redirect_page = 'adminpage.html';
        } elseif ($user_type == 'delivery') 
        {
            $table = 'delivery_boy';
            $redirect_page = 'deliveryboy.php';
        } else 
        {
            echo "<script>alert('Invalid user type')</script>";
            exit;
        }

        $query = "SELECT * FROM $table WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) 
        {
            $user = mysqli_fetch_assoc($result);
            if ($password == $user['password']) 
            {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                header("Location: $redirect_page");
                exit;
            } else 
            {
                echo "<script>alert('Invalid credentials');</script>";
            }
        } else 
        {
            echo "<script>alert('Invalid credentials');</script>";
        }
    } 
    else 
    {
        echo "<script>alert('Please enter valid information');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Login Form</title>
    <link rel="stylesheet" href="login1.css">
    <link rel="stylesheet" href="nav.css">
</head>
<style>
    body 
    {
        background-image: url('laundry4.jpg');
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>
<button class="back-button" onclick="document.location = 'register.php'">&larr;</button> 
<button class="front-button" onclick="document.location = 'login.php'">&rarr;</button>
<div class="login">
    <h1>Login</h1>
    <form method="POST">
        <label for="user_type">Login as</label>
        <select id="user_type" name="user_type" required>
            <option value="" disabled selected>Select User Type</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="delivery">Delivery Boy</option>
        </select>
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <input type="submit" name="login" value="Login">
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</div>
</body>
</html>