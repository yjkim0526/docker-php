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
	
	<form method="post" action="edit_ok.php">
		<input type="hidden" name='idx' value="<?=$row['idx']?>">
		제목 : <input type="text" name="subject" value="<?=$row['subject']?>"><br>
		이름 : <input type="text" name="name" value="<?=$row['name']?>"><br>
		비밀번호 : <input type="password" name="password" value="<?=$row['password']?>"><br>
		<textarea name="content" id="content" cols="30" rows="10"><?=nl2br($row['content'])?></textarea>
		<br>
    <button type="submit">수정하기</button>
  </form>

</body>
</html>