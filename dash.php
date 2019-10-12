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
<div class="box">

<h2>
Dashboard
</h2>
<ol>
<li><a href="withdraw.php">Withdrawal</a></li>
<li><a href="deposit.php">Deposit</a></li>
<li><a href="pinchange.php">Change Pin</a></li>
<li><a href="transact.php">Dipslay Transactions</a></li>	
</div>
</body>
</html>