<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .table th, .table td {
            text-align: center;
        }
        .table thead th {
            background-color: #343a40;
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .card-body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h3>Staff Details</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Salary</th>
                            <th>address</th>
                            <th>email</th>
                            <th>phone number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Sample data
                        $staff = [
                            ['id' => 1, 'name' => 'Prasana Venkatesh', 'position' => 'Cashier', 'salary' => 5000,'address' => 'sellur','email' =>'sprasanakks@gma.com','phone number' => 9524814327],
                            ['id' => 2, 'name' => 'Dinesh', 'position' => 'Manager', 'salary' => 5000,'address' => 'palamedu','email' =>'desh@gma.com','phone number' => 8883856572],
                            ['id' => 3, 'name' => 'Karan Khore', 'position' => 'Chef', 'salary' => 5000,'address' => 'tpk','email' =>'tpk@gma.com.com','phone number' => 7814343435],
                            ['id' => 4, 'name' => 'Rajesh', 'position' => 'Waiter', 'salary' => 5000,'address' => 'sellur','email' =>'raj@yahoo.com','phone number' => 9524814327],
                
                        ];

                        foreach ($staff as $member) {
                            echo "<tr>
                                    <td>{$member['id']}</td>
                                    <td>{$member['name']}</td>
                                    <td>{$member['position']}</td>
                                    <td>{$member['salary']}</td>
                                    <td>{$member['address']}</td>
                                    <td>{$member['email']}</td> 
                                    <td>{$member['phone number']}</td>

                                    <td><button class='btn btn-info btn-sm' data-toggle='modal' data-target='#detailsModal' onclick='showDetails({$member['id']}, \"{$member['name']}\", \"{$member['position']}\", {$member['salary']})'><i class='fas fa-eye'></i> View</button></td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Staff Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> <span id="modalId"></span></p>
                    <p><strong>Name:</strong> <span id="modalName"></span></p>
                    <p><strong>timing:  6pm to 10.30 pm</strong> <span id="modaltiming"></span></p>
               
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function showDetails(id, name, position, salary) {
            document.getElementById('modalId').innerText = id;
            document.getElementById('modalName').innerText = name;
            document.getElementById('modalPosition').innerText = position;
            document.getElementById('modalSalary').innerText = salary;
        }
    </script>
</body>
</html>
