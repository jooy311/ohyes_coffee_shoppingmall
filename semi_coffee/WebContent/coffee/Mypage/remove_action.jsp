<%@page import="javafx.scene.control.Alert"%>
<%@page import="ohyes.coffee.dao.MemberDAO"%>
<%@page import="ohyes.coffee.dto.MemberDTO"%>
<%@page import="ohyes.coffee.dao.Utility"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%> 
    <%@include file="/coffee/Mypage/login_check.jspf" %>       
<%
	//전달값을 반환받아 저장
	String passwd=Utility.encrypt(request.getParameter("passwd"));
if(!loginMember.getMemPwd().equals(passwd)) {//비밀번호가 틀린 경우
	session.setAttribute("message", "비밀번호가 맞지 않습니다.");
	out.println("<script type='text/javascript'>");
	out.println("location.href='index.jsp?workgroup=Mypage&work=remove_confirm';");
	out.println("</script>");
	return;
}
if(loginMember.getMemStatus()==9){
	session.setAttribute("message", "관리자는 탈퇴가 불가능 합니다.");
	out.println("<script type='text/javascript'>");
	out.println("location.href='index.jsp?workgroup=Mypage&work=remove_confirm';");
	out.println("</script>");
	return;
}
	//아이디와 상태를 전달받아 MEMBER 테이블에 저장된 해당 회원의
	//상태 컬럼값을 변경하는 DAO 클래스의 메소드 호출
	MemberDAO.getDAO().updateStatus(loginMember.getMemId());
	session.invalidate();
	
%>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>JSP</title>
<style type="text/css">

div {
	text-align: center;
	margin: 10px;
}

.id { color: red; }

</style>
</head>
<body>
		<div style="width: 300px;margin: 0 auto;">회원탈퇴가 정상적으로 처리되었습니다. 감사합니다.
		<button type="submit" style="margin-top: 15px; " onclick="location.href='index.jsp'">
		[메인으로]</button></div>
</body>
</html>


