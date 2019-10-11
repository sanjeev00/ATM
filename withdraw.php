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
 <?php 


if(isset($_POST["submit"]))

{	
	$amt  =$_POST["amount"];

	$qry = "SELECT balance from account where cardno=".$cardno;

	$res = mysqli_query($conn,$qry);

	if($res)
	{
	$row = mysqli_fetch_assoc($res);
	
	$balance = $row["balance"]-$amt;
	if($balance<0)
		echo "insufficient funds";
	else
	{
		echo "withdraw of ".$_POST["amount"]." successfull<br>";
		$now = new DateTime();
		echo $now->format('Y-m-d H:i:s');
		$now =$now-> format('Y-m-d H:i:s');
		$q = "UPDATE account SET balance=".$balance." WHERE cardno=".$cardno;
		mysqli_query($conn,$q);	
		$qry1 = "INSERT into transaction(cardno,timeof,amount,type) values('$cardno','$now','$amt','withdraw');";
		mysqli_query($conn,$qry1);
		echo mysqli_error($conn);
	}

}

	






}
 else {?>
 Enter amount to withdraw
 <form method="POST">
 	<input type="number" name="amount" value="0" required>
 	<br>
 	<input type="submit" name="submit" value="withdraw">
 </form>
<?php } ?>
 </body>
 </html>