<?php

require 'connect.php';

// print_r($_POST);
// $subject = $_POST['subject'];
// print_r($subject);

$sql = "INSERT INTO step1 
        SET name=:name, password=:password, subject=:subject, content=:content, rdatetime=NOW()";
$stmt = $conn->prepare($sql);

$arr = [
	':name' => $_POST['name'],
  ':password' => $_POST['password'],
  ':subject' => $_POST['subject'],
  ':content' => $_POST['content']
];
$rs = $stmt->execute($arr);
var_dump($rs);

if ($rs){
	echo "db write success ! <a href='list.php'>list</a>";
} else {
	echo "db write error ! <a href='list.php'>list</a>";
}

?>