<?php

include 'connect.php';
$flag = 0;
if(isset($_POST["submit"]))
{
session_start();
$cardno = $_POST["cardno"];
$pin = $_POST["pin"];
$query = "SELECT * from user where cardno='$cardno';";
$res = mysqli_query($conn,$query);
echo mysqli_error($conn);
$num = mysqli_num_rows($res);


if($num>0)
{
	$row = mysqli_fetch_array($res);
	echo mysqli_error($conn);
	if($row['attempt']==0)
	{
		$flag = -1;
	}
	else if($row['pin']!=$pin)
	{
		$flag = 1;
	}
	else
	{
		$query = "UPDATE user set attempt=3 where cardno='$cardno'";
		mysqli_query($conn,$query);
		$_SESSION["auth"] = true;
		$_SESSION["cardno"] = $cardno;
		header('location: dash.php');
	}


}
else
	$flag=2;
}


?>


<html>
<head>
	<title></title>
		<link rel="stylesheet" type="text/css" href="main.css">

</head>
<body>
<fieldset>
	<legend>
		Auth
	</legend>
	<form method=POST>
		Card no <input type="text" name="cardno"><br>
		PIN <input type="password" name="pin" maxlength="4" minlength="4"><br>
		<input type="submit" name="submit" value="Authenticate">
		<br>
		<?php 
		if($flag==-1)
		echo "<p style='color:red'>Card blocked Contact bank</p>";
		if($flag==1)
		{
		$att = $row['attempt']-1;
		$query = "UPDATE user set attempt=$att where cardno='$cardno'";
		mysqli_query($conn,$query);
		echo "<p style='color:red'>invalid pin</p>";
		if($att==0)
			echo "<p style='color:red'>Card blocked Contact bank</p>";
		else
			echo "<p style='color:red'>".$att." attempts remmaining</p>";
		}
		if($flag==2)
		echo "<p style='color:red'>No Card found</p>";
?> 	

	</form>
</fieldset>
</body>
</html>
