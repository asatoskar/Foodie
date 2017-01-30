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
$foods_query="SELECT * FROM foods;";
$result_foods=mysqli_query($dbc,$foods_query);
echo '<form action="/foodsearch.php" method="post">
<select name="foodindex">';
while($row=mysqli_fetch_array($result_foods))
{
	echo '<option value="'.$row['ind'].'">'.$row['foodname'].'</option>';
}
echo '</select>
<input type="submit" name="submit" value="Get Details" class="btn btn-primary">';
if(isset($_POST['submit']))
{
$foodindex=$_POST['foodindex'];
$select_food="SELECT * FROM foods WHERE ind=$foodindex";
$result_food=mysqli_query($dbc, $select_food);
echo '<table style="border-collapse: separate; border-spacing: 8px; text-align:center; font-size:12px; font-weight:normal;"><tr><th>Food</th><th>Calories</th><th>Carbs(g)</th><th>Fats(g)</th><th>Proteins(g)</th><th>Vit A(IU)</th><th>Vit B6(mg)</th><th>Vit B12(mcg)</th><th>Vit C(mg)</th><th>Vit D(IU)</th><th>Calcium(mg)</th><th>Iron(mg)</th><th>Sodium(mg)</th></tr><tr>';
while($row=mysqli_fetch_array($result_food))
{
	echo '<td>'.$row['foodname'].'</td><td>'.$row['cal'].'</td><td>'.$row['carb'].'</td><td>'.$row['fat'].'</td><td>'.$row['prot'].'</td><td>'.$row['vita'].'</td><td>'.$row['vitb6'].'</td><td>'.$row['vitb12'].'</td><td>'.$row['vitc'].'</td><td>'.$row['vitd'].'</td><td>'.$row['ca'].'</td><td>'.$row['fe'].'</td><td>'.$row['na'].'</td>';
}
echo '</tr></table>';
}

?>
</div></div>
</body>

</html>
