<!DOCTYPE html>

<head>
<title>Weekly Diet Analysis</title>
<link rel="stylesheet" href="\bootstrap-3.3.5-dist\css\bootstrap.min.css" />
<link rel="stylesheet" href="\bootstrap-3.3.5-dist\css\bootstrap-theme.min.css" />
<link rel="stylesheet" href="\css\general.css" />

<style type="text/css">
.days{
	display:table-cell;
	vertical-align:bottom;
	width:210px;
	height:222px;
}

.graph{
    background-color:#ffffff;
	border-bottom:2px solid #000000;
	width:210px;
	height:202px;
	position:relative;
	z-index:-1;
}

.border{
	border-left:2px solid #000000;
	border-bottom:2px solid #000000;
	border-top:2px dashed #E60000;
	width:210px;
	height:200px;
	position:relative;
	z-index:1;
	
}

.recommended{
	position:absolute;
	width:210px;
	bottom:0px;
	border-top:2px dashed #000000;
	z-index:1;
}

.even{
	background-color: #B2E6FF;
	position:absolute;
	bottom:0px;
	width:30px;
	color:#000000;
	text-align:center;
	z-index:0;
}

.odd{
	background-color: #B8DB4D;
	position:absolute;
	bottom:0px;
	width:30px;
	color:#000000;
	text-align:center;
	z-index:0;
}

.over{
	background-color: #E62E8A;
	position:absolute;
	bottom:0px;
	width:30px;
	color:#000000;
	text-align:center;
	z-index:0;
}

.overlay{
	visibility:hidden;
	opacity:0;
	width:300px;
	height:300px;
	overflow:auto;
	background:white;
	border:2px solid #9B8FCD;;
	border-radius:10px;
	position:fixed;
	top:0px;
	left:0px;
	transition:opacity 2s;
	text-align:center;
	z-index:2;
	
}

.overlay:target{
	visibility:visible;
	opacity:1;
	transition:opacity 2s;
	z-index:2;
}

.close{
	background:#9B8FCD;
	color:#ffffff;
	text-decoration:none;
	font-weight:normal;
	position:absolute;
	right:0px;
	top:0x;
	height:30px;
	width:30px;
	border-radius:10px;
}
</style>
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
<ul>
</center>
</nav>
<center><img src="/img/banner.jpg"></center>


<div class="container">
<div class="text">
<div style="text-align:left;">
<?php
session_start();



function fetch_carbs($result)
{
    $carbs = 0;
    $dbc1 = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database1.");
    if (mysqli_num_rows($result) != 0)
    {
        while ($row = mysqli_fetch_array($result))
        {
            $foodindex         = $row['foodindex'];
            $select_entry_food = "SELECT * FROM foods WHERE ind=$foodindex";
            $select_food_result = mysqli_query($dbc1, $select_entry_food) or die("Error querying database1.");
            $result_carbs = mysqli_fetch_array($select_food_result);
            $carbs += $result_carbs['carb'];
        }
        mysqli_close($dbc1);
    }
    return $carbs;
}

function fetch_prot($result)
{
    $protein = 0;
    $dbc1 = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database2.");
    if (mysqli_num_rows($result) != 0)
    {
        while ($row = mysqli_fetch_array($result))
        {
            $foodindex         = $row['foodindex'];
            $select_entry_food = "SELECT * FROM foods WHERE ind=$foodindex";
            $select_food_result = mysqli_query($dbc1, $select_entry_food) or die("Error querying database2.");
            $result_carbs = mysqli_fetch_array($select_food_result);
            $protein += $result_carbs['prot'];
        }
        mysqli_close($dbc1);
    }
    return $protein;
}

