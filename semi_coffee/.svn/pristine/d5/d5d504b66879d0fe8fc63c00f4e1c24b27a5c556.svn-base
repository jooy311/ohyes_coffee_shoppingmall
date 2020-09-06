<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    
    <%
    	//index.jsp에서 전달받은 값을 반환받아서 Content영역에 뿌려줄 JSP의 문서 경로를 설정
    	
    	//일단 클라이언트가 선택한 part와 work값을 변수에 받는다
    	String part = request.getParameter("part");
    	String work = request.getParameter("work");
    	//String adminName = request.getParameter("adminName");
    	
    	if(part == null || work == null){
    		//전달해온 값이 아무것도 없는 null이면 클라이언트한테 응답해줘라
    		//너 에러났다~~잘못된 요청이다
    		response.sendError(HttpServletResponse.SC_BAD_REQUEST);
    		return;
    	}
    	
    	//이 경로로 해당 파일명으로 저장될것임
    	// /admin/home/home_order.jsp
    	String contentFilePath ="/coffee/admin/" + part + "/" + part + "_" + work + ".jsp";
    	//System.out.println("contentFilePath = "+contentFilePath);
    
    %>
    
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>OHYES COFFEE</title>


<!--  link href = "<%=request.getContextPath()%>/action/template/CSS/style.css" rel="stylesheet" type="text/css"-->
<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/simple-sidebar.css" rel="stylesheet">
<link href="css/productEnroll.css" rel="stylesheet">
<link href="css/productlist.css" rel="stylesheet">

<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i' type='text/css' media='all' />
<link rel="stylesheet" href="https://templatemag.com/demo/assets/css/normalize.css">
<link rel="stylesheet" href="https://templatemag.com/demo/assets/css/fontello.css">


<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



</head>

<body>
	<%-- Header 영역 --%>
	<div class="d-flex" id="wrapper">
		<!-- template.jsp와 같은 폴더 아래에 있어야함 -->
		<jsp:include page="admin_header.jsp"/> <!-- 사이드바 -->
	
	<%-- Content 영역 - 동적포함 --%>
	<div id="page-content-wrapper">		
		<jsp:include page="admin_top.jsp"/> <!-- 탑 -->
		<jsp:include page="<%=contentFilePath%>"/>
	</div>
	
	<%-- Footer 영역 --%>
	<div id="footer">
		<jsp:include page="admin_footer.jsp"/>
	</div>
	</div>
</body>

</html>