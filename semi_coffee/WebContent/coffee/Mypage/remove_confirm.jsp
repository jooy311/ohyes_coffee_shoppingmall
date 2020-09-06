<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%-- 회원탈퇴을 위한 비밀번호를 입력받는 JSP 문서 --%>
<%-- => 비로그인 사용자가 요청한 경우 에러페이지로 이동 - 비정상적인 요청 --%>
<%-- => [입력완료]를 클릭한 경우 회원탈퇴 처리페이지(member_remove_action.jsp) 요청 - 입력값 전달 --%>
<%@include file="/coffee/Mypage/login_check.jspf" %>     
<%
	String message=(String)session.getAttribute("message");
	if(message==null) {
		message="";
	} else {
		session.removeAttribute("message");
	}
%>
<div style="padding: 50px 500px; text-align: center; ">
<form name="passwdForm" action="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=Mypage&work=remove_action" method="post" onsubmit="return submitCheck();">
	<p>회원탈퇴를 위한 비밀번호를 입력해 주세요.</p>
	<p>
		<input type="password" name="passwd" style="width:270px; margin-top: 10px;">
	</p>
	<p>
	<button type="submit"><img src="./Mypage/editmember/save_pw.png" style="width:150px; margin-top: 10px;"></button>
	</p>
	<p id="message" style="color: red;"><%=message %></p> 
</form>
</div>
<script type="text/javascript">
passwdForm.passwd.focus();

function submitCheck() {
	if(passwdForm.passwd.value=="") {
		document.getElementById("message").innerHTML="비밀번호를 입력해 주세요.";
		passwdForm.passwd.focus();
		return false;
	}
	return true;
}
</script>