function fetch_fat($result)
{
    $fats = 0;
    $dbc1 = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database3.");
    if (mysqli_num_rows($result) != 0)
    {
        while ($row = mysqli_fetch_array($result))
        {
            $foodindex         = $row['foodindex'];
            $select_entry_food = "SELECT * FROM foods WHERE ind=$foodindex";
            $select_food_result = mysqli_query($dbc1, $select_entry_food) or die("Error querying database3.");
            $result_carbs = mysqli_fetch_array($select_food_result);
            $fats += $result_carbs['fat'];
        }
        mysqli_close($dbc1);
    }
    return $fats;
}

function fetch_vita($result)
{
    $vita = 0;
    $dbc1 = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database4.");
    if (mysqli_num_rows($result) != 0)
    {
        while ($row = mysqli_fetch_array($result))
        {
            $foodindex         = $row['foodindex'];
            $select_entry_food = "SELECT * FROM foods WHERE ind=$foodindex";
            $select_food_result = mysqli_query($dbc1, $select_entry_food) or die("Error querying database4.");
            $result_carbs = mysqli_fetch_array($select_food_result);
            $vita += $result_carbs['vita'];
        }
        mysqli_close($dbc1);
    }
    return $vita;
}

function fetch_vitb6($result)
{
    $vitb6 = 0;
    $dbc1 = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database5.");
    if (mysqli_num_rows($result) != 0)
    {
        while ($row = mysqli_fetch_array($result))
        {
            $foodindex         = $row['foodindex'];
            $select_entry_food = "SELECT * FROM foods WHERE ind=$foodindex";
            $select_food_result = mysqli_query($dbc1, $select_entry_food) or die("Error querying database5.");
            $result_carbs = mysqli_fetch_array($select_food_result);
            $vitb6 += $result_carbs['vitb6'];
        }
        mysqli_close($dbc1);
    }
    return $vitb6;
}

function fetch_vitb12($result)
{
    $vitb12 = 0;
    $dbc1 = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database6.");
    if (mysqli_num_rows($result) != 0)
    {
        while ($row = mysqli_fetch_array($result))
        {
            $foodindex         = $row['foodindex'];
            $select_entry_food = "SELECT * FROM foods WHERE ind=$foodindex";
            $select_food_result = mysqli_query($dbc1, $select_entry_food) or die("Error querying database6.");
            $result_carbs = mysqli_fetch_array($select_food_result);
            $vitb12 += $result_carbs['vitb12'];
        }
        mysqli_close($dbc1);
    }
    return $vitb12;
}

function fetch_vitc($result)
{
    $vitc = 0;
    $dbc1 = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database7.");
    if (mysqli_num_rows($result) != 0)
    {
        while ($row = mysqli_fetch_array($result))
        {
            $foodindex         = $row['foodindex'];
            $select_entry_food = "SELECT * FROM foods WHERE ind=$foodindex";
            $select_food_result = mysqli_query($dbc1, $select_entry_food) or die("Error querying database7.");
            $result_carbs = mysqli_fetch_array($select_food_result);
            $vitc += $result_carbs['vitc'];
        }
        mysqli_close($dbc1);
    }
    return $vitc;
}

function fetch_vitd($result)
{
    $vitd = 0;
    $dbc1 = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database8.");
    if (mysqli_num_rows($result) != 0)
    {
        while ($row = mysqli_fetch_array($result))
        {
            $foodindex         = $row['foodindex'];
            $select_entry_food = "SELECT * FROM foods WHERE ind=$foodindex";
            $select_food_result = mysqli_query($dbc1, $select_entry_food) or die("Error querying database8.");
            $result_carbs = mysqli_fetch_array($select_food_result);
            $vitd += $result_carbs['vitd'];
        }
        mysqli_close($dbc1);
    }
    return $vitd;
}

function fetch_ca($result)
{
    $ca = 0;
    $dbc1 = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database9.");
    if (mysqli_num_rows($result) != 0)
    {
        while ($row = mysqli_fetch_array($result))
        {
            $foodindex         = $row['foodindex'];
            $select_entry_food = "SELECT * FROM foods WHERE ind=$foodindex";
            $select_food_result = mysqli_query($dbc1, $select_entry_food) or die("Error querying database9.");
            $result_carbs = mysqli_fetch_array($select_food_result);
            $ca += $result_carbs['ca'];
        }
        mysqli_close($dbc1);
    }
    return $ca;
}

