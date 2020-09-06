<%@page import="ohyes.coffee.dto.MemberDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
  
<%@include file="/coffee/Mypage/login_check.jspf" %>  

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
	<button class="btn btn-primary" id="menu-toggle">Toggle
		Menu</button>

	<button class="navbar-toggler" type="button" data-toggle="collapse"
		data-target="#navbarSupportedContent"
		aria-controls="navbarSupportedContent" aria-expanded="false"
		aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
			<li class="nav-item active"><a class="nav-link"
				href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=home&work=work">Home <span class="sr-only">(current)</span></a></li>
			<li class="nav-item"><a class="nav-link" href="<%=request.getContextPath()%>/coffee/index.jsp">쇼핑몰
					바로가기</a></li>
			<li class="nav-item dropdown"><a
				class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
				role="button" data-toggle="dropdown" aria-haspopup="true"
				aria-expanded="false"> 관리자 정보 </a>
				<div class="dropdown-menu dropdown-menu-right"
					aria-labelledby="navbarDropdown">
					<div class="dropdown-item" style="text-align: center">
						[<%=loginMember.getMemName()%>] 관리자님,
						<p>안녕하세요</p>
					</div>
					
			</li>
		</ul>
	</div>
</nav>