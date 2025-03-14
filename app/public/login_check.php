<?php
	include 'inc/connect.php';
	include 'inc/function.php';
	include 'inc/config.php';

	$code = getPost('code');
	$user_id = getPost('userid');
	$user_passwd = getPost('userpassword');
	// print_r('code', $code);
	// print_r('user_id', $user_id);
	// print_r('user_passwd', $user_passwd);

	if ($user_id == '' || $user_passwd == ''){
		exit("ID 또는 비밀번호를 입력하세요. <a href='login.php'>로그인</a>");
	}

	$sql = "SELECT user_name FROM member_tbl where user_id=:user_id AND user_passwd=:user_passwd";
	// print_r("sql: ".$sql);
	$stmt = $conn->prepare($sql);
	$stmt->execute([':user_id' => $user_id, ':user_passwd' => $user_passwd]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	//var_dump($row);
	if ($row['user_name'] == ''){
		echo "<script>alert('ID 또는 비밀밀번호가 일치하지 않습니다')</script>";
		exit("<script>location.replace('login.php');</script>");
    //exit("<script>alert('ID 또는 비밀밀번호가 일치하지 않습니다');location.href='login.php?code=".$code.";</script>");
	}
	//print_r("로그인 성공 ");
	session_start();
	$_SESSION['user_id'] = $user_id;
	$_SESSION['user_name'] = $row['user_name'];
	exit("<script>location.replace('index.php');</script>");


?>