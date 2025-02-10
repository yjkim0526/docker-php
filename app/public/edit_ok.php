<?php

require 'inc/connect.php';

print_r($_POST);
// $subject = $_POST['subject'];
// print_r($subject);

$idx = isset($_POST['idx']) && $_POST['idx'] != '' && is_numeric($_POST['idx']) ? $_POST['idx'] : '';
if ($idx == '') {
	exit('No idx');
}
print_r($idx);

$sql = "UPDATE step1 
        SET name=:name, password=:password, subject=:subject, content=:content, udatetime=NOW()
				WHERE idx=:idx";

$stmt = $conn->prepare($sql);
$arr = [
	':name' => $_POST['name'],
  ':password' => $_POST['password'],
  ':subject' => $_POST['subject'],
  ':content' => $_POST['content'],
	':idx' => $idx
];

$rs = $stmt->execute($arr);
print_r($rs);

if ($rs){
	echo '<script>location.href="list.php";</script>';
}

?>