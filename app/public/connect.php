<?php

// print_r($_ENV);
// print_r($_ENV);

$host = $_ENV['MYSQL_HOST'];
$port = $_ENV['MYSQL_PORT'];
$username = $_ENV['MYSQL_USER'];
$password = $_ENV['MYSQL_PASSWORD'];
$dbname = $_ENV['MYSQL_DATABASE'];

try{
	$conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully ";
} catch (PDOException $e) {
	echo "Connection failed: ". $e->getMessage();
}

?>