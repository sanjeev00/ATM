<?php

include 'connect.php';

session_start();
if(!isset($_SESSION["auth"]))
	header('location:index.php');
$cardno = $_SESSION["cardno"];



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

		<h1>
Deposit
</h1>
<div class="box">

<?php
if(isset($_POST["submit"]) && $_POST['amount']>0)
{
	$amt  =$_POST["amount"];
	
	
	$qry = "SELECT balance from account where cardno=".$cardno;

	$res = mysqli_query($conn,$qry);
	$row = mysqli_fetch_assoc($res);
	
	$balance = $row["balance"];
	
	$balance += $amt;

	$qry = "UPDATE account SET balance='$balance' where cardno='$cardno'";
	mysqli_query($conn,$qry);
	echo "Deposited Rs".$amt." successfully";

	$now = new DateTime();
		echo $now->format('Y-m-d H:i:s');
		$now =$now-> format('Y-m-d H:i:s');
		$q = "UPDATE account SET balance=".$balance." WHERE cardno=".$cardno;
		mysqli_query($conn,$q);	
		$qry1 = "INSERT into transaction(cardno,timeof,amount,type) values('$cardno','$now','$amt','deposit');";
		mysqli_query($conn,$qry1);

}
else{
	
?>
Enter the amount to deposit
<form method="POST">
	<input type="number" name="amount" required value="0">
	<input type="submit" name="submit" value="Deposit">
</form>
<?php 
if(isset($_POST["submit"]) && $_POST['amount']<=0)
		echo "<p style='color:red'>enter a valid amount</p>";

} ?>
</div>
</body>
</html>