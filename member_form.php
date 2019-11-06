<?php 
	include_once './config.php';
?>
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문-<?=$sys['name']?></title>
<link rel="stylesheet" type="text/css" href="./css/common.css?var=<?=$sys['var']?>">
<link rel="stylesheet" type="text/css" href="./css/member.css?var=<?=$sys['var']?>">
<script src="./js/jquery-1.10.2.js?var=<?=$sys['var']?>"></script>	
<script>
	$(function(){
		$("#id").blur(function(){
			if($(this).val() == ""){
				$("#id_check_msg").html("아이디를 입력 해주세요.").css("color","red").attr("data-check","0");
			}else{
				checkIdAjax();
			}	
		}); // input id='id' 애에 포커스가 잃어 버릴때 발생하는 이벤트
	}); //문서가 로드되면

	function checkIdAjax(){
		// id 값을 post로 전송해서 서버와 통신하여 중복 결과 json 형태로 받아오는 함수
		$.ajax({
			url : "./ajax/check_id.php",
			type : "post",
			dataType : "json",
			data : {
				"id" : $("#id").val()
			},
			success : function(data){
				// {"check":false,"id":"kkk","name":"\ud64d\uae38\ub3d9","hacjum":{"com":"A","server":"A+","db":"C"}}
				// alert(data.hacjum[0].com);
				// alert(data.hacjum[1].com);
				
				if(data.check){
					$("#id_check_msg").html("사용 가능한 아이디 입니다.").css("color","blue").attr("data-check","1");
				}else{
					$("#id_check_msg").html("중복된 아이디 입니다.").css("color","red").attr("data-check","0");
				}
			}
		});
	}
/* 
    <div class="col2">
		<input type="text" name="id" id="id" style="width: 150px;">
		&nbsp;
		<span id="id_check_msg" data-check="0"></span>
	</div> 	
	
 */
	
	$(function(){
		$("#save_frm").click(function(){
			check_input();
		});
	});


   function check_input(){

	  // document.member_form.id.value == $("#id").val() 
      if (!$("#id").val()) {
          alert("아이디를 입력하세요!");    
          //document.member_form.id.focus();
          $("#id").focus();
          return;
      }

      if($("#id_check_msg").attr("data-check") == "0"){
          alert("아이디 중복 다시 하십시요.");    
          $("#id").focus();
          return;		
      }

      if (!document.member_form.pass.value) {
          alert("비밀번호를 입력하세요!");    
          document.member_form.pass.focus();
          return;
      }

      if (!document.member_form.pass_confirm.value) {
          alert("비밀번호확인을 입력하세요!");    
          document.member_form.pass_confirm.focus();
          return;
      }

      if (!document.member_form.name.value) {
          alert("이름을 입력하세요!");    
          document.member_form.name.focus();
          return;
      }

      if (!document.member_form.email1.value) {
          alert("이메일 주소를 입력하세요!");    
          document.member_form.email1.focus();
          return;
      }

      if (!document.member_form.email2.value) {
          alert("이메일 주소를 입력하세요!");    
          document.member_form.email2.focus();
          return;
      }

      if (document.member_form.pass.value != 
            document.member_form.pass_confirm.value) {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
          document.member_form.pass.focus();
          document.member_form.pass.select();
          return;
      }
		$("#member_form").submit();
      //document.member_form.submit();
   }

   function reset_form() {
      document.member_form.id.value = "";  
      document.member_form.pass.value = "";
      document.member_form.pass_confirm.value = "";
      document.member_form.name.value = "";
      document.member_form.email1.value = "";
      document.member_form.email2.value = "";
      document.member_form.id.focus();
      return;
   }

   function check_id() {
     window.open("member_check_id.php?id=" + document.member_form.id.value,
         "IDcheck",
          "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
   }
</script>
</head>
<body> 
	<header>
    	<?php include "header.php";?>
    </header>
	<section>
		<div id="main_img_bar">
            <img src="./img/main_img.png">
        </div>
        <div id="main_content">
      		<div id="join_box">
          	<form  name="member_form" id="member_form" method="post" action="member_insert.php">
			    <h2>회원 가입</h2>
    		    	<div class="form id">
				        <div class="col1">아이디</div>
				        <div class="col2">
							<input type="text" name="id" id="id" style="width: 150px;">
							&nbsp;
							<span id="id_check_msg" data-check="0"></span>
				        </div>  
               
			       	</div>
			       	<div class="clear"></div>

			       	<div class="form">
				        <div class="col1">비밀번호</div>
				        <div class="col2">
							<input type="password" name="pass">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">비밀번호 확인</div>
				        <div class="col2">
							<input type="password" name="pass_confirm">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">이름</div>
				        <div class="col2">
							<input type="text" name="name">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form email">
				        <div class="col1">이메일</div>
				        <div class="col2">
							<input type="text" name="email1">@<input type="text" name="email2">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="bottom_line"> </div>
			       	<div class="buttons">
	                	<img style="cursor:pointer" id="save_frm" src="./img/button_save.gif" >&nbsp;
                  		<img id="reset_button" style="cursor:pointer" src="./img/button_reset.gif"
                  			onclick="reset_form()">
	           		</div>
           	</form>
        	</div> <!-- join_box -->
        </div> <!-- main_content -->
	</section> 
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>

