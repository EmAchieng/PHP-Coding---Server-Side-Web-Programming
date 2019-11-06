<?php
	$sys['domain'] = "http://127.0.0.1";
	$sys['name'] = "php 프로그램";
	$sys['var'] = "1.1.3";
	
	// header.php 파일 상단 내용 복사 붙여넣기
	session_start();
	if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
	else $userid = "";
	if (isset($_SESSION["username"])) $username = $_SESSION["username"];
	else $username = "";
	if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
	else $userlevel = "";
	if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
	else $userpoint = "";
?>