<%@page import="ohyes.coffee.dao.NoticeAdminDAO"%>
<%@page import="ohyes.coffee.dto.NoticeDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<% 	
	request.setCharacterEncoding("utf-8");
	
	//save : update =>  1(임시저장), 2(글올리기)
	String saveBtn=request.getParameter("saveBtn");
	//change : detail => delete or list => deleteAll
	String change=request.getParameter("change");
	System.out.println("action : "+saveBtn+"/"+change);
	
	if(change!=null && change.equals("deleteAll")){
		String[] check=request.getParameterValues("check");
		for(String num:check){
			int noticeNo=Integer.parseInt(num);
			NoticeDTO notice=NoticeAdminDAO.getDAO().selectNoticeAdminNo(noticeNo);
			NoticeAdminDAO.getDAO().updateNoticeAdmin(notice, NoticeAdminDAO.DELETE);
			}
	} else{
		int noticeNo=Integer.parseInt(request.getParameter("noticeNo"));
		String title=request.getParameter("title");
		String content=request.getParameter("content");

		NoticeDTO notice=NoticeAdminDAO.getDAO().selectNoticeAdminNo(noticeNo);

		if(saveBtn!=null && saveBtn.equals("1")){
			notice.setNoticeTitle(title);
			notice.setNoticeContents(content);
			NoticeAdminDAO.getDAO().updateNoticeAdmin(notice, NoticeAdminDAO.UPDATE);
			
		}else if(saveBtn!=null && saveBtn.equals("2")){
			notice.setNoticeTitle(title);
			notice.setNoticeContents(content);
			NoticeAdminDAO.getDAO().updateNoticeAdmin(notice, NoticeAdminDAO.UPDATE);
			NoticeAdminDAO.getDAO().updateNoticeAdmin(notice, NoticeAdminDAO.SAVE_AND_SUBMIT);
		
		}else if(change!=null && change.equals("delete")){
			NoticeAdminDAO.getDAO().updateNoticeAdmin(notice, NoticeAdminDAO.DELETE);
		} 
		
	}
	out.println("<script type='text/javascript'>");
	out.println("location.href='"+request.getContextPath()+"/coffee/admin/index.jsp?part=notice&work=list';");
	out.println("</script>");
	
%>

