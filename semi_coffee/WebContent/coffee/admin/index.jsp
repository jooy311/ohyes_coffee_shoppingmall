<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%-- 클라이언트의 모든 요청을 받아 템플릿 페이지로 스레드를 이동하여
응답처리 되도록 하는 JSP 문서 - 요청 페이지  --%>  

<%
	request.setCharacterEncoding("utf-8");

	String part = request.getParameter("part");
	if(part== null)	{
		part = "home";//처음시작페이지인 home으로 이동
	}
	
	String work = request.getParameter("work");
	if(work == null){
		work = "work";
	}
	
%>

<jsp:forward page = "layout/template.jsp">
	<jsp:param value = "<%=part %>" name = "part"/>
	<jsp:param value = "<%=work %>" name = "work"/>
</jsp:forward>