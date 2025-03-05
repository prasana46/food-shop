<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $pizza = $_POST['pizza'];
    $burger = $_POST['burger'];
    $salad = $_POST['salad'];
    $popcorn = $_POST['popcorn'];
    $chocopie = $_POST['chocopie'];
    $wings = $_POST['wings'];
    $pepsi = $_POST['pepsi'];
    $meatballs = $_POST['meatballs'];
    $vegburger = $_POST['vegburger'];
    $vegnuggets = $_POST['vegnuggets'];
    $frenchfries = $_POST['frenchfries'];
    $mushroommomos = $_POST['mushroommomos'];
    $total_amount = $_POST['total_amount'];

    $sql = "INSERT INTO foodd (name, number, address, pizza, burger, salad, popcorn, chocopie, wings, pepsi, meatballs, vegburger, vegnuggets, frenchfries, mushroommomos, totalCost) VALUES ('$name', '$number', '$address', '$pizza', '$burger', '$salad', '$popcorn', '$chocopie', '$wings', '$pepsi', '$meatballs', '$vegburger', '$vegnuggets', '$frenchfries', '$mushroommomos', '$total_amount')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = mysqli_query($conn, "DELETE FROM `foodd` WHERE `order_id`='$id' ");
}

$sql = "SELECT * FROM `foodd`";
$query = mysqli_query($conn, $sql);

?>
<html>
<head>
    <title>Success_order</title>
    <style>
        .head {
            background-color: #00bfff;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/litera/bootstrap.min.css" integrity="sha384-enpDwFISL6M3ZGZ50Tjo8m65q06uLVnyvkFO3rsoW0UC15ATBFz3QEhr3hmxpYsn" crossorigin="anonymous">
</head>
<body class="head">
    <h3 class="text-center text-capitalize">All food order details are here !!</h3>
    <table class="table table-bordered" style="background-color:#f0fff0;">
        <tr>
            <th>Date and<br>time</th>
            <th>Customer<br>name</th>
            <th>Customer<br>phno</th>
            <th>Customer<br>address</th>
            <th>Customer<br>order id</th>
            <th>Pizza</th>
            <th>Burger</th>
            <th>Salad</th>
            <th>Popcorn</th>
            <th>Chocopie</th>
            <th>Wings</th>
            <th>Pepsi</th>
            <th>Meatballs</th>
            <th>Veg Burger</th>
            <th>Veg Nuggets</th>
            <th>French Fries</th>
            <th>Mushroom Momos</th>
            <th>Total</th>
            <th>Operations</th>
        </tr>
        <?php
        $num = mysqli_num_rows($query);
        if ($num > 0) {
            while ($result = mysqli_fetch_assoc($query)) {
                echo "<tr>
                    <td>" . $result['date'] . "</td>
                    <td>" . $result['name'] . "</td>
                    <td>" . $result['number'] . "</td>
                    <td>" . $result['address'] . "</td>
                    <td>" . $result['order_id'] . "</td>
                    <td>" . $result['pizza'] . "</td>
                    <td>" . $result['burger'] . "</td>
                    <td>" . $result['salad'] . "</td>
                    <td>" . $result['popcorn'] . "</td>
                    <td>" . $result['chocopie'] . "</td>
                    <td>" . $result['wings'] . "</td>
                    <td>" . $result['pepsi'] . "</td>
                    <td>" . $result['meatballs'] . "</td>
                    <td>" . $result['vegburger'] . "</td>
                    <td>" . $result['vegnuggets'] . "</td>
                    <td>" . $result['frenchfries'] . "</td>
                    <td>" . $result['mushroommomos'] . "</td>
                    <td>" . $result['totalCost'] . "</td>
                    <td>
                        <a href='allcustomer.php?id=" . $result['order_id'] . "' class='btn btn-danger'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='19'>No records found</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="admindash.php" class="btn btn-warning">Go back</a>
</body>
</html>