function fetch_fe($result)
{
    $fe = 0;
    $dbc1 = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database10.");
    if (mysqli_num_rows($result) != 0)
    {
        while ($row = mysqli_fetch_array($result))
        {
            $foodindex         = $row['foodindex'];
            $select_entry_food = "SELECT * FROM foods WHERE ind=$foodindex";
            $select_food_result = mysqli_query($dbc1, $select_entry_food) or die("Error querying database10.");
            $result_carbs = mysqli_fetch_array($select_food_result);
            $fe += $result_carbs['fe'];
        }
        mysqli_close($dbc1);
    }
    return $fe;
}

function fetch_na($result)
{
    $na = 0;
    $dbc1 = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database11.");
    if (mysqli_num_rows($result) != 0)
    {
        while ($row = mysqli_fetch_array($result))
        {
            $foodindex         = $row['foodindex'];
            $select_entry_food = "SELECT * FROM foods WHERE ind=$foodindex";
            $select_food_result = mysqli_query($dbc1, $select_entry_food) or die("Error querying database11.");
            $result_carbs = mysqli_fetch_array($select_food_result);
            $na += $result_carbs['na'];
        }
        mysqli_close($dbc1);
    }
    return $na;
}

function showOverWithPopup($day, $nutrient, $nutrient_amount, $position, $username)
{
	$dbc1 = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database1.");
	$select_foods_day="SELECT foodindex FROM entries WHERE timestamp<SUBDATE(NOW(), INTERVAL " . $day . " DAY) AND timestamp>SUBDATE(NOW(), INTERVAL " . ($day + 1) . " DAY) AND username='$username'";
	$day_result=mysqli_query($dbc1,$select_foods_day) or die("Error querying database.");
	echo '<a href="#'.$nutrient.$day.'"><div class="over" style="height:100%; left:'.$position.'px;">'.$nutrient_amount.'</div></a>';
	echo '<div id="'.$nutrient.$day.'" class="overlay"><a class="close" href="#">x</a>';
	echo '<table style="border-collapse: separate; border-spacing: 8px;"><tr><th>Food</th><th>'.$nutrient.'</th></tr>';
	while ($row1 = mysqli_fetch_array($day_result))
        {
            $foodindex         = $row1['foodindex'];
            $select_entry_food = "SELECT * FROM foods WHERE ind=$foodindex";
            $select_food_result = mysqli_query($dbc1, $select_entry_food) or die("Error querying database11.");
			
			while($row2=mysqli_fetch_array($select_food_result))
			{
				echo '<tr><td>'.$row2['foodname'].'</td><td>'.$row2[$nutrient].'</td></tr><br>';
			}
			
        }
		echo '</table></div>';
        mysqli_close($dbc1);
	
}

