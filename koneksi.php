<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$host = "localhost";
$user = "root";
// $pass = "root-123";
$pass = "";

$db = "takhrij";

try {
    $conn = new PDO(
                        "mysql:host=$host;dbname=$db", 
                        $user, 
                        $pass,
                        [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
                    );
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>