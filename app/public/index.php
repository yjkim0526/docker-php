<?php
require 'inc/connect.php';
require 'inc/function.php';

session_start();
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '' ) {
	$user_id = $_SESSION['user_id'];
	$user_name = $_SESSION['user_name'];
} else {
	$user_id = '';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Board with Conditional Scrollbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<main class="container ">
  <?php include 'header.php'; ?>

	<div class="container">					
		<h1 class="visually-hidden"></h1>
		<div class="px-4 py-5 my-5 text-center">
			<h1 class="display-5 fw-bold pb-3">PHP 로그인 & 게시판</h1>
			<div class="col-lg-6 mx-auto ">
				<p class="lead pb-4 fw-semibold">Docker Compose + Nginx + Mysql + Php Board</p>
				<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
					<a href="list.php" class="btn btn-dark btn-lg px-4 gap-3">게시판 보기</a>
					<button type="button" class="btn btn-outline-secondary btn-lg px-4">Login Test</button>
				</div>
			</div>
		</div>
		<div class="b-example-divider"></div>
	</div>

	<?php include 'footer.php'; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

