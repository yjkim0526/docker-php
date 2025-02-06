<?php

require 'inc/connect.php';
require 'inc/function.php';

$idx = getGet('idx');
if ($idx == '') {
	exit('No idx');
}

// 파일이 존재 하면 파일 삭제 처리 
$sql = "SELECT file FROM step1 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// print_r($row);

if ($row['file'] != '') {
  list($file_src, $originalFileName) = explode('|', $row['file']);
	$filePath = 'data/' . trim($file_src);

	if (file_exists($filePath)) {
    unlink($filePath); // 파일 삭삭제
  }
}

// DB 데이터 삭제제
$sql = "DELETE FROM step1 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$arr = [':idx' => $idx]; // array(':idx' => $idx)
$rs = $stmt->execute($arr);
// var_dump($rs);

if($rs){
  echo '<script>location.href="index.php";</script>';
	//header('Location: index.php');
}else{
	echo '삭제시 에러';
  exit;
}

?>
