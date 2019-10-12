<?php

include 'connect.php';
$flag = 0;
if(isset($_POST["submit"]))
{
session_start();
$cardno = $_POST["cardno"];
$pin = $_POST["pin"];
$query = "SELECT * from user where cardno='".$cardno."';";
$res = mysqli_query($conn,$query);

$num = mysqli_num_rows($res);


if($num>0)
{
	$row = mysqli_fetch_array($res);
	echo mysqli_error($conn);
	if($row['pin']!=$pin)
	{
		$flag = 1;
	}
	else
	{
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
		<?php if($flag==1)
		echo "<p style='color:red'>invalid pin</p>";
		if($flag==2)
		echo "<p style='color:red'>No Card found</p>";
?> 

	</form>
</fieldset>
</body>
</html>
