
<?php

require 'connect.php';
require 'function.php';

$curr_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page']  : 1;
// $base_url = $_SERVER['PHP_SELF'];
$base_url = 'list.php'.'?page=';

$sql = "SELECT count(*) as cnt FROM step1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total = $row['cnt']; // total 글수
$per_limit = 10; // 페이지당 글수

// print_r(">> curr_page : ".$curr_page);
// print_r(">> total : ".$total);
$paging = paginate($total, $per_limit, $curr_page, $base_url);

# $sql = " SELECT idx, name, subject, rdatetime, file, hit FROM step1 ORDER BY idx DESC LIMIT ".$per_limit;
$sql = " SELECT idx, name, subject, rdatetime, file, hit FROM step1 ORDER BY idx DESC LIMIT ". ( ($curr_page-1) * $per_limit)." , ".$per_limit;
//echo "<br>".$sql;

$stmt = $conn->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $rows = $stmt->fetchAll(PDO::FETCH_NUM);
// print_r($rows);

if ( $curr_page == 1 ) {
	$cnt = 0;
} else{
	$cnt = $curr_page * $per_limit -10;
}

// print_r(">> cnt : ".$cnt);

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
            max-height: 70vh;
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
                max-height: 50vh;
            }
        }

        @media (max-width: 576px) {
            .table-responsive-fixed {
                max-height: 40vh;
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
<main class="container py-4">
    <h3 class="pb-2 border-bottom">List</h3>

    <div class="table-responsive table-responsive-fixed border rounded-3" id="responsiveTable">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>이름</th>
                    <th>제목</th>
                    <th class="d-none d-md-table-cell">조회수</th>
                    <th class="d-none d-md-table-cell">작성일</th>
                    <th>처리</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $cnt = 0;
                    foreach($rows as $row) { 
                        $cnt++; 
                ?>
                <tr>
                    <th scope="row"><?= $cnt ?></th>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><a href="edit.php?idx=<?= $row['idx'] ?>"><?= htmlspecialchars($row['subject']) ?></a></td>
                    <td class="d-none d-md-table-cell"><?= (int)$row['hit'] ?></td>
                    <td class="d-none d-md-table-cell"><?= htmlspecialchars($row['rdatetime']) ?></td>
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
				<div class="d-flex justify-content-between align-items-center px-2 py-2">
				<div>
            <a href="write.php" class="btn btn-secondary">글작성</a>
        </div>			
        <div>
            <?php echo $paging; ?>
        </div>

    </div>
    </div>


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
</body>
</html>

