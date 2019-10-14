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
Fund Transfer
</h1>
 	<div class="box">

 <?php 


if (isset($_POST["submit"]) && $_POST['amount']>0 && $_POST["accno"] > 0)  {
	# code...
	$accno = $_POST["accno"];
	$isdestvalidqry ="SELECT fname,balance from user join account on user.cardno = account.cardno where accno = '$accno'";
	$res = mysqli_query($conn, $isdestvalidqry);
	$rowdest = mysqli_fetch_assoc($res);
	if ($rowdest["fname"]) {
		$amt  =$_POST["amount"];
		if($amt<=0)
			echo "Enter a valid amount<br>";
		else{
			$qry = "SELECT balance from account where cardno=".$cardno;
			$res = mysqli_query($conn,$qry);

			if($res){
			 	$row = mysqli_fetch_assoc($res);
			 	$balance = $row["balance"]-$amt;
			 	$r=mysqli_fetch_assoc(mysqli_query($conn,"SELECT cardno from account where accno='$accno'"));	
			 		$dcard = $r['cardno'];
			 	if($dcard!=$cardno)
			 	{

			 	if($balance<0){
			 		echo "--> Insufficient funds<br><br>";
			 		echo "--> Transfer to " .$rowdest["fname"]. " failed.<br>";
			 	}else{
			 		echo "--> Transfer of ".$_POST["amount"]. " to " .$rowdest["fname"] . " is Successfull<br><br>";
			 		$now = new DateTime();
			 		echo "--> ";
			 		echo $now->format('Y-m-d H:i:s');
			 		$now =$now-> format('Y-m-d H:i:s');
			 		echo "<br><br>--> Available balance: " . $balance . ".<br>";
			 		$q = "UPDATE account SET balance=".$balance." WHERE cardno=".$cardno;
			 		$destnewbalance = $rowdest["balance"] + $amt;
			 		$qrytoupdatedestbalance = "UPDATE account SET balance=".$destnewbalance." WHERE accno=".$accno;
			 		
			 		$qrytoaddtransdest = "INSERT into transaction(cardno,timeof,amount,type) values('$dcard','$now','$amt','transferin');";
			 		mysqli_query($conn,$q);	
			 		mysqli_query($conn,$qrytoaddtransdest);	
			 		mysqli_query($conn,$qrytoupdatedestbalance);
			 		
			 		$qry1 = "INSERT into transaction(cardno,timeof,amount,type) values('$cardno','$now','$amt','transferout');";
			 		mysqli_query($conn,$qry1);
			 		echo mysqli_error($conn);
			 	}

			}
			else
			{
				echo "<p>Sorry You cannot transfer to your own account</p>";
			}
		}

		}
	}else{
		echo "Invalid Destination AC No!";
	}

}else {?>
 
 <form method="POST">
 	Enter dest AC number <br>
 	<input type="number" name="accno" value="0" required>
 	<br>
 	Enter amount to Transfer <br>
 	<input type="number" name="amount" value="0" required>
 	<br>
 	<input type="submit" name="submit" value="Transfer">
 </form>

<?php 
	if(isset($_POST["submit"]) && $_POST['amount']<=0)
		echo "<p style='color:red'>Enter a valid amount!</p>";

} ?>
</div>
 </body>
 </html>