<%@page import="ohyes.coffee.dto.QnaDTO"%>
<%@page import="ohyes.coffee.dao.QnaBoardDAO"%>
<%@page import="ohyes.coffee.dao.MemberDAO"%>
<%@page import="ohyes.coffee.dto.MemberDTO"%>
<%@page import="ohyes.coffee.dao.Utility"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%> 
    <%@include file="/coffee/Mypage/login_check.jspf" %>       
<%
	//전달값을 반환받아 저장
	int qnaNo=Integer.parseInt(request.getParameter("qnaNo"));
		
	QnaDTO board=QnaBoardDAO.getDAO().selectNumBoard(qnaNo);

	//로그인 사용자가 작성자 또는 관리자가 아닌 경우 >> 비정상적인 요청
	if(!loginMember.getMemId().equals(board.getQnaMemId()) && loginMember.getMemStatus()!=9) {
		out.println("<script type='text/javascript'>");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=error&work=error400';");
		out.println("</script>");
		return;
	}


	//상태 컬럼값을 변경하는 DAO 클래스의 메소드 호출
	QnaBoardDAO.getDAO().updateStatus(qnaNo);
	
	//게시글 목록 출력페이지 이동
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=board&work=qnaboard';");
	out.println("</script>");
%>

