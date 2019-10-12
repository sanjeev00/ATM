<?php

if(isset($_POST["logout"]))
{

	
	session_unset();
	session_destroy();
	header('location:index.php');

}
if(isset($_SESSION['auth']))
{

?>

<form method="POST">
	<input type="submit" name="logout" value="Exit ATM" id="log">

</form>
<button onclick="window.location='dash.php';" id='back'>Back</button>
<?php
}

?>