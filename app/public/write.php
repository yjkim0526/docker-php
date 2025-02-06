<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>write</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
	<main>
	<div class="container px-4 py-5" id="featured-3">
		<h3 class="pb-2 border-bottom">Write</h3>

		<div class="w-auto p-3 border rounded-3 ">
		<form method="post" enctype="multipart/form-data" action="write_ok.php">
			<div class="mt-3 mb-3 row">
					<div class="col-sm-1">
						<label for="name" class="col-form-label">Name</label>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="name" name="name" required >
					</div>
					<div class="col-sm-1">
						<label for="password" class="col-form-label">Password</label>
					</div>
					<div class="col-sm-5">
						<input type="password" class="form-control" id="password" name="password" required>
					</div>
			</div>

			<div class="mb-3 row">
					<div class="col-sm-1">
						<label for="subject" class="col-form-label">Title</label>
					</div>
					<div class="col-sm-11">
						<input type="text" class="form-control" id="subject" name="subject" required>
					</div>
			</div>

			<div class="mb-3 row">
					<div class="col-sm-1">
						<label for="content" class="col-form-label">Content</label>
					</div>
					<div class="col-sm-11">
						<textarea class="form-control" name="content" id="content" rows="10" required></textarea>
					</div>
			</div>

			<div class="mb-3 row">
				<div class="col-sm-1">
					<label class="form-label" for="file">첨부 파일</label>
				</div>
				<div class="col-sm-6">
					<input type="file" class="form-control" name="file" id="file" />
				</div>
			</div>

			<div class="mb-3 row">
				<div class="d-flex justify-content-center gap-2">
					<a href="index.php"><button type="button" class="btn btn-dark" >List</button></a>
					<button type="submit" class="btn btn-dark" >Submit</button>
				</div>
			</div>
			
		</form>
		</div>
  </div>
	</main>

</body>
</html>