<?php
	include_once "./db/db_con.php";
    $id   = $_POST["id"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email1  = $_POST["email1"];
    $email2  = $_POST["email2"];

    $email = $email1."@".$email2;
    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장 2019-10-17 (15:35)
          
    //$con = mysqli_connect("localhost", "user1", "1234", "sample");
	
	$sql = "insert 
				members 
			set 
				id = '$id' , 
				pass = '$pass', 
				name = '$name', 
				email = '$email', 
				regist_day = '$regist_day', 
				level = '9', 
				point = '0'
			";

/* 
	$sql = "insert into members(id, pass, name, email, regist_day, level, point) ";
	$sql .= "values('$id', '$pass', '$name', '$email', '$regist_day', 9, 0)";
 */
	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>

   
