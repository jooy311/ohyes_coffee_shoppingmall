<%@page import="ohyes.coffee.dto.ReviewDTO"%>
<%@page import="ohyes.coffee.dao.ReviewDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    <%@include file="/coffee/Mypage/login_check.jspf" %>
<%
	//비정상적인 접근 - num이 null인경우
	if(request.getParameter("num")==null){
		out.println("<script type='text/javascript'>");
		out.println("alert('비정상적인 접근입니다.');");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp';");
		out.println("</script>");
	}
	int num=Integer.parseInt(request.getParameter("num"));
	
	ReviewDTO review=ReviewDAO.getDAO().selectNumReview(num);
	//로그인 사용자가 작성자가 아닐경우 에러
	if(!review.getReviewMemid().equals(loginMember.getMemId())){
		out.println("<script type='text/javascript'>");		
		out.println("alert('작성자만 삭제가능합니다.');");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=board&work=review_list';");
		out.println("</script>");
		return;
	}
	//게시글 검색해서 없거나 삭제글인 경우 미정상적인 요청
	if(review==null || review.getReviewStatus()==0){
		out.println("<script type='text/javascript'>");
		out.println("alert('비정상적인 접근입니다.');");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp';");
		out.println("</script>");
	}

	ReviewDAO.getDAO().deleteReview(num);
	
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()
		+"/coffee/index.jsp?workgroup=board&work=review_list';");
	out.println("</script>");
%>