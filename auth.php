<?php

include 'connect.php';
if(isset($_POST["submit"]))
{
session_start();

$cardno = $_POST["cardno"];
$pin = $_POST["pin"];
$query = "SELECT * from user where cardno='".$cardno."';";
echo $query;
$res = mysqli_query($conn,$query);
print "query suc";
$num = mysqli_num_rows($res);
print $num;
echo mysqli_error($conn);
if($num>0)
{
	print "user";
	$row = mysqli_fetch_array($res);
	echo mysqli_error($conn);
	if($row['pin']!=$pin)
	{
		echo "invalid pin";
	}
	else
	{
		$_SESSION["auth"] = true;
		$_SESSION["cardno"] = $cardno;
		header('location: dash.php');
	}

}
}


?>


<html>
<head>
	<title></title>
</head>
<body>
<fieldset>
	<legend>
		Auth
	</legend>
	<form method=POST>
		Card no <input type="text" name="cardno"><br>
		PIN <input type="password" name="pin" maxlength="4" minlength="4">
		<input type="submit" name="submit" value="Authenticate">
	</form>
</fieldset>
</body>
</html>
