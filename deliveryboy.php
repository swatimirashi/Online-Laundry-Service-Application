<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    if (isset($_POST["pickup"])) 
    {
        $order_id = $_POST["order_id"];

        $sql = "SELECT * FROM pickup WHERE order_id = $order_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
            $row = $result->fetch_assoc();

            if ($row["pickup_status"] == "Picked Up") 
            {
                echo "<script>alert('Laundry bucket has been picked up.');</script>";
            } 
            else 
            {
                date_default_timezone_set('Asia/Kolkata'); 
                $pickup_time = date('Y-m-d H:i:s'); 

                $sql_update = "UPDATE pickup SET pickup_time='$pickup_time', pickup_status='Picked Up' WHERE order_id=$order_id";
                if ($conn->query($sql_update) === TRUE) 
                {
                    echo "<script>alert('Order successfully picked up.');</script>";
                } 
                else 
                {
                    echo "<script>alert('Failed to update pickup status.');</script>";
                }
            }
        } 
        else 
        {
            echo "<script>alert('Order not found.');</script>";
        }
    }

    if (isset($_POST["in_progress"])) 
    {
        $order_id = $_POST["order_id"];

        $sql = "SELECT * FROM pickup WHERE order_id = $order_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
            $row = $result->fetch_assoc();

            if ($row["pickup_status"] != "Picked Up") 
            {
                echo "<script>alert('Laundry bucket has not been picked up yet.');</script>";
            } 
            elseif ($row["status"] == "In Progress") 
            {
                echo "<script>alert('Laundry work is in progress.');</script>";
            } 
            elseif ($row["status"] == "Completed") 
            {
                echo "<script>alert('Laundry service has been completed.');</script>";
            } 
            else 
            {
                $sql_update = "UPDATE pickup SET status='In Progress' WHERE order_id=$order_id";
                if ($conn->query($sql_update) !== TRUE) {
                    echo "<script>alert('Failed to update service status.');</script>";
                }
            }
        } 
        else 
        {
            echo "<script>alert('Order not found.');</script>";
        }
    }

    if (isset($_POST["delivery"])) 
    {
        $order_id = $_POST["order_id"];

        $sql = "SELECT * FROM pickup WHERE order_id = $order_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($row["pickup_status"] != "Picked Up") 
            {
                echo "<script>alert('Laundry bucket has not been picked up yet.');</script>";
            } 
            elseif ($row["status"] != "Completed") 
            {
                echo "<script>alert('Laundry work is in progress.');</script>";
            } 
            elseif ($row["delivery_status"] == "Delivered") 
            {
                echo "<script>alert('Laundry bucket has been delivered.');</script>";
            } 
            else 
            {
                date_default_timezone_set('Asia/Kolkata'); 
                $delivery_time = date('Y-m-d H:i:s'); 

                $sql_update = "UPDATE pickup SET delivery_time='$delivery_time', delivery_status='Delivered' WHERE order_id=$order_id";
                if ($conn->query($sql_update) === TRUE) 
                {
                    echo "<script>alert('Order successfully delivered.');</script>";
                } 
                else 
                {
                    echo "<script>alert('Failed to update delivery status.');</script>";
                }
            }
        } 
        else 
        {
            echo "<script>alert('Order not found.');</script>";
        }
    }
}

$sql = "SELECT order_id, user_id, fname, email, contact, address, pincode, service, pickup_status, status, delivery_status FROM pickup";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Laundry Service Dashboard</title>
    <link rel="stylesheet" href="deliveryboy1.css">
    <link rel="stylesheet" href="nav.css">
    <script>
        function handleConfirmation(message, status, action, pickupStatus, serviceStatus) 
        {
            if (action === "pickup") 
            {
                if (status === "Picked Up") 
                {
                    return true;
                }
                return confirm(message);
            }
            if (action === "delivery") 
            {
                if (status === "Delivered") 
                {
                    return true;
                }
                if (pickupStatus !== "Picked Up" || serviceStatus !== "Completed") 
                {
                    return true;
                }
                return confirm(message);
            }
            return true;
        }

        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) 
            {
                window.location.href = 'login.php';
            }
        }
    </script>
</head>
<body>
    <button class="back-button" onclick="confirmLogout()">&larr;</button>
    <h1>Pickup and Delivery Status Updates</h1>
    <table>
        <tr>
            <th>Order No.</th>
            <th>Register ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Pincode</th>
            <th>Service</th>
            <th>Pickup Status</th>
            <th>Service Status</th>
            <th>Delivery Status</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) 
        {
            echo "<tr>";
            echo "<td>" . $row["order_id"] . "</td>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["fname"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["contact"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["pincode"] . "</td>";
            echo "<td>" . $row["service"] . "</td>";

            
            $pickupButton = $row["pickup_status"] == "Picked Up" ? "Picked Up" : "Pickup";
            echo "<td>";
            echo '<form method="post" onsubmit="return handleConfirmation(\'Are you sure you want to mark this order as picked up?\nOrder ID: ' . $row['order_id'] . '\nName: ' . $row['fname'] . '\nContact: ' . $row['contact'] . '\nAddress: ' . $row['address'] . '\nPincode: ' . $row['pincode'] . '\nService: ' . $row['service'] . '\', \'' . $row['pickup_status'] . '\', \'pickup\')">';
            echo '<input type="hidden" name="order_id" value="' . $row["order_id"] . '">';
            echo '<button type="submit" name="pickup" data-status="' . $row["pickup_status"] . '">' . $pickupButton . '</button>';
            echo '</form>';
            echo "</td>";

            
            $serviceButton = ($row["pickup_status"] == "Picked Up" && $row["status"] == "Completed") ? "Completed" : "In Progress";
            echo "<td>";
            echo '<form method="post">';
            echo '<input type="hidden" name="order_id" value="' . $row["order_id"] . '">';
            echo '<input type="hidden" name="status" value="' . $row["status"] . '">';
            echo '<button type="submit" name="in_progress" data-status="' . $row["status"] . '">' . $serviceButton . '</button>';
            echo '</form>';
            echo "</td>";

    
            $deliveryButton = $row["delivery_status"] == "Delivered" ? "Delivered" : "Delivery";
            echo "<td>";
            echo '<form method="post" onsubmit="return handleConfirmation(\'Are you sure you want to mark this order as delivered?\nOrder ID: ' . $row['order_id'] . '\nName: ' . $row['fname'] . '\nContact: ' . $row['contact'] . '\nAddress: ' . $row['address'] . '\nPincode: ' . $row['pincode'] . '\nService: ' . $row['service'] . '\', \'' . $row['delivery_status'] . '\', \'delivery\', \'' . $row['pickup_status'] . '\', \'' . $row['status'] . '\')">';
            echo '<input type="hidden" name="order_id" value="' . $row["order_id"] . '">';
            echo '<input type="hidden" name="status" value="' . $row["status"] . '">';
            echo '<button type="submit" name="delivery" data-status="' . $row["delivery_status"] . '">' . $deliveryButton . '</button>';
            echo '</form>';
            echo "</td>";

            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>