<html>
<head>
	<title></title>
	<style>
		.body{
				background-color:#C2DFFF;
			

		}
		.head{
			background-color:rgb(169, 204, 178);
		}
		.align{
			margin-top: 180px;
			margin-right: 250px;
			margin-left:400px;
		}
		
	</style>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/litera/bootstrap.min.css" 
	integrity="sha384-enpDwFISL6M3ZGZ50Tjo8m65q06uLVnyvkFO3rsoW0UC15ATBFz3QEhr3hmxpYsn" crossorigin="anonymous">

		</head>
		<body class="body">
			<div > 
			<table class="table ">
				<tr>
					<td><table border="1" class="table head "><tr><td>
						<p class="text-uppercase h4 " style="margin-left: 50px;font-family:verdana,sans-serifs;color:black;">GLUTTONY &nbsp;  &nbsp; restaurant</p></td></tr></table></td>
					<td ><div><table border="1" class="h6 font-weight-normal head float-right" style="margin-left:align:right;"><tr><td><a href="adminlogin.php"><font style="color:black;">Admin</font></td><td><a href="aboutus.php"><font style="color:black;">About us</font></a></td></tr><table></div></td>
					
				</tr>
			</table>
		</div>
		<br>
		<div class="align">
			
			
		<form method="post" action="userlogin.php">
			<center>
			<table class="text-center">
				<tr>
					<td colspan="2"><p class="h5 text-uppercase text-center head">login</p></td>
				</tr>
					
<tr>
					<td>
						<label ><font class="h6"color="">Username</font></label></td>
					<td><input type="text" name="username" placeholder="&emsp;enter your username" class="rounded"></td>
				</tr>
				<tr>
					<td><label ><font class="h6" color="whitesmoke">Password</font></label></td>
					<td><input type="password" name="password" placeholder="&emsp;enter your password" class="rounded"><br></td>
				</tr><br>
				<tr>
					<td colspan="2"><center><span><input type="submit" name="submit"class="h5 btn btn-success gap" value="Login">&emsp;<font color="whitesmoke";>if not</font>&emsp;<a class="btn btn-primary" href="registration.php">Register now</a></span></center></td>
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
$dbname="food shop";

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
header('location:userlogin.php');
}


else
{
echo "username or password incorrect";
}
}
mysqli_close($conn);

?>