if (isset($_POST['signout']))
{
    unset($_SESSION['username']);
    session_destroy();
}
if (isset($_SESSION['username']))
{
    $username = $_SESSION['username'];
    $dbc = mysqli_connect('mysql.2freehosting.com', 'u853483434_root', 'root123', 'u853483434_nutri') or die("Error connecting to database.");
    $select_details="SELECT * FROM userdetails WHERE username='$username';";
	$select_all_details=mysqli_query($dbc,$select_details);
	$select_details_result=mysqli_fetch_array($select_all_details);
	if(mysqli_num_rows($select_all_details)!=0)
	{
	$totalcalories=$select_details_result['avgcalories'];
	$weight=$select_details_result['weight'];
	$daily_carbs=0.65*$totalcalories/4;
	$daily_prot=2.5*$weight;
	$daily_fat=0.35*$totalcalories/9;
	$daily_vita=10000;
	$daily_vitb6=100;
	$daily_vitb12=10;
	$daily_vitc=2000;
	$daily_vitd=4000;
	$daily_ca=2500;
	$daily_fe=45;
	$daily_na=2300;
	$rec_carbs=130;
	$rec_prot=0.8*$weight;
	$rec_fat=0.25*$totalcalories/9;
	$rec_vita=3000;
	$rec_vitb6=1.3;
	$rec_vitb12=2.4;
	$rec_vitc=90;
	$rec_vitd=200;
	$rec_ca=1200;
	$rec_fe=15;
	$rec_na=1500;
    $carb    = 0;
    $protein = 0;
    $fats    = 0;
    $vita    = 0;
    $vitb6   = 0;
    $vitb12  = 0;
    $vitc    = 0;
    $vitd    = 0;
    $ca      = 0;
    $fe      = 0;
    $na      = 0;
	
    $i       = 6;
	$position=0;
	echo '<div align="center">
	
<table>
<tr>
<td>Legend:</td></tr>
<td>
<div class="even" style="position:relative; height:30px;"></div>
</td>
<td>
Days 0,-2,-4,-6
</td>
</tr>
<tr>
<td>
<div class="odd" style="position:relative; height:30px;"></div>
</td>
<td>
Days -1,-3,-5
</td>
</tr>
<tr>
<td>
<div class="over" style="position:relative; height:30px;"></div><br>
</td>
<td>
Amount of nutrient consumed is above safe levels. Click on the bar to view that day\'s consumption.
</td>
</tr>
<tr>
<td>
<div class="recommended" style="position:relative; width:30px; height:0px;"></div>
</td>
<td>
Recommended Daily Amount for nutrient
</td>
</tr>
<tr>
<td>
<div style="width:30px; height:0px; border-top:2px dashed #E60000;"></div>
</td>
<td>
Tolerable Upper Limit
</td>
</tr>
<table>
<br>';
	echo '<table> <tr><td>';
	echo '<table><tr><td>
	Carbs consumed during the week in grams.<br></td></tr>
	<tr><td>
	<div class="days"><div class="border"><div class="graph"><div class="recommended" style="height:'.($rec_carbs/$daily_carbs*100).'%;"></div>';
    while ($i >= 0)
    {
        $select_day = "SELECT * FROM entries WHERE timestamp<SUBDATE(NOW(), INTERVAL " . $i . " DAY) AND timestamp>SUBDATE(NOW(), INTERVAL " . ($i + 1) . " DAY) AND username='$username'";
        $result_day = mysqli_query($dbc, $select_day) or die("Error querying database loop.");
        
        $carb    = fetch_carbs($result_day);
		if($carb>=$daily_carbs)
			showOverWithPopup($i,'carb',$carb,$position,$username);
		else{
		if($i%2==0)
			echo '<div class="even" style="height:'.(($carb/$daily_carbs)*100).'%; left:'.$position.'px;">'.$carb.'</div>';
		else
			echo '<div class="odd" style="height:'.(($carb/$daily_carbs)*100).'%; left:'.$position.'px;">'.$carb.'</div>';
		}
	$i--;
	$position+=30;
    }
	$position=0;
	$i=6;
    echo '</div></div><br><table style="text-align:center;"><tr><td width="30">-6</td><td width="30">-5</td><td width="30">-4</td><td width="30">-3</td><td width="30">-2</td><td width="30">-1</td><td width="30">0</tr></table></div></td></tr></table><br><br>';
	echo '</td><td>';
	
	echo '<table><tr><td>
	Proteins consumed during the week in grams. <br></td></tr>
	<tr><td>
	<div class="days"><div class="border"><div class="graph"><div class="recommended" style="height:'.($rec_prot/$daily_prot*100).'%;"></div>';
    while ($i >= 0)
    {
        $select_day = "SELECT * FROM entries WHERE timestamp<SUBDATE(NOW(), INTERVAL " . $i . " DAY) AND timestamp>SUBDATE(NOW(), INTERVAL " . ($i + 1) . " DAY) AND username='$username'";
        $result_day = mysqli_query($dbc, $select_day) or die("Error querying database loop.");
        
        $protein    = fetch_prot($result_day);
		if($protein>=$daily_prot)
			showOverWithPopup($i,'prot',$protein,$position,$username);
		else{
		if($i%2==0)
			echo '<div class="even" style="height:'.(($protein/$daily_prot)*100).'%; left:'.$position.'px;">'.$protein.'</div>';
		else
			echo '<div class="odd" style="height:'.(($protein/$daily_prot)*100).'%; left:'.$position.'px;">'.$protein.'</div>';
		}
	$i--;
	$position+=30;
    }
	$position=0;
	$i=6;
    echo '</div></div><br><table style="text-align:center;"><tr><td width="30">-6</td><td width="30">-5</td><td width="30">-4</td><td width="30">-3</td><td width="30">-2</td><td width="30">-1</td><td width="30">0</tr></table></div></td></tr></table><br><br>';
	
	echo '</td><td>';
	
	echo '<table><tr><td>
	Fats consumed during the week in grams. <br></td></tr>
	<tr><td>
	<div class="days"><div class="border"><div class="graph"><div class="recommended" style="height:'.($rec_fat/$daily_fat*100).'%;"></div>';
    while ($i >= 0)
    {
        $select_day = "SELECT * FROM entries WHERE timestamp<SUBDATE(NOW(), INTERVAL " . $i . " DAY) AND timestamp>SUBDATE(NOW(), INTERVAL " . ($i + 1) . " DAY) AND username='$username'";
        $result_day = mysqli_query($dbc, $select_day) or die("Error querying database loop.");
        
        $fats    = fetch_fat($result_day);
		if($fats>=$daily_fat)
			showOverWithPopup($i,'fat',$fats,$position,$username);
		else{
		if($i%2==0)
			echo '<div class="even" style="height:'.(($fats/$daily_fat)*100).'%; left:'.$position.'px;">'.$fats.'</div>';
		else
			echo '<div class="odd" style="height:'.(($fats/$daily_fat)*100).'%; left:'.$position.'px;">'.$fats.'</div>';
		}
	$i--;
	$position+=30;
    }
	$position=0;
	$i=6;
    echo '</div></div><br><table style="text-align:center;"><tr><td width="30">-6</td><td width="30">-5</td><td width="30">-4</td><td width="30">-3</td><td width="30">-2</td><td width="30">-1</td><td width="30">0</tr></table></div></td></tr></table><br><br>';
	
	echo '</table>';
	
	echo '<table><tr><td>';
	
	echo '<table><tr><td>
	Vitamin B6 consumed during the week in mg. <br></td></tr>
	<tr><td>
	<div class="days"><div class="border"><div class="graph"><div class="recommended" style="height:'.($rec_vitb6/$daily_vitb6*100).'%;"></div>';
    while ($i >= 0)
    {
        $select_day = "SELECT * FROM entries WHERE timestamp<SUBDATE(NOW(), INTERVAL " . $i . " DAY) AND timestamp>SUBDATE(NOW(), INTERVAL " . ($i + 1) . " DAY) AND username='$username'";
        $result_day = mysqli_query($dbc, $select_day) or die("Error querying database loop.");
        
        $vitb6   = fetch_vitb6($result_day);
		if($vitb6>=$daily_vitb6)
			showOverWithPopup($i,'vitb6',$vitb6,$position,$username);
		else{
		if($i%2==0)
			echo '<div class="even" style="height:'.(($vitb6/$daily_vitb6)*100).'%; left:'.$position.'px;">'.$vitb6.'</div>';
		else
			echo '<div class="odd" style="height:'.(($vitb6/$daily_vitb6)*100).'%; left:'.$position.'px;">'.$vitb6.'</div>';
		}
	$i--;
	$position+=30;
    }
	$position=0;
	$i=6;
    echo '</div></div><br><table style="text-align:center;"><tr><td width="30">-6</td><td width="30">-5</td><td width="30">-4</td><td width="30">-3</td><td width="30">-2</td><td width="30">-1</td><td width="30">0</tr></table></div></td></tr></table><br><br>';
	
	echo '</td><td>';
	
echo '<table><tr><td>
	Vitamin B12 consumed during the week in mcg. <br></td></tr>
	<tr><td>
	<div class="days"><div class="border"><div class="graph"><div class="recommended" style="height:'.($rec_vitb12/$daily_vitb12*100).'%;"></div>';
    while ($i >= 0)
    {
        $select_day = "SELECT * FROM entries WHERE timestamp<SUBDATE(NOW(), INTERVAL " . $i . " DAY) AND timestamp>SUBDATE(NOW(), INTERVAL " . ($i + 1) . " DAY) AND username='$username'";
        $result_day = mysqli_query($dbc, $select_day) or die("Error querying database loop.");
        
        $vitb12   = fetch_vitb12($result_day);
		if($vitb12>=$daily_vitb12)
			showOverWithPopup($i,'vitb12',$vitb12,$position,$username);
		else{
		if($i%2==0)
			echo '<div class="even" style="height:'.(($vitb12/$daily_vitb12)*100).'%; left:'.$position.'px;">'.$vitb12.'</div>';
		else
			echo '<div class="odd" style="height:'.(($vitb12/$daily_vitb12)*100).'%; left:'.$position.'px;">'.$vitb12.'</div>';
		}
	$i--;
	$position+=30;
    }
	$position=0;
	$i=6;
    echo '</div></div><br><table style="text-align:center;"><tr><td width="30">-6</td><td width="30">-5</td><td width="30">-4</td><td width="30">-3</td><td width="30">-2</td><td width="30">-1</td><td width="30">0</tr></table></div></td></tr></table><br><br>';
	
	echo '</td><td>';
	
	echo '<table><tr><td>
	Vitamin C consumed during the week in mg. <br></td></tr>
	<tr><td>
	<div class="days"><div class="border"><div class="graph"><div class="recommended" style="height:'.($rec_vitc/$daily_vitc*100).'%;"></div>';
    while ($i >= 0)
    {
        $select_day = "SELECT * FROM entries WHERE timestamp<SUBDATE(NOW(), INTERVAL " . $i . " DAY) AND timestamp>SUBDATE(NOW(), INTERVAL " . ($i + 1) . " DAY) AND username='$username'";
        $result_day = mysqli_query($dbc, $select_day) or die("Error querying database loop.");
        
        $vitc   = fetch_vitc($result_day);
		if($vitc>=$daily_vitc)
			showOverWithPopup($i,'vitc',$vitc,$position,$username);
		else{
		if($i%2==0)
			echo '<div class="even" style="height:'.(($vitc/$daily_vitc)*100).'%; left:'.$position.'px;">'.$vitc.'</div>';
		else
			echo '<div class="odd" style="height:'.(($vitc/$daily_vitc)*100).'%; left:'.$position.'px;">'.$vitc.'</div>';
		}
	$i--;
	$position+=30;
    }
	$position=0;
	$i=6;
    echo '</div></div><br><table style="text-align:center;"><tr><td width="30">-6</td><td width="30">-5</td><td width="30">-4</td><td width="30">-3</td><td width="30">-2</td><td width="30">-1</td><td width="30">0</tr></table></div></td></tr></table><br><br>';
	echo '</td></tr></table>';
	
	
	echo '<table><tr><td>';
	echo '<table><tr><td>
	Vitamin A consumed during the week in IU. <br></td></tr>
	<tr><td>
	<div class="days"><div class="border"><div class="graph"><div class="recommended" style="height:'.($rec_vita/$daily_vita*100).'%;"></div>';
    while ($i >= 0)
    {
        $select_day = "SELECT * FROM entries WHERE timestamp<SUBDATE(NOW(), INTERVAL " . $i . " DAY) AND timestamp>SUBDATE(NOW(), INTERVAL " . ($i + 1) . " DAY) AND username='$username'";
        $result_day = mysqli_query($dbc, $select_day) or die("Error querying database loop.");
        
        $vita    = fetch_vita($result_day);
		if($vita>=$daily_vita)
			showOverWithPopup($i,'vita',$vita,$position,$username);
		else{
		if($i%2==0)
			echo '<div class="even" style="height:'.(($vita/$daily_vita)*100).'%; left:'.$position.'px;">'.$vita.'</div>';
		else
			echo '<div class="odd" style="height:'.(($vita/$daily_vita)*100).'%; left:'.$position.'px;">'.$vita.'</div>';
		}
	$i--;
	$position+=30;
    }
	$position=0;
	$i=6;
    echo '</div></div><br><table style="text-align:center;"><tr><td width="30">-6</td><td width="30">-5</td><td width="30">-4</td><td width="30">-3</td><td width="30">-2</td><td width="30">-1</td><td width="30">0</tr></table></div></td></tr></table><br><br>';
	
	echo '</td><td>';
	echo '<table><tr><td>
	Vitamin D consumed during the week in IU. <br></td></tr>
	<tr><td>
	<div class="days"><div class="border"><div class="graph"><div class="recommended" style="height:'.($rec_vitd/$daily_vitd*100).'%;"></div>';
    while ($i >= 0)
    {
        $select_day = "SELECT * FROM entries WHERE timestamp<SUBDATE(NOW(), INTERVAL " . $i . " DAY) AND timestamp>SUBDATE(NOW(), INTERVAL " . ($i + 1) . " DAY) AND username='$username'";
        $result_day = mysqli_query($dbc, $select_day) or die("Error querying database loop.");
        
        $vitd   = fetch_vitd($result_day);
		if($vitd>=$daily_vitd)
			showOverWithPopup($i,'vitd',$vitd,$position,$username);
		else{
		if($i%2==0)
			echo '<div class="even" style="height:'.(($vitd/$daily_vitd)*100).'%; left:'.$position.'px;">'.$vitd.'</div>';
		else
			echo '<div class="odd" style="height:'.(($vitd/$daily_vitd)*100).'%; left:'.$position.'px;">'.$vitd.'</div>';
		}
	$i--;
	$position+=30;
    }
	$position=0;
	$i=6;
    echo '</div></div><br><table style="text-align:center;"><tr><td width="30">-6</td><td width="30">-5</td><td width="30">-4</td><td width="30">-3</td><td width="30">-2</td><td width="30">-1</td><td width="30">0</tr></table></div></td></tr></table><br><br>';
	echo '</td><tr></table>';
	
	
	echo '<table><tr><td>';
	echo '<table><tr><td>
	Calcium consumed during the week in mg. <br></td></tr>
	<tr><td>
	<div class="days"><div class="border"><div class="graph"><div class="recommended" style="height:'.($rec_ca/$daily_ca*100).'%;"></div>';
    while ($i >= 0)
    {
        $select_day = "SELECT * FROM entries WHERE timestamp<SUBDATE(NOW(), INTERVAL " . $i . " DAY) AND timestamp>SUBDATE(NOW(), INTERVAL " . ($i + 1) . " DAY) AND username='$username'";
        $result_day = mysqli_query($dbc, $select_day) or die("Error querying database loop.");
        
        $ca   = fetch_ca($result_day);
		if($ca>=$daily_ca)
			showOverWithPopup($i,'ca',$ca,$position,$username);
		else{
		if($i%2==0)
			echo '<div class="even" style="height:'.(($ca/$daily_ca)*100).'%; left:'.$position.'px;">'.$ca.'</div>';
		else
			echo '<div class="odd" style="height:'.(($ca/$daily_ca)*100).'%; left:'.$position.'px;">'.$ca.'</div>';
		}
	$i--;
	$position+=30;
    }
	$position=0;
	$i=6;
    echo '</div></div><br><table style="text-align:center;"><tr><td width="30">-6</td><td width="30">-5</td><td width="30">-4</td><td width="30">-3</td><td width="30">-2</td><td width="30">-1</td><td width="30">0</tr></table></div></td></tr></table><br><br>';
	
	echo '</td><td>';
	
	echo '<table><tr><td>
	Iron consumed during the week in mg. <br></td></tr>
	<tr><td>
	<div class="days"><div class="border"><div class="graph"><div class="recommended" style="height:'.($rec_fe/$daily_fe*100).'%;"></div>';
    while ($i >= 0)
    {
        $select_day = "SELECT * FROM entries WHERE timestamp<SUBDATE(NOW(), INTERVAL " . $i . " DAY) AND timestamp>SUBDATE(NOW(), INTERVAL " . ($i + 1) . " DAY) AND username='$username'";
        $result_day = mysqli_query($dbc, $select_day) or die("Error querying database loop.");
        
        $fe   = fetch_fe($result_day);
		if($fe>=$daily_fe)
			showOverWithPopup($i,'fe',$fe,$position,$username);
		else{
		if($i%2==0)
			echo '<div class="even" style="height:'.(($fe/$daily_fe)*100).'%; left:'.$position.'px;">'.$fe.'</div>';
		else
			echo '<div class="odd" style="height:'.(($fe/$daily_fe)*100).'%; left:'.$position.'px;">'.$fe.'</div>';
		}
	$i--;
	$position+=30;
    }
	$position=0;
	$i=6;
    echo '</div></div><br><table style="text-align:center;"><tr><td width="30">-6</td><td width="30">-5</td><td width="30">-4</td><td width="30">-3</td><td width="30">-2</td><td width="30">-1</td><td width="30">0</tr></table></div></td></tr></table><br><br>';
	
	echo '</td><td>';
	
	echo '<table><tr><td>
	Sodium consumed during the week in mg. <br></td></tr>
	<tr><td>
	<div class="days"><div class="border"><div class="graph"><div class="recommended" style="height:'.($rec_na/$daily_na*100).'%;"></div>';
    while ($i >= 0)
    {
        $select_day = "SELECT * FROM entries WHERE timestamp<SUBDATE(NOW(), INTERVAL " . $i . " DAY) AND timestamp>SUBDATE(NOW(), INTERVAL " . ($i + 1) . " DAY) AND username='$username'";
        $result_day = mysqli_query($dbc, $select_day) or die("Error querying database loop.");
        
        $na   = fetch_na($result_day);
		if($na>=$daily_na)
			showOverWithPopup($i,'na',$na,$position,$username);
		else{
		if($i%2==0)
			echo '<div class="even" style="height:'.(($na/$daily_na)*100).'%; left:'.$position.'px;">'.$na.'</div>';
		else
			echo '<div class="odd" style="height:'.(($na/$daily_na)*100).'%; left:'.$position.'px;">'.$na.'</div>';
		}
	$i--;
	$position+=30;
    }
	$position=0;
	$i=6;
    echo '</div></div><br><table style="text-align:center;"><tr><td width="30">-6</td><td width="30">-5</td><td width="30">-4</td><td width="30">-3</td><td width="30">-2</td><td width="30">-1</td><td width="30">0</tr></table></div></td></tr></table><br><br>';
	
	echo '</td></tr></table>';
	
	mysqli_close($dbc);
	
	
	
echo '
<form name="signout" method="post" action="/analysis.php">
<input type="submit" name="signout" value="Sign Out" class="btn btn-primary"/>
</form>';
echo '</div>';
}
else
echo "You have not entered your userdetails! Please update your userdetails.";
}
else
    echo "You are not signed in.";

?>

</div></div></div>
</body>
</html>
