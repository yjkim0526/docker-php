<?php

require 'connect.php';

$idx = isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx']) ? $_GET['idx'] : '';

if ($idx == '') {
	exit('No idx');
}

$sql = "DELETE FROM step1 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$arr = [':idx' => $idx]; // array(':idx' => $idx)
$rs = $stmt->execute($arr);
// var_dump($rs);

if($rs){
  echo '<script>location.href="list.php";</script>';
	//header('Location: list.php');
}else{
	echo '삭제시 에러';
  exit;
}

?>
