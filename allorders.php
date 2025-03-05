<html>
<head>
	<title>view orders</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/litera/bootstrap.min.css" integrity="sha384-enpDwFISL6M3ZGZ50Tjo8m65q06uLVnyvkFO3rsoW0UC15ATBFz3QEhr3hmxpYsn" crossorigin="anonymous">
	<style>
		body{
			background-image: url('images/vieworderbg.jpg');
			background-position:;
			background-size: cover;
			ba
		}
	</style>
	</head>
	<body>
		<center>
			<form  method="post" action="#">
				<table class="table" style="color:white;">
					<tr><td><center>
				<input type="text" name="name" placeholder="Enter your name" ><br><center></td></tr>
				<tr><td><center><input type="text" name="phno" placeholder="Enter your number" ><center></td></tr>
				<tr><td><center><input type="submit" name="submit" value="vieworder"><center></td></tr>
			</form>
			<br>
		
		<table class="table col-sm-6 " style="color:white;" border="10">
<tr>
	<th>Date and Time</th>
	<th>Name</th>
	<th>Number</th>
	<th>Address</th>
	<th>Order id</th>
	<th>Pizza </th>
	<th>Burger</th>
	<th>Salad </th>
	<th>Popcorn </th>
	<th>Chocopie </th>
	<th>Wings </th>
	<th>Pepsi </th>
	<th>Meatballs </th>

<th>Total Cost</th></tr>
</center>
<form method="post" action="#">
	
</form>
	<center>
<a href="vieworder.php" class="btn btn-dark text-uppercase h5">Back</a><br><br>
		<a href="homepage.php" class="btn btn-dark text-uppercase h5">Go to login page</a></center><br>
	<center><a href="userlogin.php" class="btn btn-dark text-uppercase h5">Home page</a></center>
	</body>
</html>
<?php
$servername="localhost";
$username="root";
$password="";
$dbname="foodo";

$conn=mysqli_connect($servername,$username,$password,$dbname);
if(isset($_POST['submit'])){
	
	$name=$_POST['name'];
	$phno=$_POST['phno'];


$sql="select * from foodd where name='$name' && number='$phno'";
$result=mysqli_query($conn,$sql);

if($result->num_rows)
{
	while($row=$result->fetch_assoc()){
		echo "<tr>";
		echo "<td>".$row["date"]."</td>";
		echo "<td>".$row["name"]."</td>";
		echo "<td>".$row["number"]."</td>";
		echo "<td>".$row["address"]."</td>";
		echo "<td>".$row["order_id"]."</td>";
		echo "<td>".$row["pizza"]."</td>";
		echo "<td>".$row["burger"]."</td>";
		echo "<td>".$row["salad"]."</td>";
		echo "<td>".$row["popcorn"]."</td>";
		echo "<td>".$row["chocopie"]."</td>";
		echo "<td>".$row["wings"]."</td>";
		echo "<td>".$row["pepsi"]."</td>";
		echo "<td>".$row["meatballs"]."</td>";
		echo "<td>".$row["totalCost"]."</td>";
		echo "</tr>";
	}

}
else{
	echo "<tr><td colspan='3'>no records found</td></tr>";
}
}
mysqli_close($conn);

?>