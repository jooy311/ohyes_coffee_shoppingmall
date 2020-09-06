<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	String message=(String)session.getAttribute("message");
	if(message==null) {
		message="";
	} else {
		session.removeAttribute("message");
	}
	String memId=(String)session.getAttribute("memId");
	if(memId==null) {
		memId="";
	} else {
		session.removeAttribute("memId");
	}
%>  

<link rel="stylesheet" type="text/css" href="./member/fine_pw/optimizer.php">
<link rel="stylesheet" type="text/css" href="./member/fine_pw/optimizer(1).php">

    <!--allStore_contents-->
    <div id="allStore_contents">
    <div class="allStore_layout">
    <!--타이틀, 현재위치-->
    <div class="allStore-board-menupackage">
        
        <div class="title">
            <h2>비밀번호 찾기</h2>
        </div>
        <div class="nav-path">
            <ol><li><a href="<%=request.getContextPath()%>/coffee/index.jsp">홈</a></li>
            <li title="현재 위치"><strong>비밀번호 찾기</strong></li>
            </ol></div>
    </div>
<form id="finepwd" name="finepwdForm" action="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=member&work=finepwd_action" method="post" onsubmit="return;">
<input id="nextUrl" name="nextUrl" value="/member/passwd/find_passwd_question.html" type="hidden">
<input id="resultURL" name="resultURL" value="" type="hidden"><div class="xans-element- xans-member xans-member-findpasswd ">
<div class="findPw">
        <h3><img src="./member/fine_pw/h3_find_pw.gif" alt="비밀번호 찾기"></h3>
<fieldset style="width: 300px;margin: 0 auto;">
<legend>비밀번호 찾기 1단계 정보 입력</legend>
            <ul class="ec-base-desc typeBullet gMedium">
<li class="gBlank20">
<strong class="term">아이디</strong>
	<input id="memId" name="memId" value="<%=memId%>" type="text" style="width:270px;">
</li>
<li id="name_view" class="name" style="">
<strong class="term" id="name_lable">이름</strong>
	<input id="memName" name="memName" type="text" style="width:270px;">
</li>
<li id="email_view" class="email" style="">
<strong class="term">이메일 </strong>
	<input id="memEmail" name="memEmail" type="text" style="width:270px;">
</li>
</ul>
<div style="text-align: center;color: red;"><%=message %></div>
<p class="ec-base-button gBlank20">
	<button type="submit"><img src="./board/images/btn_secret_submit.gif"></button>
</p>
</fieldset>
</div>
</div>
</form>
</div>
</div>
<script type="text/javascript">
	$("#memId").focus();
	
	$("#finepwd").submit(function() {
		var checkID = /^(?=.*[a-zA-Z])(?=.*[0-9]).{4,16}$/g; //ID 유효성 검사 정규식
	    var checkEmail = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/;  //Email 유효성 검사 정규식
	    
	    if ($("#memId").val()=="") {
			alert("아이디를 입력해 주세요.");
			$("#memId").focus();
			return false ;
		}else if(checkID.test($("#memId").val())!=true) {
			alert("영문소문자/숫자, 4~16자리로 입력해 주세요.");
			$("#memId").focus();
			return false ;
		}else if($("#memName").val()=="") {
			alert("이름을 입력해 주세요.");
			$("#memName").focus();
			return false ;
		}else if($("#memEmail").val()=="") {
			alert("이메일을 입력해 주세요.");
			$("#memEmail").focus();
			return false ;
		}else if(checkEmail.test($("#memEmail").val())!=true) {
			alert("올바른 형식의 이메일로 입력해 주세요.");
			$("#memEmail").focus();
			return false ;
		}
		});	
</script>