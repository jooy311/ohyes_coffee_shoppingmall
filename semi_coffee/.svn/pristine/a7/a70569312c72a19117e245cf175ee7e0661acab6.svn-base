<%@page import="ohyes.coffee.dto.ReviewDTO"%>
<%@page import="ohyes.coffee.dao.ReviewDAO"%>
<%@ page language="java" contentType="text/html; charset=EUC-KR"
    pageEncoding="UTF-8"%>
<%
	//비정상적인 요청에 대한 응답처리
	if (request.getMethod().equals("get")){
		out.println("<script type='text/javascript'>");
		out.println("location href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=error&work=error400'");
		out.println("</script>");
	}
	
	String reviewPNo=request.getParameter("productNO");
	String reviewMemid=request.getParameter("review_memid");
	String reviewTitle=request.getParameter("review_title").replace("<", "&lt").replace(">", "&gt");
	String reviewContent=request.getParameter("review_content").replace("<", "&lt").replace(">", "&gt");
	int reviewNo=ReviewDAO.getDAO().selectNextNum();
	
	ReviewDTO review=new ReviewDTO();
	review.setReviewNo(reviewNo);
	review.setReviewPNo(reviewPNo);
	review.setReviewTitle(reviewTitle);
	review.setReviewMemid(reviewMemid);
	review.setReviewContent(reviewContent);
	
	ReviewDAO.getDAO().insertReview(review);
	
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=board&work=review_list';");
	out.println("</script>");
%>
