<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>write</title>
</head>
<body>
	<form method="post" action="write_ok.php">
		제목 : <input type="text" name="subject"><br>
		이름 : <input type="text" name="name"><br>
		비밀번호 : <input type="password" name="password"><br>
		<textarea name="content" id="content" cols="30" rows="10"></textarea>
		<br>
    <button type="submit">Submit</button>
  </form>
</body>
</html>