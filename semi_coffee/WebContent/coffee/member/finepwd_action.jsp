<%@page import="javafx.scene.control.Alert"%>
<%@page import="ohyes.coffee.dao.MemberDAO"%>
<%@page import="ohyes.coffee.dto.MemberDTO"%>
<%@page import="ohyes.coffee.dao.Utility"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	request.setCharacterEncoding("utf-8");
String memId=request.getParameter("memId");
String memName=request.getParameter("memName");
String memEmail=request.getParameter("memEmail");


MemberDTO member=MemberDAO.getDAO().selectIdMember(memId);
if(member==null) {
	session.setAttribute("message", "입력한 사용자 아이디가 존재하지 않습니다.");
	session.setAttribute("memId", memId);
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=member&work=fine_pwd';");
	out.println("</script>");
	return;
}

//이름에 대한 인증 처리
if(!member.getMemName().equals(memName)) {//이름에 대한 인증 실패
		session.setAttribute("message", "입력한 사용자 아이디가 존재하지 않거나 이름이 맞지 않습니다.");
		session.setAttribute("memId", memId);
		out.println("<script type='text/javascript'>");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=member&work=fine_pwd';");
		out.println("</script>");
		return;
	}
//이메일에 대한 인증 처리
if(!member.getMemEmail().equals(memEmail)) {//이메일에 대한 인증 실패
		session.setAttribute("message", "입력한 사용자의 이메일이 맞지 않습니다.");
		session.setAttribute("memId", memId);
		out.println("<script type='text/javascript'>");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=member&work=fine_pwd';");
		out.println("</script>");
		return;
	}
//탈퇴회원 로그인시 false 처리
if(member.getMemStatus()==0){
	session.setAttribute("message", "탈퇴한 회원 입니다.");
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=member&work=fine_pwd';");
	out.println("</script>");
	return;
}

	String passwd= MemberDAO.getDAO().randomPassword(6);
	String pwd=Utility.encrypt(passwd);
	MemberDTO member1=new MemberDTO();
	member.setMemId(memId);
	member.setMemPwd(pwd);
	MemberDAO.getDAO().updatePwdMember(member);

	
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
		<div style="width: 300px;margin: 0 auto;">입력한 회원의 비밀번호는 <span class="memId">[<%=passwd %>]</span>입니다.
		<button type="submit" style="margin-top: 15px; " onclick="location.href='<%=request.getContextPath()%>/coffee/index.jsp?workgroup=member&work=login'">
		<img src="./member/fine_id/main.png"></button></div>
</body>
</html>
