<?php

session_start();
include 'connect.php';
if(!isset($_SESSION["auth"]))
	header('location:index.php');
$cardno = $_SESSION["cardno"];






?>

<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" type="text/css" href="main.css">

</head>
<body>
	<?php  include 'header.php';
	?>	
	<form method="POST">
		Number of Transactions
		<input type="number"  name="count" value="5" min="1">
		<input type="submit" name="submit" value="Display">
		
	</form>
<br>
<?php

if(isset($_POST["submit"]))
{
	$no = $_POST["count"];
	$qry = "SELECT * from transaction where cardno='$cardno' order by timeof desc LIMIT $no; ";
	$res = mysqli_query($conn,$qry);
	echo mysqli_error($conn);
	if($res)
	{	
		echo "<table cellspacing=0>";
		echo "<tr><th>Time of Transactions</th><th>Amount</th><th>Type</th><th>Card no</th></tr>";
		while($row = $res->fetch_assoc()) {

			if($row['type']=="withdraw")
				echo "<tr id='red'>";
			else
				echo "<tr id='green'>";

        echo "<td>" . $row["timeof"]. "</td><td> " . $row["amount"]. "</td><td> ".$row["type"]. "</td><td>".$row["cardno"]."</td></tr>";

    }
    	echo "</table>";

	}

}

?>
</body>
</html>