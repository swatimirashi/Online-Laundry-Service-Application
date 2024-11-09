<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $id = $_POST["id"];
    if (isset($_POST["update_pickup_status"])) 
    
    {
        $query = "UPDATE pickup SET pickup_status = 'Picked Up' WHERE order_id = $id";
        mysqli_query($conn, $query);
    } 
    elseif (isset($_POST["update_status"])) 
    {
        $query = "UPDATE pickup SET status = 'Completed' WHERE order_id = $id";
        mysqli_query($conn, $query);
    } 
    elseif (isset($_POST["update_delivery_status"])) 
    {
        $query = "UPDATE pickup SET delivery_status = 'Delivered' WHERE order_id = $id";
        mysqli_query($conn, $query);
    } 
    elseif (isset($_POST["delete_entry"])) 
    {
        $query = "DELETE FROM pickup WHERE order_id = $id";
        mysqli_query($conn, $query);
        header("Location: myaccount.php");
        exit;
    }
}

$user_id = $_SESSION['user_id'];
$query_pickup = "SELECT * FROM pickup WHERE user_id = $user_id";
$result_pickup = mysqli_query($conn, $query_pickup);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="stylesheet" href="myaccount5.css">
    <link rel="stylesheet" href="nav.css">
</head>
<body>

    <button class="back-button" onclick="document.location = 'about us.php'">&larr;</button>
    <button class="front-button" onclick="document.location = 'myaccount.php'">&rarr;</button>

    <div class="form-container">
        <h1>My Orders</h1>
        <table>
            <tr>
                <th>Order No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Pincode</th>
                <th>Service</th>
                <th>Booked Date</th>
                <th>Action</th>
            </tr>
            <?php
            if (mysqli_num_rows($result_pickup) > 0) 
            {
                while ($row = mysqli_fetch_assoc($result_pickup)) 
                {
                    echo "<tr>";
                    echo "<td>" . $row["order_id"] . "</td>";
                    echo "<td>" . $row["fname"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["contact"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["pincode"] . "</td>";
                    echo "<td>" . $row["service"] . "</td>";
                    echo "<td>" . $row["booked_date"] . "</td>";
                    echo "<td>";
                    ?>
                    <form method="post" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                        <input type="hidden" name="id" value="<?php echo $row['order_id']; ?>">
                        <?php if ($row['pickup_status'] == 'Not Picked Up'): ?>
                            <input type="submit" name="delete_entry" value="Cancel" class="delete">
                        <?php elseif ($row['pickup_status'] == 'Picked Up' && $row['status'] == 'In Progress' && $row['delivery_status'] == 'Not Delivered'): ?>
                            <input type="submit" name="update_pickup_status" value="Picked Up" class="pickup" disabled>
                        <?php elseif ($row['pickup_status'] == 'Picked Up' && $row['status'] == 'Completed' && $row['delivery_status'] == 'Not Delivered'): ?>
                            <input type="submit" name="update_status" value="Completed" class="status" disabled>
                        <?php elseif ($row['pickup_status'] == 'Picked Up' && $row['status'] == 'Completed' && $row['delivery_status'] == 'Delivered'): ?>
                            <input type="submit" name="update_delivery_status" value="Delivered" class="delivery" disabled>
                        <?php endif; ?>
                    </form>
                    <?php
                    echo "</td>";
                    echo "</tr>";
                }
            } 
            else 
            {
                echo "<tr><td colspan='9'>No orders found.</td></tr>";
            }
            ?>
        </table>
        <h5><a href="pickup.php">Book a Pickup</a></h5>
    </div>
</body>
</html>
