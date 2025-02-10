<?php
require 'inc/connect.php';
require 'inc/function.php';

session_start();
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '' ) {
	$user_id = $_SESSION['user_id'];
	$user_name = $_SESSION['user_name'];
} else {
	$user_id = '';
	exit("<script>alert('먼저 로그인을 해주세요.');location.href='login.php';</script>");
}

$code = "free";
$search_sel = getGet('search_sel');
$search_txt = getGet('search_txt');

$board_title = getBoardName($code);
$curr_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page']  : 1;
// $base_url = $_SERVER['PHP_SELF'];
$base_url = 'list.php?code='.$code;

$math_params = [":code" => $code];
$where_str = " WHERE code = :code ";

if ( $search_sel != "" && $search_txt != ""){
	$math_params[":search_txt"] = $search_txt;
	switch($search_sel){
		case 's_name': 
			$where_str .= " AND name = :search_txt";
			$base_url .= "&search_sel=s_name&search_txt=".$search_txt;
			break;
		case 's_subject': 
			$where_str .= " AND subject LIKE CONCAT('%',:search_txt,'%')";
			$base_url .= "&search_sel=s_subject&search_txt=".$search_txt;
			break;
		case 's_content': 
			$where_str .= " AND content LIKE CONCAT('%',:search_txt,'%')";
			$base_url .= "&search_sel=s_content&search_txt=".$search_txt;
      break;
	}
}
// print_r("<br>base_url:".$base_url);

$sql = "SELECT count(*) as cnt FROM step1 ".$where_str;
$stmt = $conn->prepare($sql);
$stmt->execute($math_params);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total = $row['cnt']; // total 글수
$per_limit = 5; // 페이지당 글수

$paging = paginate($total, $per_limit, $curr_page, $base_url);

$sql = " SELECT idx, name, subject, rdatetime, file, hit FROM step1 ".$where_str." ORDER BY idx DESC LIMIT ". ( ($curr_page-1) * $per_limit)." , ".$per_limit;

$stmt = $conn->prepare($sql);
$stmt->execute($math_params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $rows = $stmt->fetchAll(PDO::FETCH_NUM);
// print_r($rows);

if ( $curr_page == 1 ) {
	$cnt = 0;
} else{
	$cnt = ($curr_page * $per_limit) - $per_limit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Board with Conditional Scrollbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-responsive-fixed {
            max-height:90vh;
            overflow-y: hidden; /* 기본적으로 스크롤바 숨김 */
        }

        /* 스크롤바 표시를 위한 클래스 */
        .show-scroll {
            overflow-y: auto;
            scrollbar-width: thin; /* Firefox에서 얇은 스크롤바 */
        }

        /* Chrome, Edge, Safari용 스크롤바 설정 */
        .show-scroll::-webkit-scrollbar {
            width: 8px; /* 얇은 스크롤바 */
        }
        .show-scroll::-webkit-scrollbar-thumb {
            background-color: #ccc; /* 스크롤바 색상 */
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .table-responsive-fixed {
                max-height: 60vh;
            }
        }

        @media (max-width: 576px) {
            .table-responsive-fixed {
                max-height: 50vh;
            }
        }

        .sticky-pagination {
            position: sticky;
            bottom: 0;
            background-color: #fff;
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
        }
    </style>

</head>
<body>
<main class="container ">
	<?php include 'header.php'; ?>

	<form name="frmiMain" class="p-4" >
		<div class="d-flex justify-content-between align-items-center mt-5 mb-2">
			<div >
				<a href="write.php" class="btn btn-dark">글작성</a>
			</div>	
			<!-- 검색 -->
			
			<input type="hidden" id="code" name="code" value="<?=$code?>">
			<input type="hidden" id="page" name="page" value="<?=$curr_page?>">
		  <div class="row g-3 mt-3">
				<div class="col-lg-3">
					<select class="form-select" id="search_sel" name="search_sel" value="<?=$search_sel?>">
						<option selected value="">선택</option>
						<option value="s_name" <?= $search_sel == "s_name" ? 'selected':''?>>이름</option>
            <option value="s_subject" <?= $search_sel == "s_subject" ? 'selected':''?>>제목</option>
						<option value="s_content" <?= $search_sel == "s_content" ? 'selected':''?>>내용</option>
          </select>
				</div>
				<div class="col-lg-6"><input type="text" id="search_txt" name="search_txt" class="form-control me-2" placeholder="검색어" value="<?=$search_txt?>"></div>
				<div class="col-lg-3"><button class="btn btn-dark" id="search_btn">검색</button></div>
			</div>
		</div>

    <div class="table-responsive table-responsive-fixed border rounded-3" id="responsiveTable">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>이름</th>
                    <th>제목</th>
                    <th class="d-none d-md-table-cell">조회수</th>
                    <th class="d-none d-md-table-cell">작성일</th>
										<th>첨부파일</th>
                    <th>처리</th>
                </tr>
            </thead>
            <tbody>
                <?php 
									foreach($rows as $row) { 
											$cnt++; 
											$file_img = '';
											if ($row['file'] != ''){
													$file_img = '<img src="img/file_img_new.jpeg" width="20" height="20">';
											}
                ?>
                <tr>
                    <th scope="row"><?= $cnt ?></th>
                    <td><?= htmlspecialchars($row['name']) ?></td>
										<td><a href="edit.php?idx=<?= $row['idx'] ?>"><?= htmlspecialchars($row['subject']) ?></a></td>
                    <td class="d-none d-md-table-cell"><?= (int)$row['hit'] ?></td>
                    <td class="d-none d-md-table-cell"><?= htmlspecialchars($row['rdatetime']) ?></td>
										<td><?= $file_img ?></td>
                    <td>
                        <a href="delete.php?idx=<?= $row['idx'] ?>" 
                           class="btn btn-sm btn-light" 
                           onclick="return confirm('삭제 하시겠습니까?');">
                           삭제
                        </a>
                    </td>
                </tr>
                <?php 
                    } 
                ?>
            </tbody>
        </table>

				<!-- 페이지네이션과 글작성 버튼을 같은 줄에 배치 -->
				<div class="d-flex justify-content-center align-items-center px-2 py-2">
					<div>
							<?php echo $paging; ?>
					</div>
    		</div>
    </div>
	</form>

	<?php include 'footer.php'; ?>
</main>

<script>
	function toggleScrollbar() {
			const table = document.getElementById('responsiveTable');
			if (window.innerHeight < 900) {
					table.classList.add('show-scroll'); // 900px 미만일 경우 스크롤 표시
			} else {
					table.classList.remove('show-scroll'); // 900px 이상일 경우 스크롤 숨김
			}
	}

	// 페이지 로드 및 창 크기 변경 시 스크롤바 토글
	window.addEventListener('load', toggleScrollbar);
	window.addEventListener('resize', toggleScrollbar);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="test.js"></script>
</body>
</html>

