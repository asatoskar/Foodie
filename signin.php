<html>
<head>
<title>Sign In</title>
<link rel="stylesheet" href="\bootstrap-3.3.5-dist\css\bootstrap.min.css" />
<link rel="stylesheet" href="\bootstrap-3.3.5-dist\css\bootstrap-theme.min.css" />
<link rel="stylesheet" href="\css\general.css" />
</head>

<body>

<nav style="width:100%;"><center>
<ul>
<li><a href="/default.php">Home</a></li>
<li><a href="/foodsearch.php">Food Search</a></li>
<li><a href="/signup.php">Sign Up</a></li>
<li><a href="/signin.php">Sign In</a></li>
<li><a href="/home.php">Daily Profile</a></li>
<li><a href="/analysis.php">Weekly Analysis</a></li>
<li><a href="/userdetails.php">Update Details</a></li>
</ul>
</center>
</nav>
<center><img src="/img/banner.jpg"></center>
<div class="container">
<div class="text">
<?php
$dbc=mysqli_connect('mysql.2freehosting.com','u853483434_root','root123','u853483434_nutri') or die("Error connecting to database");
if(isset($_POST['submit']))
{
$ent_username=$_POST['username'];
$ent_password=$_POST['password'];

$query1="SELECT * FROM signup WHERE username='$ent_username'";

$result1=mysqli_query($dbc,$query1);

$rowcount=mysqli_num_rows($result1);
if($rowcount==0)
{
echo "<h1>That username does not exist.</h1><br>";
}

else
{
$query2="SELECT password FROM signup WHERE username='$ent_username'";
$result2=mysqli_query($dbc,$query2);

while($row=mysqli_fetch_array($result2))
{
  $stored_pass=$row['password'];
}
if($stored_pass==$ent_password)
{
echo 'You have successfully signed in! <a href="/home.php">Click here</a><br>';

session_start();

$_SESSION['username']= $ent_username;

mysqli_close($dbc);

}

}

}

else
{
echo '
<form action="/signin.php" method="post">
Username:<input type="text" name="username" /><br><br>
Password:<input type="password" name="password" /><br><br>
<input type="submit" value="Submit" name="submit" class="btn btn-primary"/>
</form>
';
}
?>
</div></div>
</body>

</html>
