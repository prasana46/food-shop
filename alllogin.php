<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/litera/bootstrap.min.css" integrity="sha384-enpDwFISL6M3ZGZ50Tjo8m65q06uLVnyvkFO3rsoW0UC15ATBFz3QEhr3hmxpYsn" crossorigin="anonymous">

<style>
  body{
    background-image: url('img10.jpg');
    
    background-size:cover;
    background-repeat:no-repeat;
    border-collapse:collapse;
  }
    .head{
			background-color: #00bfff;
    
  }
  table{
  	background-color: whitesmoke;
  }
</style>

</head>
<body class="table head">

<?php
$servername="localhost";
$username="root";
$password="";
$dbname="foodo";

$con=mysqli_connect($servername,$username,$password,$dbname);


$sql="select * from registration";
$sql1=mysqli_query($con,$sql);
echo "<h1 class='text-capitalize'>"."<center>"."the user details are here!!!"."</center>"."</h1>";
echo "<table border='2' class='table text-center ' style='margin-top:200px;'>
<tr>
<th>Customer id</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Mobile Number</th>
<th>Username</th>
<th>Edit</th>
<th>Delete</th>
</tr>";
while($disp=mysqli_fetch_array($sql1))
{
echo "<tr>";
echo "<td>".$disp['id']."</td>"; 	
$id=$disp['id'];

echo "<td>".$disp['fname']."</td>"; 	
$fname=$disp['fname'];
echo "<td>".$disp['lname']."</td>";	
$lname=$disp['lname'];
echo "<td>".$disp['email']."</td>";	
$email=$disp['email'];
echo "<td>".$disp['phno']."</td>";	
$phno=$disp['phno'];
echo "<td>".$disp['username']."</td>";	
$username=$disp['username'];
?>
<td><a href="alllogin.php?d=<?php echo $fname;?>"><font color="black" class="btn btn-info">EDIT</font></a></td>
<td><a href="alllogin.php?q=<?php echo $lname;?>"><font color="black" class="btn btn-danger">DELETE</font></a></td>
<?php
echo "</tr>";
}
echo "</table>";




if(isset($_REQUEST['d']))
{ 
$d=$_REQUEST['d'];
$sql2="select * from registration where fname='$d'";
$sql3=mysqli_query($con,$sql2);
while($disp=mysqli_fetch_array($sql3))
{
	$id=$disp['id'];
	$fname=$disp['fname'];
	$lname=$disp['lname'];
	$email=$disp['lname'];
	$college=$disp['email'];
	$phno=$disp['phno'];
	$username=$disp['username'];


?>
<form method="post" >
fNAME:<input type="text" name="fname" value="<?php  echo $fname;?>"  ><br> <br>
lname:<input type="text" name="lname" value="<?php  echo $lname; ?>" ><br><br>
Email:<input type="text" name="email" value="<?php  echo $email; ?>" ><br><br>
phno: <input type="text" name="phno" value="<?php  echo $phno; ?>" ><br><br>
username: <input type="text" name="username" value="<?php  echo $username; ?>" ><br><br>
<input type="submit" value="submit" name="sub"><br>

</form>
<?php 
} 
}
if(isset($_POST["sub"]))
{
$fname=$_POST["fname"];
 $lname=$_POST["lname"];
$email=$_POST["email"];
$phno=$_POST["phno"];
$username=$_POST["username"];

$q1=mysqli_query($con,"update registration set fname='$fname',lname='$lname',email='$email',phno='$phno',username='$username' where fname='$d'");

if($q1>0){
header('location:sccssedit.php');
}
else{
echo "error in edit";
}
}
if(isset($_GET['q']))
{ 
$q=$_GET['q'];
$sql4="delete from registration where lname='$q'";
$sql5=mysqli_query($con,$sql4);
if($sql5)
header('location:sccssdelete.php');
else
echo "delete error";

}

?>
<h4 align="center"><a href="admindash.php" class="btn btn-warning" >back</a></h4><br>

</body>
</html>

