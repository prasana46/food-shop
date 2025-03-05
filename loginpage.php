<html>
<head>
	<title>Loginpage</title>
	<style>
		.body{
			background-color: #83f7ad;
			

		}
		.align{
			margin-left: 120px;
			margin-top: 240px;
		}
		.lft{
			margin-left: 20px;
		}
		.gap{
			margin-top:20px;
		}
	</style>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/litera/bootstrap.min.css" integrity="sha384-enpDwFISL6M3ZGZ50Tjo8m65q06uLVnyvkFO3rsoW0UC15ATBFz3QEhr3hmxpYsn" crossorigin="anonymous">

	</head>
	<body class="body">
		<form method="post" action="#">
			<center>
			<table class="align">
				<tr>
					<td><label class="gap">Username</label></td>
					<td><input type="text" name="username" class="lft gap" placeholder="enter your username"></td>
				</tr>
				<tr>
					<td><label class="gap">Password</label></td>
					<td><input type="password" name="password" class="lft gap" placeholder="enter your password"><br></td>
				</tr><br>
				<tr>
					<td colspan="2"><center><input type="submit" name="submit"class="btn-success gap" value="submit" ></center></td>
				</tr>
			</table>
		</center>
		</form>
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

	$sql="select * from registration where username='$username' && password='$password' ";
	$result=mysqli_query($conn,$sql);
$row=mysqli_num_rows($result);


if($row>0)
{
header('location:welcome.php');
}


else
{
echo "username or password incorrect";
}
}
mysqli_close($conn);

?>