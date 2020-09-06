<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	//session.removeAttribute("loginMember");
	session.invalidate();
	
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp';");
	out.println("</script>");
%>