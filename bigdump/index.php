<?php

session_start() ;
// Turn off error reporting
error_reporting(0);
?>
<form method="post">
Server: <input type="text" name="server" required><br>
Database: <input type="text" name="database" required><br>
Username: <input type="text" name="username" required><br>
Password: <input type="text" name="password" required><br>
<input type="Submit" value="Go!">
</form>

<?php
$server = htmlspecialchars($_POST['server']);
$database = htmlspecialchars($_POST['database']);
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$_SESSION['server'] = $server;
$_SESSION['database'] = $database;
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

if ($server != NULL){

	if (isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['server']) && isset($_SESSION['database']) )
	{
    	// menyimpan ke dalam session
	header('location:bigdump.php');
	} 

}

?>