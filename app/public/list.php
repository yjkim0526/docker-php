
<?php

require 'connect.php';

$sql = " SELECT idx, name, subject, rdatetime FROM step1 ORDER BY idx DESC LIMIT 100 ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//$rows = $stmt->fetchAll(PDO::FETCH_NUM);
//print_r($rows);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h1>List</h1> 
	<a href="write.php">[write]</a>
	<table border="1">
		<tr>
      <th>번호</th>
      <th>이름</th>
      <th>제목</th>
      <th>작성일</th>
			<th></th>
    </tr>
    <?php foreach($rows as $row) {?>
    <tr>
      <td><?= $row['idx'] ?></td>
      <td><?= $row['name'] ?></td>
      <td><a href="view.php?idx=<?=$row['idx']?>"><?= $row['subject'] ?></a></td>
      <td><?php echo $row['rdatetime'];?></td>
			<td><a href="delete.php?idx=<?=$row['idx']?>">del</a></td>
    </tr>
    <?php }?>
  </table>
</body>
</html>