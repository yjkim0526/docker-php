<?php

require 'inc/connect.php';
require 'inc/function.php';

$code = getPost('code');
$name = getPost('name');
$password = getPost('password');
$subject = getPost('subject');
$content = getPost('content');

print_r($code);
/*
Array
(
    [file] => Array
        (
            [name] => cat_img2233.jpeg
            [full_path] => cat_img2233.jpeg
            [type] => image/jpeg
            [tmp_name] => /tmp/phpAbAbLl
            [error] => 0
            [size] => 18383
        )
)
*/

$filename = '';
if ( isset($_FILES['file']['tmp_name']) 
    && $_FILES['file']['tmp_name'] != '' 
    && is_uploaded_file($_FILES['file']['tmp_name']) ) {
    
		$newFileName = makeFileName($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], 'data/'.$newFileName);

		// 서버에 올라가는 파일명 | 원본 파일명 
		$filename = $newFileName . ' | ' . $_FILES['file']['name'];
		
}

print_r($_POST);
$subject = $_POST['subject'];
print_r($subject);

$sql = "INSERT INTO step1 
        SET code=:code, name=:name, password=:password, subject=:subject, content=:content, file=:file, hit=0, rdatetime=NOW()";
$stmt = $conn->prepare($sql);
$arr = [
	':code' => $code,
  ':name' => $name,
  ':password' => $password,
  ':subject' => $subject,
  ':content' => $content,
	':file' => $filename
];

$rs = $stmt->execute($arr);
var_dump($rs);

if ($rs){
  echo '<script>alert("등록 되었습니다");location.href="index.php";</script>';
} else {
  echo "db write error ! <a href='index.php'>list</a>";
}

?>