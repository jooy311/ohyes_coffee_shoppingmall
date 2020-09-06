<%@page import="ohyes.coffee.dao.NoticeAdminDAO"%>
<%@page import="ohyes.coffee.dto.NoticeDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	//한글처리
	request.setCharacterEncoding("utf-8");
	
	//!!비정상적인 요청에 대한 응답처리

	//!!변수에 DB에 넣을 값 저장하기 
	int noticeNo=NoticeAdminDAO.getDAO().selectNextNo();	//!!후에 테스트데이터 지우고 수정필요
	String noticeTitle=request.getParameter("title");
	String noticeContents=request.getParameter("content");
	int noticeReadcount=0;	//!!조회수 처리해아
	
	//!!변수값 출력 (확인용)
	System.out.println(noticeNo+"/" +noticeTitle +"/" + noticeContents+"/"+ noticeReadcount);	
	
	NoticeDTO notice = new NoticeDTO();
	notice.setNoticeNo(noticeNo);
	notice.setNoticeTitle(noticeTitle);
	notice.setNoticeContents(noticeContents);
	notice.setNoticeReadcount(noticeReadcount);
	
	NoticeAdminDAO.getDAO().insertNoticeAdmin(notice);

	//임시저장 : 1 , 글올리기 : 2 
	String btnVal=request.getParameter("writeBtn");
	if(btnVal.equals("2")){
		NoticeDTO newNotice=NoticeAdminDAO.getDAO().selectNoticeAdminNo(noticeNo);
		NoticeAdminDAO.getDAO().updateNoticeAdmin(newNotice, NoticeAdminDAO.SAVE_AND_SUBMIT);
	}
	
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/admin/index.jsp?part=notice&work=list';");
	out.println("</script>");
%>
	