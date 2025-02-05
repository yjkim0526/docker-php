<?php

require 'connect.php';

$idx = isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx']) ? $_GET['idx'] : '';

if ($idx == '') {
	exit('No idx');
}

$sql = "SELECT * FROM step1 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$arr = [':idx' => $idx];
$stmt->execute($arr);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

print_r($row['idx']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>detail</title>
</head>
<body>
	
	<h1><?=$row['subject']?></h1>
	<p><?=$row['name']?></p>
	<p><?=$row['rdatetime']?></p>
	<div><?=nl2br($row['content'])?></div>
	<a href="list.php">목록</a> | <a href="edit.php?idx=<?=$idx?>">수정</a> | <a href="delete.php?idx=<?=$idx?>">del</a>

</body>
</html>