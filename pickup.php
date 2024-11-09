<?php
session_start();
include("db.php");

$email = $_SESSION['email'];

$query_user_id = "SELECT id FROM registration WHERE email='$email'";
$result_user_id = mysqli_query($conn, $query_user_id);
$user_id_row = mysqli_fetch_assoc($result_user_id);
$user_id = $user_id_row['id'];

$query_pickup = "SELECT * FROM pickup WHERE user_id = '$user_id' ORDER BY order_id DESC LIMIT 1";
$booking = mysqli_fetch_assoc(mysqli_query($conn, $query_pickup));

if ($_SERVER['REQUEST_METHOD'] == "POST") 
{
    $fullname = strtoupper($_POST['fname']);
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $service = $_POST['service'];

    date_default_timezone_set('Asia/Kolkata');
    $booked_date = date('Y-m-d');

    $check_query = "SELECT * FROM registration WHERE email = '$email' AND contact = '$contact'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) 
    {    
        if (!empty($fullname) && !empty($contact) && !empty($address) && !empty($pincode) && !empty($service)) 
        {
            $query = "INSERT INTO pickup (fname, email, user_id, contact, address, pincode, service, booked_date) 
                      VALUES ('$fullname', '$email', '$user_id', '$contact', '$address', '$pincode', '$service', '$booked_date')";
            if (mysqli_query($conn, $query)) 
            {
                header("Location: thankyou.php");
                exit;
            } 
            else 
            {
                echo "<script>alert('There was an error. Please try again.')</script>";
            }
        } 
        else 
        {
            echo "<script>alert('All fields are required.')</script>";
        }
    } 
    else 
    {
        echo "<script>alert('Email or contact not registered yet.\\nPlease check and try again.')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Pickup</title>
    <link rel="stylesheet" href="pickup8.css">
    <link rel="stylesheet" href="nav.css">
</head>
<body>
<button class="back-button" onclick="document.location = 'myaccount.php'">&larr;</button>
<button class="front-button" onclick="document.location = 'pickup.php'">&rarr;</button>
<style>
   body 
   {
        background-image: url('laundry4.jpg');
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>
    <div class="form-container">
        <h1>Book a Pickup</h1>
        <form method="POST" action="pickup.php" autocomplete="off" onsubmit="return validation()">
            <label for="fname">Full Name</label>
            <input type="text" id="fname" name="fname" required placeholder="Full name" value="<?php echo isset($booking['fname']) ? $booking['fname'] : ''; ?>">
            <span id="fnamee" style="color: red;"></span><br><br>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Email" value="<?php echo $email; ?>" readonly>
           
            <label for="contact">Contact No.</label>
            <input type="text" id="contact" name="contact" required placeholder="Contact number" value="<?php echo isset($booking['contact']) ? $booking['contact'] : ''; ?>">
            
            <label for="address">Address</label>
            <textarea id="address" name="address" required placeholder="House No/Building Name, Road name, Near Area, City, State"><?php echo isset($booking['address']) ? $booking['address'] : ''; ?></textarea>
            <span id="addresss" style="color: red;"></span><br><br>

            <label for="pincode">Pincode</label>
            <input type="text" id="pincode" name="pincode" required placeholder="Pincode" value="<?php echo isset($booking['pincode']) ? $booking['pincode'] : ''; ?>">
            <span id="pincodee" style="color: red;"></span><br><br>

            <label for="service">Service</label>
            <select id="service" name="service" required>
                <option value="" disabled>Select a service</option>
                <option value="Wash and Fold" <?php echo isset($booking['service']) && $booking['service'] == 'Wash and Fold' ? 'selected' : ''; ?>>Wash and Fold</option>
                <option value="Wash and Iron" <?php echo isset($booking['service']) && $booking['service'] == 'Wash and Iron' ? 'selected' : ''; ?>>Wash and Iron</option>
                <option value="Dry Cleaning" <?php echo isset($booking['service']) && $booking['service'] == 'Dry Cleaning' ? 'selected' : ''; ?>>Dry Cleaning</option>
                <option value="Express Laundry" <?php echo isset($booking['service']) && $booking['service'] == 'Express Laundry' ? 'selected' : ''; ?>>Express Laundry</option>  
            </select>
            <span id="servicee" style="color: red;"></span><br><br>
            <h5>If you are not registered yet, then <a href="register.php">click here</a> to register first</h5> 
            <button class="bookpickup" type="submit">Submit</button>
        </form>
    </div>
    <script src="pickup3.js"></script>
</body>
</html>