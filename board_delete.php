<?php
	include_once './db/db_con.php';
    $num   = $_GET["num"]; // 값이 넘어왔는지 판단하는 로직 필요
    $page   = $_GET["page"];
	
    //$con = mysqli_connect("localhost", "user1", "1234", "sample");
    // 글의 소유권 확인 작업이 필요함
    $sql = "select * from board where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row["file_copied"];

	if ($copied_name)
	{
		$file_path = "./data/".$copied_name;
		unlink($file_path);
    }

    $sql = "delete from board where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'board_list.php?page=$page';
	     </script>
	   ";
?>

