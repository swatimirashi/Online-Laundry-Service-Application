<?php
include 'db.php'; 

if (isset($_POST["status"])) 
{
    $order_id = $_POST["order_id"]; 

    $sql = "SELECT * FROM pickup WHERE order_id = $order_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
        $row = $result->fetch_assoc();

        if ($row["status"] == "Completed") 
        {
            echo "<script>alert('Laundry service has been Completed.');</script>";
        } 
        elseif ($row["pickup_status"] != "Picked Up") 
        {
            echo "<script>alert('Laundry bucket has not been picked up yet.');</script>";
        } 
        else 
        {
            $sql_update = "UPDATE pickup SET status='Completed' WHERE order_id=$order_id";
            if ($conn->query($sql_update) === TRUE) 
            {
                echo "<script>alert('Order successfully Completed.');</script>";
            } 
            else 
            {
                echo "<script>alert('Failed to update status.');</script>";
            }
        }
    } 
    else 
    {
        echo "<script>alert('Order not found.');</script>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Laundry Service Dashboard</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="orderedpeople1.css">
    <script>
        function handleConfirmation(message, status, pickupStatus) 
        {
            if (status === "Completed" || pickupStatus !== "Picked Up") 
            {
                return true;
            }
            return confirm(message);
        }
    </script>
</head>
<body>
    <header>
        <nav class="nav-menu">
            <button class="back-button" onclick="document.location = 'registeredpeople.php'">&larr;</button>
            <button class="front-button" onclick="document.location = 'update.php'">&rarr;</button>
        </nav>
        <h2>Online Laundry Services</h2>
        <nav>
            <a href="dashboard.php">DASHBOARD</a>
            <a href="registeredpeople.php">REGISTERED</a>
            <a href="orderedpeople.php" class="active">ORDERED</a>
            <a href="update.php">UPDATES</a>
        </nav>
    </header>
    <h1>Ordered People</h1>
    <table>
        <tr>
            <th>Order No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Pincode</th>
            <th>Service</th>
            <th>Service Status</th>
            <th>Payment</th>
        </tr>
        <?php
        session_start();
        include("db.php"); 

        $sql = "SELECT * FROM pickup";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                echo "<tr>";
                echo "<td>" . $row["order_id"] . "</td>";
                echo "<td>" . $row["fname"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["contact"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["pincode"] . "</td>";
                echo "<td>" . $row["service"] . "</td>";

                $serviceButton = $row["status"] == "Completed" ? "Completed" : "In Progress";
                $buttonClass = $row["status"] == "Completed" ? "completed-btn" : "in-progress-btn";
                echo "<td>";
                echo '<form method="post" onsubmit="return handleConfirmation(\'Are you sure to switch this order as completed?\\nOrder ID: ' . $row['order_id'] . '\\nName: ' . $row['fname'] . '\\nContact: ' . $row['contact'] . '\\nAddress: ' . $row['address'] . '\\nPincode: ' . $row['pincode'] . '\\nService: ' . $row['service'] . '\', \'' . $row['status'] . '\', \'' . $row['pickup_status'] . '\')">';
                echo '<input type="hidden" name="order_id" value="' . $row["order_id"] . '">';
                echo '<button type="submit" name="status" class="' . $buttonClass . '">' . $serviceButton . '</button>';
                echo '</form>';
                echo "</td>";

                echo "<td>";
                echo "<form method='get' action='view_bill.php'>"; 
                echo "<input type='hidden' name='id' value='" . $row["order_id"] . "'>";
                echo "<input type='submit' name='view_bill' value='View Bill' class='view-bill-btn'>";
                echo "</form>";
                echo "</td>";

                echo "</tr>";
            }
        } 
        else 
        {
            echo "<tr><td colspan='9'>No data available</td></tr>";
        }
        ?>
    </table>
</body>
</html>