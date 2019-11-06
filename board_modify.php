<?php
	include_once './db/db_con.php';
    include_once './config.php';
	$num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];
          
    //$con = mysqli_connect("localhost", "user1", "1234", "sample");
    $sql = "
    		update 
    			board 
    		set 
    			subject='$subject', 
    			content='$content' 
    		";    
    $sql .= " where num='$num'";
    mysqli_query($con, $sql);

    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'board_list.php?page=$page';
	      </script>
	  ";
?>

   
