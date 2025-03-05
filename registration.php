<html>
<head>
	<title>Registration</title>
	<style>
		body{
			background-image: url('images/registerbg.jpg');
			background-size: cover;
			background-position: center;


		}
		.align{
			margin-top:120px;
		}
		.lft{
			margin-right: 200px;
			text-align: left;
		}
		.head{
			color: #f5fffa;
			font-size: 25px;
			margin-left: 200px;
		}
	</style>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/litera/bootstrap.min.css" integrity="sha384-enpDwFISL6M3ZGZ50Tjo8m65q06uLVnyvkFO3rsoW0UC15ATBFz3QEhr3hmxpYsn" crossorigin="anonymous">

</head>
	<body>
		<background image>
		<form method="post" action="#">
			<center>
		<table class="table align text-center">
			<tr>
				<td>
					<label class="head">First name</label>
				</td>
					<td class="float-left"><input type="text" name="firstname" placeholder="&emsp;enter your first name" class="rounded lft">
				</td><br>
			</tr>
			

			<tr>
				<td>
					<label class="head">Last name</label>
				</td>
					<td class="float-left"><input type="text" name="lastname" placeholder="&emsp;enter your last name" class="rounded lft">
				</td>
			</tr>
			<tr>
				<td>
					<label class="head">Email</label>
				</td>
					<td class="float-left"><input type="email" placeholder="&emsp;enter your email id" name="email" class="rounded lft">
				</td>
			</tr>
			<tr>
				<td><label class="head">Contact number</label>
			</td>
				<td class="float-left"><input type="text" name="phno" placeholder="&emsp;enter your ph number" class="rounded lft">
				</td>
			</tr>

			
			
			<tr>
				<td>
					<label class="head">Username</label>
				</td>
					<td class="float-left"><input type="text" placeholder="&emsp;enter your user name"name="username" class="rounded lft">
				</td>
			</tr>

			<tr>
				<td>
					<label class="head">Password</label>
				</td>
					<td class="float-left"><span style="color:white;">(password must contain three special characters)</span><br><input type="password" name="password" placeholder="&emsp;enter your Password" class="rounded lft">
				</td>
			</tr>
			<tr>
				<td>
				</td>
			</tr>

			<tr>
				<td colspan="2"><input type="submit" name="submit" value="submit" style="margin-left: 120px;" class="btn btn-success">
				</td>
			</tr>
			<tr>
				<td colspan="2"><center><a href="homepage.php" class="btn-lg btn-dark text-uppercase h5">Go to login page</a></center></td>
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
	$fname=$_POST['firstname'];
	$lname=$_POST['lastname'];
	$email=$_POST['email'];
	$phno=$_POST['phno'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$err=0;





$sql="INSERT INTO `registration`(`fname`, `lname`, `email`, `phno`, `username`, `password`) VALUES ('$fname','$lname','$email','$phno','$username','$password')";
//firstname
if($fname=="")
  {
     $name_err="enter your name";
      $err=1;
  }
else if($fname!="")
  {
   if(!preg_match("/^[A-Za-z]{3,20}$/",$fname))
    {
	   $name_err1="enter a valid name";
	   $err=1;
    }  
  }
  //lastname

    if($lname=="")
  {
     $name_err2="enter your name";
      $err=1;
  }
else if($lname!="")
  {
   if(!preg_match("/^[A-Za-z]{3,20}$/",$lname))
    {
	   $name_err3="enter a valid name";
	   $err=1;
    }  
  }
//email
    if($email=="")
  {
     $mail_err="enter your mail ID";
	 $err=1;
	 
  }
  else if($email!="")
  {
     if(!preg_match(" /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$email))
	 {
	    $mail_err1="enter your valid email id";
		$err=1;
	 }
  }
  
  
   if($phno=="")
  {
     $phno_err="enter your Phone Number";
	 $err=1;
	 
  }
  else if($phno!="")
  {
     if(!preg_match("/^[0-9]{10,15}$/",$phno))
	 {
	    $phno_err1="enter your valid Phone numbers";
		$err=1;
	 }
  }

    if($username=="")
  {
     $uname_err="enter your Username";
      $err=1;
  }
else if($username!="")
  {
   if(!preg_match("/^[A-Za-z]{3,20}$/",$username))
    {
	   $username_err1="enter a valid name";
	   $err=1;
    }  
  }
  
  
  if($password=="")
  {
     $password_err="enter your password";
	 $err=1;
	 
  }
  else if($password!="")
  {
    $length=6;
	if(strlen($password)<$length)
	 {
	   $password_err1="enter the password must.$length.character long";
	   $err=1;
	  }
}   

  


  if($err==0){

$result=mysqli_query($conn,$sql);
if($result)
{
	header('location:scssregister.php');

}
else
{
	echo "data not submitted";
}
}
}
mysqli_close($conn);
?>