<?php

require 'connect.php';
require 'function.php';

// $idx = isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx']) ? $_GET['idx'] : '';
$idx = getGet('idx');

if ($idx == '') {
	exit('No idx');
}

$sql = "SELECT * FROM step1 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$arr = [':idx' => $idx];
$stmt->execute($arr);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// print_r($row['idx']);
if (!$row){
	exit('No data');
}

$file_link = "";
$file_name = '';
if ($row['file'] != ''){
	list($file_src, $file_name) = explode('|', $row['file']);

	$file_name = trim($file_name);
	// echo '<a href="download.php?idx='.$row['idx'].'">'.$file_name.'</a>';
	$file_link = '<a href="download.php?idx='.$row['idx'].'">'.$file_name.'</a>';
}

$sql = "UPDATE step1 SET hit = hit + 1 WHERE idx=:idx";
$stmt = $conn->prepare($sql);
$stmt->execute($arr);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>detail</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
	
<main>
	<div class="container px-4 py-5" id="featured-3">
		<h3 class="pb-2 border-bottom">View</h3>
		<div class="w-auto p-3 border rounded-3 ">
		
		<form method="post" action="edit_ok.php">
			<input type="hidden" name='idx' value="<?=$row['idx']?>">
			<div class="mt-3 mb-3 row">
					<div class="col-sm-1">
						<label for="name" class="col-form-label">이름</label>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="name" name="name" value="<?=$row['name']?>" required>
					</div>
					<div class="col-sm-1">
						<label for="password" class="col-form-label">password</label>
					</div>
					<div class="col-sm-5">
						<input type="password" class="form-control" id="password" name="password" value="<?=$row['password']?>" required>
					</div>
			</div>

			<div class="mb-3 row">
					<div class="col-sm-1">
						<label for="subject" class="col-form-label">제목</label>
					</div>
					<div class="col-sm-11">
						<input type="text" class="form-control" id="subject" name="subject" value="<?=htmlspecialchars($row['subject'])?>" required>
					</div>
			</div>

			<div class="mb-3 row">
					<div class="col-sm-1">
						<label for="content" class="col-form-label">내용</label>
					</div>
					<div class="col-sm-11">
						<textarea class="form-control" name="content" id="content" rows="10" required><?=$row['content']?></textarea>
					</div>
			</div>

			<?php if ($file_link != ''){ ?>
				<div class="mb-3 row">
					<div class="col-sm-1">
						<label class="form-label" for="file">첨부 파일</label>
					</div>
					<div class="col-sm-6">
						<?=$file_link?>
					</div>
				</div>
			<?php } ?>

			<div class="mb-3 row">
				<div class="d-flex justify-content-center gap-2">
					<a href="list.php"><button type="button" class="btn btn-dark" >List</button></a>
					<button type="submit" class="btn btn-dark" onclick="return confirm('수정 하시겠습니까?');" >edit</button>
					<a href="delete.php?idx=<?=$row['idx']?>" onclick="return confirm('삭제 하시겠습니까?');"><button type="button" class="btn btn-dark" >del</button></a>
				</div>
			</div>
			
		</form>
		</div>
  </div>
</main>
</body>
</html>