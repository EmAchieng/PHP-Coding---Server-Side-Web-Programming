<meta charset='utf-8'>
<?php
	include_once "./db/db_con.php";
	include_once './config.php';
	
    $send_id = $_GET["send_id"];

    $rv_id = $_POST['rv_id'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
	$subject = htmlspecialchars($subject, ENT_QUOTES);
	$content = htmlspecialchars($content, ENT_QUOTES);
	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

	if($send_id != $userid) {
		echo("
			<script>
			alert('로그인 후 이용해 주세요! ');
			history.go(-1)
			</script>
			");
		exit;
	}

	//$con = mysqli_connect("localhost", "user1", "1234", "sample");
		
	$sql = "select * from members where id='$rv_id'"; // 보낼곳 아이디가 있는지?
	$result = mysqli_query($con, $sql);
	$num_record = mysqli_num_rows($result);
	
	if($num_record){ // 수신 아이디가 있다면
		//$sql = "insert into message (send_id, rv_id, subject, content,  regist_day) ";
		//$sql .= "values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
		$sql = "
				insert
					message
				set
					send_id = '$send_id', 
					rv_id = '$rv_id', 
					subject = '$subject', 
					content = '$content',  
					regist_day ='$regist_day'
				";
		mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
	} else { // 수신할 아이디가 없다면 돌아가기
		echo("
			<script>
			alert('수신 아이디가 잘못 되었습니다!');
			history.go(-1)
			</script>
			");
		exit;
	}

	mysqli_close($con);                // DB 연결 끊기

	echo "
	   <script>
	    location.href = 'message_box.php?mode=send';
	   </script>
	";
?>

  
