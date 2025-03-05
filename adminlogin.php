<html>
<head>
	<title>adminlogin</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/litera/bootstrap.min.css" integrity="sha384-enpDwFISL6M3ZGZ50Tjo8m65q06uLVnyvkFO3rsoW0UC15ATBFz3QEhr3hmxpYsn" crossorigin="anonymous">
</head>
	<style>
		body{
			background-image: url('images/adminb.jpg');
			background-size: cover;
			

		}
		.head{
			background-color: #b2beb5;
		}
		.align{
			margin-top: 150px;
			margin-left: 100px;
		}
		
	</style>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/litera/bootstrap.min.css" integrity="sha384-enpDwFISL6M3ZGZ50Tjo8m65q06uLVnyvkFO3rsoW0UC15ATBFz3QEhr3hmxpYsn" crossorigin="anonymous">
</head>
<body>

	<div class="align">
			
			
		<form method="post" action="#">
			<center>
			<table class="text-center table col-sm-2 " >
				<tr>
					<td colspan="2"><p class="h5 text-uppercase text-center head">Admin login</p></td>
				</tr>
					
<tr>
					<td>
						<label ><font class="h6"color="whitesmoke">Username</font></label></td>
					<td><input type="text" name="username" placeholder="&emsp;enter your username" class="rounded"></td>
				</tr>
				<tr>
					<td><label ><font class="h6" color="whitesmoke">Password</font></label></td>
					<td><input type="password" name="password" placeholder="&emsp;enter your password" class="rounded"><br></td>
				</tr><br>
				<tr>
					<td colspan="2"><center><span><input type="submit" name="submit"class="btn btn-success gap" value="Login">&emsp;<font color="whitesmoke";></td>
				</tr>
				<tr>
					<td colspan="2"><center><a href="homepage.php" class="btn btn-dark text-uppercase h5">Go to login page</a></center></td>
				</tr>
			</table>
		</center>
		</form>

	</div>
		</body>
</html>
<?php
$servername="localhost";
$username="root";
$password="";
$dbname="foodo";

$conn=mysqli_connect($servername,$username,$password,$dbname);

if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];

	$sql="select * from registrationadmin where username='$username' && password='$password' ";
	$result=mysqli_query($conn,$sql);
$row=mysqli_num_rows($result);


if($row>0)
{
header('location:admindash.php');
}


else
{
header('location:homepage.php');
}
}
mysqli_close($conn);

?>