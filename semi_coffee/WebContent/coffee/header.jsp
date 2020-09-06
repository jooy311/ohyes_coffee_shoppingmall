<%@page import="ohyes.coffee.dto.MemberDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%
	//세션에 저장된 권한 관련 정보를 반환받아 저장
	MemberDTO loginMember=(MemberDTO)session.getAttribute("loginMember");
%>
<!-- Header : topbar + header + nav -->
<!--allStore_header-->
<div id="allStoreHeader">

	<!--allStore_topbar => 각페이지별 이동 -->
	<div id="allStore_topbar">
		<div class="allStore_layout">
		<%-- 로그인 사용자과 비로그인 사용자를 구분하여 응답 --%>

			<div class="xans-element- xans-layout xans-layout-statelogoff ">
			
			<% if(loginMember==null) {//비로그인 사용자 %>	
				<a href="index.jsp?workgroup=member&work=login">로그인</a>&nbsp;&nbsp;
				<a href="index.jsp?workgroup=member&work=join">회원가입</a>&nbsp;&nbsp;
			<% } else {//로그인 사용자 %>
			[<%=loginMember.getMemName() %>]님 환영합니다.&nbsp;&nbsp;
				<a href="index.jsp?workgroup=member&work=logout_action">로그아웃</a>&nbsp;&nbsp;
				<a href="index.jsp?workgroup=basket&work=basket">장바구니</a> 
				<%if(loginMember.getMemStatus()==1){ %>
					<a href="index.jsp?workgroup=Mypage&work=mypage">마이페이지</a>
				<%} else { %>
					<a href="admin/index.jsp?adminId="<%=loginMember.getMemName()%>>관리자페이지</a>
					
				<% } %>	
			<% } %>	

				<!-- boardbtn => 버튼 아이콘 수정 필요!!! -->
				<div class="boardbtn">게시판
					<div class="board-dropdown">
						<ol class="xans-element- xans-layout xans-layout-boardinfo">
							<li class="xans-record-"><a href="index.jsp?workgroup=board&work=review_list">상품후기</a></li>
							<li class="xans-record-"><a href="index.jsp?workgroup=board&work=qnaboard">Q&#38;A게시판</a></li>
							<li class="xans-record-"><a href="index.jsp?workgroup=board&work=boardNotice">공지사항</a></li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--allStore_header : 로고 + 키워드 검색 -->
	<div id="allStore_header">
		<div class="allStore_layout">

			<!--로고 => 메인페이지로 이동-->
			<div class="xans-element- xans-layout xans-layout-logotop logo ">
				<a href="index.jsp"><img
					src="images/ohyeslogo.png" width="350px" /></a>
			</div>

			<!-- 키워드 검색 
			<div id="allStore_search">
				<form id="searchBarForm" name="" 
					action="http://coffeechoi.co.kr/product/search.html" method="get" target="_self" enctype="multipart/form-data">
					<input id="banner_action" name="banner_action" value="" type="hidden" />
					<div class="xans-element- xans-layout xans-layout-searchheader search-layout">
						<fieldset>
							<input id="keyword" name="keyword" class="inputTypeText" onmousedown="SEARCH_BANNER.clickSearchForm(this)" value="" type="text" />
							<button class="icon icon-magnifier" onclick="SEARCH_BANNER.submitSearchBanner(this); return false;"></button>
						</fieldset>
					</div>
				</form>
			</div>-->

		</div>
	</div>

	<!--allStore_nav : 네비게이션 -->
	<div id="allStore_nav">
		<div id="categoryList"
			class="xans-element- xans-layout xans-layout-category">
			<div class="allStore_layout">
				<div class="position">

					<ul>
						<li class="xans-record-">
							<div class="dropdown">
								<a class="dropa" href="index.jsp?workgroup=product&work=product">전체상품</a>
							</div>
						</li>
						<li class="xans-record-">
							<div class="dropdown">
								<a class="dropa" href="index.jsp?workgroup=product&work=product&category=1">커피용품</a>
								<div class="dropdown-content">
									<a href="index.jsp?workgroup=product&work=product&category=1">드리퍼</a>
								</div>
							</div>
						</li>

						<li class="xans-record-">
							<div class="dropdown">
								<a class="dropa" style="cursor: default;pointer-events: none;">커피 원두</a>
								<div class="dropdown-content">
									<a href="index.jsp?workgroup=product&work=product&category=2">블렌드</a> <a href="index.jsp?workgroup=product&work=product&category=3">싱글오리진</a>
								</div>
							</div>
						</li>


						<li><a href="index.jsp?workgroup=board&work=review_list">상품후기</a></li>
					</ul>

				</div>
			</div>
		</div>
	</div>

</div>