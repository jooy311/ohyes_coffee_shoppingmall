<%@page import="ohyes.coffee.dao.MemberDAO"%>
<%@page import="ohyes.coffee.dao.MemberAdminDAO"%>
<%@page import="ohyes.coffee.dto.MemberDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    
<% 
//한글처리
request.setCharacterEncoding("utf-8");

//어느 문서에서 요청이 왔는지 확인
String fromMem=request.getParameter("fromMem");
System.out.println(fromMem);



//요청이 온 문서에 따라 다르게 처리
if(fromMem.equals("deleteAll")){	//삭제(다중행)

	String[] selectedMems=request.getParameterValues("selectedMems");
	for(String id:selectedMems){
		MemberDTO member=MemberAdminDAO.getDAO().selectMemAdminId(id);
		MemberAdminDAO.getDAO().updateMemAdmin(member, MemberAdminDAO.STATUS, "0");
	}
	
} else{ 
	String selectedMem=request.getParameter("selectedMem");
	System.out.println(selectedMem);
	MemberDTO member=MemberAdminDAO.getDAO().selectMemAdminId(selectedMem);
	
	if(fromMem.equals("deleteOne")){	//삭제(단일행)
		MemberAdminDAO.getDAO().updateMemAdmin(member,MemberAdminDAO.STATUS, "0");
	
	} else if (fromMem.equals("updatePhone")){	//번호변경
		String changedPhone=request.getParameter("changedPhone");
		MemberAdminDAO.getDAO().updateMemAdmin(member,MemberAdminDAO.PHONE,changedPhone );
		
	}  else if (fromMem.equals("updateAddress")){	//주소변경
		String changeZip=request.getParameter("changeZip");
		String changeAddress1=request.getParameter("changeAddress1");
		String changeAddress2=request.getParameter("changeAddress2");
		
		MemberAdminDAO.getDAO().updateMemAdmin(member,MemberAdminDAO.ZIP, changeZip);
		MemberAdminDAO.getDAO().updateMemAdmin(member,MemberAdminDAO.ADDRESS1, changeAddress1);
		MemberAdminDAO.getDAO().updateMemAdmin(member,MemberAdminDAO.ADDRESS2, changeAddress2);
		
	} else if(fromMem.equals("updateStatus")){	//삭제(단일행)
		String changedStatus=request.getParameter("changedStatus");
		MemberAdminDAO.getDAO().updateMemAdmin(member,MemberAdminDAO.STATUS, changedStatus);
	
	}
}

//페이지 이동
out.println("<script type='text/javascript'>");
out.println("location.href='"+request.getContextPath()+"/coffee/admin/index.jsp?part=member&work=list';");
out.println("</script>");
%>


