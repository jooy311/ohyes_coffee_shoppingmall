<%@page import="javafx.scene.control.Alert"%>
<%@page import="ohyes.coffee.dao.MemberDAO"%>
<%@page import="ohyes.coffee.dto.MemberDTO"%>
<%@page import="ohyes.coffee.dao.Utility"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	request.setCharacterEncoding("utf-8");

String memName=request.getParameter("memName");
String memEmail=request.getParameter("memEmail");


MemberDTO member=MemberDAO.getDAO().serchIdMember(memName);
if(member==null) {
	session.setAttribute("message", "입력한 사용자 이름이 존재하지 않습니다.");
	session.setAttribute("memName", memName);
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=member&work=fine_id';");
	out.println("</script>");
	return;
}

//비밀번호에 대한 인증 처리
if(!member.getMemEmail().equals(memEmail)) {//비밀번호에 대한 인증 실패
		session.setAttribute("message", "입력한 사용자 이름이 존재하지 않거나 이메일이 맞지 않습니다.");
		session.setAttribute("memName", memName);
		out.println("<script type='text/javascript'>");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=member&work=fine_id';");
		out.println("</script>");
		return;
	}
//탈퇴회원 로그인시 false 처리
if(member.getMemStatus()==0){
	session.setAttribute("message", "탈퇴한 회원 입니다.");
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=member&work=fine_id';");
	out.println("</script>");
	return;
}
	//out.println("<script type='text/javascript'>");
	//out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=member&work=login';");
	//out.println("</script>");
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
		<div style="width: 300px;margin: 0 auto;">[<%=member.getMemName() %>]님의 아이디는 <span class="memId">[<%=member.getMemId() %>]</span>입니다.
		<button type="submit" style="margin-top: 15px;" onclick="location.href='<%=request.getContextPath()%>/coffee/index.jsp?workgroup=member&work=login'">
		<img src="./member/fine_id/main.png">
		</button></div>
</body>
</html>