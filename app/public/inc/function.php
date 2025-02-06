<?php
require 'inc/config.php';

function getBoardName($code) {
	global $boardNameArr;
	if (!isset($boardNameArr[$code])) {
    return 'Not Define.';
  }

	return $boardNameArr[$code];
}

// # 파일명 만들기 : 날짜및 랜덤숫자 붙여서 파일명 만들기
function makeFileName($file){
	// $tmpArr = explode('.',$file);  // aaa.bbb.jpg --> ['aaa','bbb','jpg']
 	// $ext = strtolower(end($tmpArr)); // jpg (소문자-strtolower)
	// rand(1000, 9999)
	$newFileName = date('ymdHis') . '_' . rand(1000, 9999) . '_' . $file;
	return $newFileName;
}

function getCode($var){
	return ( isset($_GET[$var]) && $_GET[$var] != '' ) ? $_GET[$var] : '';
}

// # 폼 입력값 체크
function getPost($var){
	return ( isset($_POST[$var]) && $_POST[$var] != '' ) ? $_POST[$var] : '';
}

// # 폼 입력값 체크
function getGet($var){
	return ( isset($_GET[$var]) && $_GET[$var] != '' ) ? $_GET[$var] : '';
}


// # 게시판 페이징 처리
function paginate($total_items, $items_per_page = 10, $current_page = 1, $url = '?page=') {
	$total_pages = ceil($total_items / $items_per_page);
	// print_r($total_pages);

	$pagination = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';

	// 이전 페이지 링크
	if ($current_page > 1) {
			$pagination .= '<li class="page-item"><a class="page-link" href="' . $url . ($current_page - 1) . '">이전</a></li>';
	} else {
			$pagination .= '<li class="page-item disabled"><span class="page-link">이전</span></li>';
	}

	// 페이지 번호 링크
	for ($i = 1; $i <= $total_pages; $i++) {
			if ($i == $current_page) {
					$pagination .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
			} else {
					$pagination .= '<li class="page-item"><a class="page-link" href="' . $url . $i . '">' . $i . '</a></li>';
			}
	}

	// 다음 페이지 링크
	if ($current_page < $total_pages) {
			$pagination .= '<li class="page-item"><a class="page-link" href="' . $url . ($current_page + 1) . '">다음</a></li>';
	} else {
			$pagination .= '<li class="page-item disabled"><span class="page-link">다음</span></li>';
	}

	$pagination .= '</ul></nav>';

	return $pagination;
}

// # file download 
function downloadFile($filePath, $originalFileName) {
	if (file_exists($filePath)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . basename($originalFileName) . '"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filePath));
			flush(); // Output buffering 해제
			readfile($filePath);
			exit;
	} else {
			http_response_code(404);
			echo "파일을 찾을 수 없습니다.";
	}
}


?>