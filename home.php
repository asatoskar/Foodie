<!DOCTYPE html>
<head><title>Daily Profile</title>
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
<form name="foodsubmit" action="/home.php" method="post">
<?php
session_start();
if (isset($_POST['signout']))
{
    unset($_SESSION['username']);
    session_destroy();
}
if (isset($_SESSION['username']))
{
    $username = $_SESSION['username'];
    $dbc = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database.");
	
	$delete_older="DELETE FROM entries WHERE timestamp<SUBDATE(NOW(), INTERVAL 1 WEEK)";
	$delete_result=mysqli_query($dbc,$delete_older) or die("Error querying database1.");
	
	if (isset($_POST['submit']))
    {
        if($_POST['portions']!=0)
		{
		$foodindex  = $_POST['foods'];
		$portions=$_POST['portions'];
        $enter_food = "INSERT INTO entries(username, foodindex, timestamp, portion) VALUES('$username','$foodindex', NOW(),'$portions');";
        $enter_result = mysqli_query($dbc, $enter_food) or die(mysqli_error($dbc));
        echo "Your choice has been submitted<br><br>";
		}
		else
		{
			echo "Please enter a valid portion size.<br><br>";
		}
    }
	
    $select_query = "SELECT * FROM foods;";
    
    $select_result = mysqli_query($dbc, $select_query) or die("Error querying database.");
    
    echo 'Select food: <select name="foods">';
    while ($row = mysqli_fetch_array($select_result))
    {
        echo '<option value="' . $row['ind'] . '">' . $row['foodname'] . '</option>';
    }
    echo '</select><br><br>
	How many 100g portions of this food did you eat?<input type="text" name="portions" value="0"/><br><br>
<input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
<br><br>';


    $select_eaten = "SELECT * FROM entries WHERE DATE(timestamp)=CURDATE() AND username='$username'";
    $result_eaten = mysqli_query($dbc, $select_eaten) or die("Error querying database3.");
	$select_avgcalories="SELECT avgcalories FROM userdetails WHERE userdetails.username='$username'";
	$result_avgcalories=mysqli_query($dbc,$select_avgcalories) or die("Error querying database.");
	$avgcalories=mysqli_fetch_array($result_avgcalories);
	$calories=0;
	$carbs=0;
	$protein=0;
	$fats=0;
        while ($array_eaten = mysqli_fetch_array($result_eaten))
        {
			$index=$array_eaten['foodindex'];
			$portion=$array_eaten['portion'];
            $query_values="SELECT * FROM foods WHERE ind=$index";
			$result_values=mysqli_query($dbc,$query_values) or die(mysqli_error($dbc));
			$array_match=mysqli_fetch_array($result_values);
			$calories+=$portion*$array_match['cal'];
			$carbs+=$portion*$array_match['carb'];
			$protein+=$portion*$array_match['prot'];
			$fats+=$portion*$array_match['fat'];
        }
		echo 'You have consumed '.$calories.' calories today.<br>The average calories you should consume in a day are '.$avgcalories['avgcalories'].'.<br><br>';
		echo 'Today\'s Consumption:<br><br>
		<table>
		<tr>
		<td>Carbohydrates</td>
		<td>'.$carbs.'g</td>
		</tr>
		<tr>
		<td>Protein</td>
		<td>'.$protein.'g</td>
		</tr>
		<tr>
		<td>Fats</td>
		<td>'.$fats.'g</td>
		</tr>
		</table>';
		
		echo '<br><br><input type="submit" name="signout" value="Sign Out" class="btn btn-primary"/><br><br>';
    
    
}
else
    echo "You are not signed in.";
?>
</div></div></div>
<body>
</html>
