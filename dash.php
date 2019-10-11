<?php

include 'connect.php';
session_start();
if(!isset($_SESSION["auth"]))
	header('location:auth.php');


?>
<html>
<body>

<h2>
Dashboard
</h2>
<ol>
<li><a href="withdraw.php">Withdrawal</a></li>
<li><a href="deposit.php">Deposit</a></li>
<li><a href="pinchange.php">Change Pin</a></li>
<li><a href="dash.php?set-limit=1">Set Limit</a></li>	
</body>
</html>