<%@page import="ohyes.coffee.dao.CartDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	if(request.getMethod().equals("GET")) {
		out.println("<script type='text/javascript'>");
		out.println("location.href='"+request.getContextPath()+"/site/index.jsp?workgroup=error&work=error400';");
		out.println("</script>");
		return;
	}	

	int no=Integer.parseInt(request.getParameter("no"));
	int amount=Integer.parseInt(request.getParameter("amount"));
	
	CartDAO.getDAO().updateCart(amount, no);
	
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=basket&work=basket';");
	out.println("</script>");

%>
