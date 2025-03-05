<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Order</title>
    <style>
        .head {
            background-color: #00bfff;
            margin-top: 250px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/litera/bootstrap.min.css" integrity="sha384-enpDwFISL6M3ZGZ50Tjo8m65q06uLVnyvkFO3rsoW0UC15ATBFz3QEhr3hmxpYsn" crossorigin="anonymous">
</head>
<body class="head">
    <p class="h4 text-center text-capitalize">You have successfully ordered your food and
        you will receive your order with 30 mins.
    </p><br>
    <?php
    if (isset($_POST['total_amount'])) {
        $total_amount = $_POST['total_amount'];
        echo '<p class="h4 text-center text-capitalize">Your total is Rs. ' . $total_amount . '</p>';
        echo '<p class="h4 text-center text-capitalize">Pay with cash on delivery</p>';
    }
    ?>
    <center><a href="homepage.php" class="btn-lg btn-dark text-uppercase h5">Go to login page</a></center><br><br>
    <center><a href="userlogin.php" class="btn-lg btn-dark text-uppercase h5">Home page</a></center><br><br>
    <center><a href="payment.php" class="btn-lg btn-dark text-uppercase h5">Payment</a></center>
</body>
</html>

