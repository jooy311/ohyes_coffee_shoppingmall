<%@page import="ohyes.coffee.dao.QnaAdminDAO"%>
<%@page import="ohyes.coffee.dao.QnaCoAdminDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	request.setCharacterEncoding("utf-8");

	String fromQna=request.getParameter("fromQna");
	System.out.println(fromQna);

	int qnaNo = Integer.parseInt(request.getParameter("qnaNo"));

	if (fromQna.equals("insertCo")) { //행추가(답변하기)
		String content = request.getParameter("content");
		//content = new String(content.getBytes("ISO-8859-1"), "UTF-8");
		QnaCoAdminDAO.getDAO().insertQnaCoAdmin(qnaNo, content);
		
	} else if(fromQna.equals("updateCo")){//행변경(답변수정)
		String content = request.getParameter("content");
		//content = new String(content.getBytes("ISO-8859-1"), "UTF-8");
		QnaCoAdminDAO.getDAO().updateQnaCoAdmin(qnaNo, content);
		
	} else if(fromQna.equals("deleteCo")){	//행삭제(답변삭제)
		QnaCoAdminDAO.getDAO().deleteQnaCoAdmin(qnaNo);
	
	} else if(fromQna.equals("deleteQna")){	//글삭제(상태변경)
		QnaAdminDAO.getDAO().deleteQnaAdmin(qnaNo);

	}
	
	//페이지 이동
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/admin/index.jsp?part=qna&work=list';");
	out.println("</script>");
%>
