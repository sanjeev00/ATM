<?php

include 'connect.php';

session_start();
$cardno = $_SESSION["cardno"];



?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
Enter the amount to deposit

<?php
if(isset($_POST["submit"]))
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
<form method="POST">
	<input type="number" name="amount" required value="0">
	<input type="submit" name="submit" value="Deposit">
</form>
<?php } ?>
</body>
</html>