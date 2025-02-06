<?php
require 'inc/connect.php';
require 'inc/function.php';

$idx = getGet('idx');
if ($idx == ''){
	echo "데이터가 없습니다. <a href='index.php?idx=<?=$idx?>'>List</a>";
  exit;
}

$sql = "SELECT file FROM step1 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute([':idx' => $idx]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// print_r($row);

if ($row === false) {
  echo "파일을 찾을 수 없습니다. <a href='index.php?idx=$idx'>List</a>";
  exit;
}

list($file_src, $originalFileName) = explode('|', $row['file']);
$filePath = 'data/' . trim($file_src);

// 파일 다운로드 처리
downloadFile($filePath, $originalFileName);


?>