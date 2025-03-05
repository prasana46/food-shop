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

// Insert supplier details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_supplier'])) {
    if (isset($_POST['supplier_id']) && isset($_POST['name']) && isset($_POST['address']) && isset($_POST['item_name']) && isset($_POST['quantity'])) {
        $supplier_id = $_POST['supplier_id'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $item_name = $_POST['item_name'];
        $quantity = $_POST['quantity'];

        $sql = "INSERT INTO suppliers (supplier_id, name, address, item_name, quantity) VALUES ('$supplier_id', '$name', '$address', '$item_name', '$quantity')";
        $conn->query($sql);
    }
}

// Update supplier details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_supplier'])) {
    $id = $_POST['id'];
    $supplier_id = $_POST['supplier_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE suppliers SET supplier_id='$supplier_id', name='$name', address='$address', item_name='$item_name', quantity='$quantity' WHERE id=$id";
    $conn->query($sql);
}

// Delete supplier details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_supplier'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM suppliers WHERE id=$id";
    $conn->query($sql);
}

// Initialize variables
$item_names = [];
$quantities = [];
$units = [];
$amounts = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_names = isset($_POST['item_name']) ? $_POST['item_name'] : [];
    $quantities = isset($_POST['quantity']) ? $_POST['quantity'] : [];
    $units = isset($_POST['unit']) ? $_POST['unit'] : [];
    $amounts = isset($_POST['amount']) ? $_POST['amount'] : [];
}

// Fetch supplier details
$sql = "SELECT * FROM suppliers";
$result = $conn->query($sql);

// Fetch supplier details for editing
$edit_item = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_supplier'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM suppliers WHERE id=$id";
    $edit_result = $conn->query($sql);
    if ($edit_result->num_rows > 0) {
        $edit_item = $edit_result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Details</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-image: linear-gradient(to left, rgb(69, 221, 226),rgb(35, 123, 126),rgb(12, 30, 31),);
        }
        th{
            border: 5px solid black;
            padding: 10px;
            background-color: #00bfff;
            color: white;
        }
        td{
            border: 5px solid black;
            padding: 10px;
            background-color: #f0fff0;
        }
        table{
            
            width: 100%;
        border-color: black;

        }
        label{
            color: white;
        }
        .text-center{
            color: white;
        }
        .form-control
        {
           width: 20%;
          
        }

        </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Supplier Details</h1>
        <form method="post" action="supplier.php" class="mb-4">
            <div class="form-group">
                <label for="supplier_id">Supplier ID</label>
                <input type="text" class="form-control" id="supplier_id" name="supplier_id" value="<?php echo $edit_item ? $edit_item['supplier_id'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $edit_item ? $edit_item['name'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" required><?php echo $edit_item ? $edit_item['address'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="item_name">Item Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="<?php echo $edit_item ? $edit_item['item_name'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $edit_item ? $edit_item['quantity'] : ''; ?>" required>
            </div>
            
            <?php if ($edit_item): ?>
                <input type="hidden" name="id" value="<?php echo $edit_item['id']; ?>">
                <button type="submit" class="btn btn-primary" name="update_supplier">Update Supplier</button>
                <a href="supplier.php" class="btn btn-secondary">Cancel</a>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" name="add_supplier">Add Supplier</button>
            <?php endif; ?>
        </form>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Supplier ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $current_supplier = null;
                    while($row = $result->fetch_assoc()): 
                        if ($current_supplier != $row['supplier_id']):
                            $current_supplier = $row['supplier_id'];
                    ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['supplier_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['item_name']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <form method="post" action="supplier.php" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-warning btn-sm" name="edit_supplier">Edit</button>
                                </form>
                                <form method="post" action="supplier.php" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" name="delete_supplier">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['supplier_id']; ?></td>
                            <td></td>
                            <td></td>
                            <td><?php echo $row['item_name']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <form method="post" action="supplier.php" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-warning btn-sm" name="edit_supplier">Edit</button>
                                </form>
                                <form method="post" action="supplier.php" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" name="delete_supplier">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endif; endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                No suppliers available.
            </div>
        <?php endif; ?>

        <h1 class="text-center">Order received</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($item_names); $i++): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item_names[$i]); ?></td>
                        <td><?php echo htmlspecialchars($quantities[$i]); ?></td>
                        <td><?php echo htmlspecialchars($units[$i]); ?></td>
                        <td><?php echo htmlspecialchars($amounts[$i]); ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="stock.php" class="btn btn-success btn-lg">Back to Stock</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>