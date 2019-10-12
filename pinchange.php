<?php 

session_start();
include 'connect.php';
if(!isset($_SESSION["auth"]))
	header('location:index.php');
$cardno = $_SESSION["cardno"];

if(isset($_POST["submit"]))
{
	$pin = $_POST['pin'];
	$query = "UPDATE user SET pin='$pin' where cardno='$cardno'";
	$res = mysqli_query($conn,$query);
	if($res)
		{
		echo "PIN changed successfully";
		
	}
}



?>

<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<?php  include 'header.php';
	?>	
	<div class="box">

<h2>Pin Change</h2>
Enter your new PIN <br>
<form method="POST">
PIN<br> 
<input required type="password" name="pin" id='pin' onkeyup="matchp()" maxlength="4" minlength="4"><br>
Confirm PIN<br>
<input required type="password" name="cpin" id='cpin' onkeyup="matchp()" maxlength="4" minlength="4">
<br>
<p id="match"></p><br>

<input type="submit" name="submit" value="Change" id='but'>
</form>
<script type="text/javascript">
function matchp()
		{
			var  pass = document.getElementById('pin');
			var  cpass = document.getElementById('cpin');
			
			if(cpass.value!=pass.value)
			{
			document.getElementById('match').innerHTML="<p><font color=red>PIN do not match</font></p>";
				document.getElementById('but').disabled=true;
			}
			else
			{
				document.getElementById('match').innerHTML="<p><font color=green>PIN match</font></p>";
				document.getElementById('but').disabled=false;
			}
		}	


</script>
</div>
</body>

</html>

