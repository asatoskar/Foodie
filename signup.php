<DOCTYPE! html>
<html>
<head>
<title>Sign Up</title>
<script type="text/javascript">
function validate()
{
	var username=document.signup.username.value;
	var password=document.signup.password.value;
	var confirm=document.signup.confirm.value;
	var email=document.signup.email.value;
	var atpos=email.indexOf('@');
	var dotpos=email.lastIndexOf('.');
	
	if(username==""||username==null)
	{
		alert("Please enter username.");
		return false;
	}
	if(password.length>10||password.length<6)
	{
		alert("Please enter valid password.");
		return false;
	}
	if(confirm!=password)
	{
		alert("Passwords do not match. Please enter the same password to confirm it.");
		return false;
	}

	if(email==""||email==null)
	{
		alert("Please enter email address.");
		return false;
	}
if(atpos<0||atpos==0||atpos==(email.length-1)||dotpos<0||dotpos==0||dotpos>(email.length-3))
{
alert("Please enter a valid email address");
return false;
}
return true;
}
</script>
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
<div style="text-align:left;">
<?php
session_start();
if(isset($_SESSION['username']))
{
	echo "You have already signed up.";
}
else
{
	?>
<form name="signup" method="post" action="/signup.php" onsubmit="return validate();">
<table>
<tr><td>Username:</td><td> <input type="text" name="username" /></td></tr>
<tr><td>Password (between 6 and 10 characters):</td><td> <input type="password" name="password"/></td></tr>
<tr><td>Confirm Password:</td><td> <input type="password" name="confirm"/></td></tr>
<tr><td>Email:</td><td><input type="text" name="email" /></td></tr>
</table>
<input type="submit" value="Sign Up" name="submit" class="btn btn-primary"/>
</form>

<?php
if (isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email    = $_POST['email'];
    
    $dbc = mysqli_connect("mysql.2freehosting.com", "u853483434_root", "root123", "u853483434_nutri") or die("Error connecting to database");
    $insert_query = "INSERT INTO signup(username, password, email) VALUES ('$username', '$password', '$email');";
    $select_query = "SELECT * FROM signup WHERE username='".$username."';";
    $select_result = mysqli_query($dbc, $select_query) or die("Error querying database");
    
    if (mysqli_num_rows($select_result)==0)
    {
        $insert_result = mysqli_query($dbc, $insert_query) or die("Error querying database");
        echo 'Your details have been submitted. Update your details <a href="/userdetails.php">here</a>.';
		mysqli_close($dbc);
    }
    else
    {
        echo "That username already exists. Please enter a different username.";
    }
}
}

?>
</div></div><div>
</body>

</html>
