
<?php

require 'connect.php';

$sql = " SELECT idx, name, subject, rdatetime FROM step1 ORDER BY idx DESC LIMIT 100 ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//$rows = $stmt->fetchAll(PDO::FETCH_NUM);
//print_r($rows);
$cnt = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<main>

	<div class="container px-4 py-5" id="featured-3">
		<h3 class="pb-2 border-bottom">List</h3>

		<div class="mt-3 p-3 border rounded-3 ">
			<div class="d-flex justify-content-end">
				<a href="write.php" class="btn btn-secondary">글작성</a>
			</div>

			<table class="table">
			<thead>
				<tr>
					<th>No.</th>
					<th>이름</th>
					<th>제목</th>
					<th>작성일</th>
					<th>처리</th>
				</tr>
				</thead>
				<tbody>
				<?php 

					foreach($rows as $row) {
						$cnt = $cnt + 1;
				?>
				<tr>
				<th scope="row"><?= $cnt ?></td>
					<td><?= $row['name'] ?></td>
					<td><a href="edit.php?idx=<?=$row['idx']?>"><?= $row['subject'] ?></a></td>
					<td><?php echo $row['rdatetime'];?></td>
					<td><a href="delete.php?idx=<?=$row['idx']?>" onclick="return confirm('Are you sure you want to delete this ?');"
					>del</a></td>
				</tr>
				<?php 
					}
				?>
				</tbody>
			</table>
		
			<div class="mt-3">
				<nav aria-label="Page navigation">
					<ul class="pagination justify-content-center">
						<li class="page-item"><a class="page-link" href="#">Previous</a></li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item"><a class="page-link" href="#">Next</a></li>
					</ul>
				</nav>	
			</div>
		</div>
	</div>
</main>
</body>
</html>