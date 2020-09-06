<%@page import="ohyes.coffee.dao.CartDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@include file="/coffee/Mypage/login_check.jspf" %>
<%
	if(request.getMethod().equals("GET")) {
		out.println("<script type='text/javascript'>");
		out.println("location.href='"+request.getContextPath()+"/site/index.jsp?workgroup=error&work=error400';");
		out.println("</script>");
		return;
	}	
	int status=0;
	if (request.getParameter("status")!=null && request.getParameter("status")!=""){
		status=Integer.parseInt(request.getParameter("status"));
	}
	String memId=loginMember.getMemId();
	if (status==1){
		CartDAO.getDAO().removeAllCart(memId);
	} else {
		int no=Integer.parseInt(request.getParameter("no"));
		
		CartDAO.getDAO().removeCart(no,memId);
	}
	
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=basket&work=basket';");
	out.println("</script>");

%>
