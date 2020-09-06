<%@page import="ohyes.coffee.dao.MemberDAO"%>
<%@page import="ohyes.coffee.dto.MemberDTO"%>
<%@page import="ohyes.coffee.dao.Utility"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%

	String memId=Utility.stripTag(request.getParameter("memId"));
	String memPwd=Utility.encrypt(request.getParameter("memPwd"));
	String memName=request.getParameter("memName");
	String memZip=request.getParameter("memZip");
	String memAddress1=request.getParameter("memAddress1");
	String memAddress2=Utility.stripTag(request.getParameter("memAddress2"));
	String memPhone=request.getParameter("memPhone1")
	+"-"+request.getParameter("memPhone2")
	+"-"+request.getParameter("memPhone3");
	String memEmail=request.getParameter("memEmail");
	
	MemberDTO member=new MemberDTO();
	member.setMemId(memId);
	member.setMemPwd(memPwd);
	member.setMemName(memName);
	member.setMemZip(memZip);
	member.setMemAddress1(memAddress1);
	member.setMemAddress2(memAddress2);
	member.setMemPhone(memPhone);
	member.setMemEmail(memEmail);
	
	MemberDAO.getDAO().insertMember(member);	
	
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=member&work=login';");
	out.println("</script>");
%>
