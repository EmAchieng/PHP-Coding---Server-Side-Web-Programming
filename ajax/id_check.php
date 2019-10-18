<?php
	include_once ".db/db_con.php";
	!empty($_POST["id"]) ? $id = $_POST["id"] : $id = "";
	
	$ret["check"] = false;
	
	if($id != "") {
		$sql = "select
					id
				from
					members
				where
					id = '$id'
				
				";
		$result = mysqli_query($con, $query);
		$num    = mysqli_num_rows($result);
		if ($num==0) {
			$ret["check"] = true;
		}
		
		
	}
	echo json_encode($ret);
	
?>