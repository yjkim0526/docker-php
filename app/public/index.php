<h2>Hi Nginx</h2>
<br>
<?php echo "php 홈페이지 만들기 ";
/* phpinfo(); */

// print_r($_ENV);
$host = $_ENV['MYSQL_HOST'];
$port = $_ENV['MYSQL_PORT'];
$username = $_ENV['MYSQL_USER'];
$password = $_ENV['MYSQL_PASSWORD'];
$dbname = $_ENV['MYSQL_DATABASE'];


try{
	$pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully ";
} catch (PDOException $e) {
	echo "Connection failed: ". $e->getMessage();
}

