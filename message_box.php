<?php 
	include_once "./db/db_con.php";
	include_once "./utill/defult_fun.php";
	// 현재 페이지 번호를 확인
	if (isset($_GET["page"]))
		$page = $_GET["page"]; //1,2,3,4,5
	else
		$page = 1;
	
	$mode = !empty($_GET["mode"]) ? $mode = $_GET["mode"] : $mode=""; // send or vr
	$scale = 10; // 한페이지당 10개 목록만 보기
?>
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/message.css">
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
	<div id="main_img_bar">
        <img src="./img/main_img.png">
    </div>
   	<div id="message_box">
	    <h3>
<?php
		if ($mode=="send")
			echo "송신 쪽지함 > 목록보기";
		else
			echo "수신 쪽지함 > 목록보기";
?>
		</h3>
	    <div>
	    	<ul id="message">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">
<?php						
						if ($mode=="send")
							echo "받은이";
						else
							echo "보낸이";
?>
					</span>
					<span class="col4">등록일</span>
				</li>
<?php
	//$con = mysqli_connect("localhost", "user1", "1234", "sample");

	// $userid = "test";
	if ($mode=="send")
		$sql = "select * from message where send_id='$userid' order by num desc";
	else
		$sql = "select * from message where rv_id='$userid' order by num desc";

	$result = mysqli_query($con, $sql);
	
	$total_record = mysqli_num_rows($result); // 전체 글 수 15개 검색

	// 전체 페이지 수($total_page) 계산 (나머지 연산으로 페이지수 +1)
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale); // 나머지가 없을 때     
	else
		$total_page = floor($total_record/$scale) + 1; // 나머지가 있을 때는 +1, 15개 레코드면 total 2페이지
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;  // if page=1 >>> $start = 0 , if page=2 >>> $start = 10    

	$number = $total_record - $start; // 15 - 0 = 15 // 화면에 표시할 레코드 순번
	
	// ($i = 0;      $i < 10;                                $i++)      
   for ($i = $start; $i < $start+$scale && $i < $total_record; $i++){
   	  mysqli_data_seek($result, $i); // 만약 $i=0; >> 0번지로 이동
      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result); // 만약 $i=0; >> 0번지로 이동 >> 레코드를 $row 배열에 담아라 
		/* 
		 *  0번지 레코드 값은 다음과 같음 $row 첨자 배열에 세팅됨
			$row["num"] = "14";
			$row["send_id"] = "test";
			$row["rv_id"] = "GGGG"; 
			$row["subject"] = "테스트 15";
			$row["content"] = "테스트 15";
			$row["regist_day"] = "2019-10-31 (05:39)";
 		*/	
      	            
      // 하나의 레코드 가져오기
	  $num    = $row["num"];
	  $subject     = $row["subject"];
      $regist_day  = $row["regist_day"];

      
	  if ($mode=="send")
	  	$msg_id = $row["rv_id"];
	  else
	  	$msg_id = $row["send_id"];
	  
	  $result2 = mysqli_query($con, "select name from members where id='$msg_id'");
	  $record = mysqli_fetch_array($result2);
	  $msg_name = $record["name"];
	  	  
?>
				<li>
					<span class="col1"><?=$number?></span>
					<span class="col2"><a href="message_view.php?mode=<?=$mode?>&num=<?=$num?>"><?=$subject?></a></span>
					<span class="col3"><?=$msg_name?>(<?=$msg_id?>)</span>
					<span class="col4"><?=$regist_day?></span>
				</li>	
<?php
   	   $number--;
   } // for문 종료 
   mysqli_close($con);
?>
	    	</ul>
			<ul id="page_num"> 	
<?php
	// "이전"이라고 표시할 것인지 판단.
	if ($total_page >= 2 && $page >= 2){ // 토탈페이지가 2이상이고 현재 페이지가 2이상이며 "이전" 표시? 
		$new_page = $page-1;
		echo "<li><a href='message_box.php?mode=$mode&page=$new_page'>◀ 이전</a> </li>";
	}else 
		echo "<li>&nbsp;</li>";
	// "이전"이라고 표시할 것인지 판단 끝
	
	
   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i <= $total_page; $i++){
		if ($page == $i){ // 현재 페이지 번호 링크 안함
			echo "<li><b> $i </b></li>";
		}else{
			echo "<li> <a href='message_box.php?mode=$mode&page=$i'> [$i] </a> <li>";
		}
   	}
   	
   	if ($total_page >= 2 && $page != $total_page){ // 토탈페이지가 2이상이고 그런데 현재 페이지가 토탈페이지 전이라면
		$new_page = $page+1;	
		echo "<li> <a href='message_box.php?mode=$mode&page=$new_page'>다음 ▶</a> </li>";
	}else{ //현재 페이지가 마지막 페이지라면 
		echo "<li>&nbsp;</li>";
	}
?>
			<?php 
				echo getMessagetPaging($page, 10);
			?>
			</ul> <!-- page -->	    	
			<ul class="buttons">
				<li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
				<li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li>
				<li><button onclick="location.href='message_form.php'">쪽지 보내기</button></li>
			</ul>
	</div> <!-- message_box -->
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
