<!DOCTYPE html>
<html>
<head>
<script>

function validate()
{

var w=document.userdetails.weight.value;
var h=document.userdetails.height.value;
var age=document.userdetails.age.value;
var g=document.userdetails.gender.value;
var a=document.userdetails.actlevel.value;
var p=document.userdetails.preference.value;

     if(w=="" || w==null || w>300 || w<=0)   
       {
          alert("Please enter a valid weight");
          return false;
       }

    if(h=="" || h==null || h>"300")   
       {
          alert("Please enter a valid height");
          return false;
       }


    if(age=="" || age==null || age>125)   
    {
    alert("Please enter a valid age");
          return false;
       }
 
    if(g=="" || g==null )   
       {
          alert("Please enter a valid gender");
          return false;
       }
 
    if(a=="" || a==null )   
       {
          alert("Please enter a valid activity level");
          return false;
       }
 
    if(p=="" || p==null )   
       {
          alert("Please enter a preference");
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
if (isset($_POST['signout']))
{
    unset($_SESSION['username']);
    session_destroy();
}
if (isset($_SESSION['username']))
{
	$dbc = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database.");
    $username = $_SESSION['username'];
    echo '
    <form name="userdetails" action="/userdetails.php" method="post" onsubmit="return validate()">
    Weight in kgs.:<input type="text" name="weight" ><br><br>
    Height in cms.:<input type="text" name="height" ><br><br>
    Age in years.:<input type="text" name="age"  ><br><br>

    Gender:<br>
    <input type="radio" name="gender" value="1" >Male<br>
    <input type="radio" name="gender" value="2" >Female<br><br>

    Activity Level:<br>
    <input type="radio" name="actlevel" value="1" >No Exercise<br>
    <input type="radio" name="actlevel" value="2" >Little Active<br>
    <input type="radio" name="actlevel" value="3" >Moderately Active<br>
    <input type="radio" name="actlevel" value="4" >Highly Active<br>
    <input type="radio" name="actlevel" value="5" >Extremely Active<br><br>

    Preference:<br>
    <input type="radio" name="preference" value="1" >Veg<br>
    <input type="radio" name="preference" value="2" >Non-Veg<br>

    <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
    
    </form>';
    
    if (isset($_POST['submit']))
    {
        
        $weight     = $_POST['weight'];
        $height     = $_POST['height'];
        $age        = $_POST['age'];
        $gender     = $_POST['gender'];
        $actlevel   = $_POST['actlevel'];
        $preference = $_POST['preference'];
        $avgcalories;
        
        $query    = "SELECT * FROM userdetails WHERE username='$username'";
        $result   = mysqli_query($dbc, $query);
        $rowcount = mysqli_num_rows($result);
		
		if ($gender == 1)
            {
                $bmr = 13.7 * $weight + 5 * $height - 6.8 * $age + 66;
                switch ($actlevel)
                {
                    case 1:
                        $avgcalories = 1.2 * $bmr;
                        break;
                    case 2:
                        $avgcalories = 1.375 * $bmr;
                        break;
                    case 3:
                        $avgcalories = 1.55 * $bmr;
                        break;
                    case 4:
                        $avgcalories = 1.725 * $bmr;
                        break;
                    case 5:
                        $avgcalories = 1.9 * $bmr;
                        break;
                }
                
                
            }
            
            if ($gender == 2)
            {
                $bmr = 9.6 * $weight + 1.8 * $height - 4.7 * $age + 655;
                switch ($actlevel)
                {
                    case 1:
                        $avgcalories = 1.2 * $bmr;
                        break;
                    case 2:
                        $avgcalories = 1.375 * $bmr;
                        break;
                    case 3:
                        $avgcalories = 1.55 * $bmr;
                        break;
                    case 4:
                        $avgcalories = 1.725 * $bmr;
                        break;
                    case 5:
                        $avgcalories = 1.9 * $bmr;
                        break;
                }
            }
        if ($rowcount == 0)
        {
            $query_insert = "INSERT INTO userdetails (username, weight, height, age, gender, actlevel, preference, avgcalories)" . "VALUES ('$username', '$weight', '$height', '$age', '$gender', '$actlevel', '$preference', '$avgcalories')";
            $result_insert = mysqli_query($dbc, $query_insert) or die("Error connecting to database");
            echo 'Registration successful!' . "<br /><br />";
            echo 'The average calories that can be consumed are: ' . ((int)$avgcalories) . "<br /><br />";
        }
		else
		{
			$query_update = "UPDATE userdetails SET userdetails.username='$username', weight=$weight, height=$height, age=$age, gender=$gender, actlevel=$actlevel, preference=$preference, avgcalories=$avgcalories WHERE userdetails.username='$username';";
			$result_update=mysqli_query($dbc,$query_update) or die("Error querying database while updating.");
			echo "Update successful!<br /><br />";
			echo 'The average calories that can be consumed are: ' .((int)$avgcalories) . "<br /><br />";
		}
        
    }
}
else
{
    echo 'You are not signed in.';
}
?>
</div></div></div>
</body>
</html>
