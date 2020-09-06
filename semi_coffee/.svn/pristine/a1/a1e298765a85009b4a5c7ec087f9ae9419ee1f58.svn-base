<%@page import="ohyes.coffee.dao.MemberDAO"%>
<%@page import="ohyes.coffee.dto.MemberDTO"%>
<%@page import="ohyes.coffee.dao.Utility"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	request.setCharacterEncoding("utf-8");

String memId=request.getParameter("memId");
String memPwd=Utility.encrypt(request.getParameter("memPwd"));

MemberDTO member=MemberDAO.getDAO().selectIdMember(memId);
if(member==null) {
	session.setAttribute("message", "입력한 아이디가 존재하지 않습니다.");
	session.setAttribute("memId", memId);
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=member&work=login';");
	out.println("</script>");
	return;
}

//비밀번호에 대한 인증 처리
if(!member.getMemPwd().equals(memPwd)) {//비밀번호에 대한 인증 실패
		session.setAttribute("message", "비밀번호가 맞지 않습니다.");
		session.setAttribute("memId", memId);
		out.println("<script type='text/javascript'>");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=member&work=login';");
		out.println("</script>");
		return;
	}
//탈퇴회원 로그인시 false 처리
if(member.getMemStatus()==0){
	session.setAttribute("message", "탈퇴회원은 로그인 하실 수 없습니다.");
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=member&work=login';");
	out.println("</script>");
	return;
}	

session.setAttribute("loginMember", MemberDAO.getDAO().selectIdMember(memId));
String url=(String)session.getAttribute("url");

//페이지 이동
if(url==null) {//기존 요청페이지가 없는 경우 - 메인페이지 이동
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp';");
	out.println("</script>");
} else {//기존 요청페이지가 있는 경우 - 기존 요청페이지 이동
	session.removeAttribute("url");
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+url+"';");
	out.println("</script>");
}
%>