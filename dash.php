<?php

include 'connect.php';
session_start();
if(!isset($_SESSION["auth"]))
	header('location:auth.php');


?>
<html>
<head></head>
	<link rel="stylesheet" type="text/css" href="main.css">

<body>
		<?php  include 'header.php';
	?>	

<div class="dash">

<h2>
Dashboard
</h2>
<ol>

<li><a href="withdraw.php">Withdrawal</a></li>
<li><a href="deposit.php">Deposit</a></li>
<li><a href="pinchange.php">Change Pin</a></li>
<li><a href="transact.php">Dipslay Transactions</a></li>
<li><a href="fundtransfer.php">Funds Transfer</a></li>		
</div>

<div class="box detail">
	<?php
	$cardno =$_SESSION['cardno'];
	$q = "SELECT * from user inner join account on user.cardno=account.cardno inner join bank on account.ifsc=bank.ifsc where user.cardno='$cardno'";
	$res = mysqli_query($conn,$q);
	if($res)
	{
		$row = mysqli_fetch_assoc($res);
		echo "Name <span id='det'>".$row["fname"]." ".$row["lname"]."</span><br>";
		echo "Bank Name<span id='det'>".$row["bankname"]."</span><br>";
		echo "IFSC <span id='det'>".$row["ifsc"]."</span><br>";
		echo "Branch <span id='det'>".$row["branchname"]."</span><br>";
		echo "Balance <b><span id='det'>".$row["balance"]."</b></span><br>";
		echo "A/C No <span id='det'>".$row["accno"]."</span><br>";
	}
	?>
</div>
<script type="text/javascript">
	
document.getElementById('back').hidden=true;

</script>
</body>
</html>