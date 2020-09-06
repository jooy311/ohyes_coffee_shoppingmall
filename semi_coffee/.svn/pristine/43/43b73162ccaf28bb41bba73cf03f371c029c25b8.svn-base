<%@page import="ohyes.coffee.dao.OrderPayAdminDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	//주문번호를 받아온다
	String orderNo = request.getParameter("orderNo");

	//해당 주문번호의 상태값을 0 으로 변경한다.
	OrderPayAdminDAO.getOrderPayAdminDAO().deleteOrder(orderNo);

	out.println("<script type='text/javascript'>");
  	out.println("location.href='"+request.getContextPath()+"/coffee/admin/index.jsp?part=order&work=list';");
  	out.println("</script>");
%>