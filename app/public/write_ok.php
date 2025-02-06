<?php

require 'connect.php';

print_r($_FILES);
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

if ( isset($_FILES['file']['tmp_name']) 
    && $_FILES['file']['tmp_name'] != '' 
    && is_uploaded_file($_FILES['file']['tmp_name'] ) ) {
    
		$newFileName = makeFileName($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], 'data/'.$newFileName);

}

function makeFileName($file){
	// $tmpArr = explode('.',$file);  // aaa.bbb.jpg --> ['aaa','bbb','jpg']
 	// $ext = strtolower(end($tmpArr)); // jpg (소문자-strtolower)
	// echo $ext;

	// rand(1000, 9999)
	$newFileName = date('ymdHis') . rand(1000, 9999) . '_' . $file;
  move_uploaded_file($_FILES['file']['tmp_name'], 'data/'.$newFileName);
	echo $newFileName;
	return $newFileName;
  
}

// print_r($_POST);
// $subject = $_POST['subject'];
// print_r($subject);

// $sql = "INSERT INTO step1 
//         SET name=:name, password=:password, subject=:subject, content=:content, rdatetime=NOW()";
// $stmt = $conn->prepare($sql);
// $arr = [
//   ':name' => $_POST['name'],
//   ':password' => $_POST['password'],
//   ':subject' => $_POST['subject'],
//   ':content' => $_POST['content']
// ];

// $rs = $stmt->execute($arr);
// var_dump($rs);

// if ($rs){
//   echo '<script>alert("등록 되었습니다");location.href="list.php";</script>';
// } else {
//   echo "db write error ! <a href='list.php'>list</a>";
// }

?>