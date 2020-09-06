<%@page import="com.oreilly.servlet.MultipartRequest"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
 <%@ page import = "java.util.Enumeration" %>
 <%@ page import = "com.oreilly.servlet.multipart.DefaultFileRenamePolicy" %>
 <%@ page import = "com.oreilly.servlet.MultipartRequest" %>
 
 
<% 
	//실제로 파일이 서버에 저장될 수 있는 JSP문서
	//물론 여기서 실제 Table에 저장될 수 있도록 구현도 해준다.
	
	String path = request.getServletContext().getRealPath("admin_images");
	int size = 1024 * 1024 * 10 ;//저장가능한 파일크기
	String file ="";//업로드한 파일의 이름(이름변경될 수 있음)
	String originFile = "";//이름이 변경되기 전 실제 파일이름
	
	//실제 파일 업로드 과정
	try{
		MultipartRequest multi = new MultipartRequest(request, path, size, "UTF-8", new DefaultFileRenamePolicy());
		
		Enumeration files = multi.getFileNames();
		String str = (String)files.nextElement(); //파일 이름을 받아서 String으로 저장한다
		
		file = multi.getFilesystemName(str);//업로드된 파일 이름을 가져온다
		originFile = multi.getOriginalFileName(str);//원래의 파일이름을 가져옴
	
	}catch(Exception e){
		System.out.println("에러 : 파일업로드 중 오류발생 " + e.getMessage());
	}
	
	String fullpath = file + "\\" + originFile;
%>


<body>
<img src="<%=fullpath%>" width=512 height=384></img>
</body>



