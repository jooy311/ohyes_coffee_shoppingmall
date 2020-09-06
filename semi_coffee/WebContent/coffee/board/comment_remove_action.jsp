<%@page import="ohyes.coffee.dao.ReviewCommentDAO"%>
<%@page import="ohyes.coffee.dto.ReviewCommentDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@include file="/coffee/Mypage/login_check.jspf" %>
<%
	if(request.getMethod().equals("get")){
		out.println("<script type='text/javascript'>");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp';");
		out.println("</script>");
	}
	String coId=request.getParameter("coId");
	int no=Integer.parseInt(request.getParameter("num"));
	
	if(!coId.equals(loginMember.getMemId())){
	out.println("<script type='text/javascript'>");
	out.println("alert('댓글 작성자만 삭제가능합니다.');");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=board&work=review_detail&num="+no+"#comment_modify';");
	out.println("</script>");
	return;
}

	String pno=request.getParameter("no");
	int coNo=Integer.parseInt(request.getParameter("coNo"));
	
	ReviewCommentDAO.getDAO().deleteComment(coNo);
	
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=board&work=review_detail&num="+no+"&no="+pno+"#comment_modify';");
	out.println("</script>");
%>