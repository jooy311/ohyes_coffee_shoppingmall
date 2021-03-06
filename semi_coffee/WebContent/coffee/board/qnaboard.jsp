<%@page import="jdk.management.resource.internal.TotalResourceContext"%>
<%@page import="ohyes.coffee.dto.MemberDTO"%>
<%@page import="ohyes.coffee.dto.QnaDTO"%>
<%@page import="java.util.List"%>
<%@page import="ohyes.coffee.dao.QnaBoardDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    
    <%
	String sCategory=request.getParameter("category");
	if(sCategory==null) sCategory="0";
	int category=Integer.parseInt(sCategory);

	//검색 관련 정보를 반환받아 저장
	String search=request.getParameter("search");
	if(search==null) search="";
	String keyword=request.getParameter("keyword");
	if(keyword==null) keyword="";
	
	//전달된 페이지 번호를 반환받아 저장
	// => 전달값이 존재하지 않을 경우 첫번째 페이지 검색
	int pageNum=1;
	if(request.getParameter("pageNum")!=null) {//전달값이 있는 경우
		pageNum=Integer.parseInt(request.getParameter("pageNum"));
	}
	
	//하나의 페이지에 출력될 게시글 갯수 설정
	int pageSize=10;
	
	//BOARD 테이블에 저장된 전체 게시글의 갯수를 검색하여 반환하는 DAO 클래스의 메소드 호출
	//int totalBoard=BoardDAO.getDAO().selectBoardCount();
	//BOARD 테이블에 저장된 전체 게시글 중 검색 게시글의 갯수를 검색하여 반환하는 DAO 클래스의 메소드 호출
	int totalBoard=QnaBoardDAO.getDAO().selectBoardCount(search, keyword);
	      
	//검색 게시글에 대한 페이지의 갯수를 계산하여 저장
	//int totalPage=totalBoard/pageSize+(totalBoard%pageSize==0?0:1);
	int totalPage=(int)Math.ceil((double)totalBoard/pageSize);
	
	//전달된 페이지 번호에 검증
	if(pageNum<=0 || pageNum>totalPage) {//페이지 번호가 잘못된 경우
		pageNum=1;
	}
	
	//현재 페이지에 대한 게시글 시작 행번호를 계산하여 저장
	//ex) 1 Page : 1, 2 Page : 11, 3 Page : 21, 4 Page : 31,...
	int startRow=(pageNum-1)*pageSize+1;
	
	//현재 페이지에 대한 게시글 종료 행번호를 계산하여 저장
	//ex) 1 Page : 10, 2 Page : 20, 3 Page : 30, 4 Page : 40,...
	int endRow=pageNum*pageSize;
	
	//마지막 페이지에 대한 게시글 종료 행번호를 검색 게시글의 갯수로 변경
	if(endRow>totalBoard) {
		endRow=totalBoard;
	}
	
	//게시글의 시작 행번호와 종료 행번호를 전달받아 BOARD 테이블에
	//저장된 게시글에서 시작과 종료 범위에 포함된 게시글만 검색하여 
	//반환하는 DAO 클래스의 메소드 호출
	//List<BoardDTO> boardList=BoardDAO.getDAO().selectBoard(startRow, endRow);
	List<QnaDTO> boardList=QnaBoardDAO.getDAO().selectBoard(startRow, endRow, search, keyword,category);
	
	//현재 페이지의 게시글 목록에 출력될 시작 글번호를 계산하여 저장
	int number=totalBoard-(pageNum-1)*pageSize;
	
	MemberDTO loginMember=(MemberDTO)session.getAttribute("loginMember");
	
	int countnum=1;
	 
%>
<style>
table{

    border-bottom: 2px solid gainsboro;  
}
tr{
	width: 100%;
    height: 50px;
}

</style>

<link rel="stylesheet" type="text/css" href="./board_pd_files/optimizer.php">
<link rel="stylesheet" type="text/css" href="./board_pd_files/optimizer(1).php">

    <!--allStore_contents-->
    <div id="allStore_contents">
        <div class="allStore_layout">
            
            <div>
<div class="xans-element- xans-board xans-board-listpackage-4 xans-board-listpackage xans-board-4 "><!--타이틀, 현재위치-->
<div class="xans-element- xans-board xans-board-title-4 xans-board-title xans-board-4 allStore-board-menupackage "><div class="title">
            <h2><font color="333333">QNA게시판</font></h2>
        </div>
<div class="nav-path">
            <ol>
<li><a href="<%=request.getContextPath()%>/coffee/index.jsp">홈</a></li>
            <li title="현재 위치"><strong>QNA게시판</strong></li>
            </ol>
</div>
</div>
<!--타이틀, 현재위치-->
<!--이미지-->
<div class="xans-element- xans-board xans-board-title-4 xans-board-title xans-board-4 top-title-img "></div>

<div class="ec-base-table typeList gBorder">
                    	<!-- ****스타일 수정**** -->
						<form method="post" id="categoryForm" action="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=qnaboard" >
							<select id="category" name="category" >
							    <option value="0" <% if(category==0) { %> selected="selected" <% } %>>전체문의글</option>
							    <option value="1" <% if(category==1) { %> selected="selected" <% } %>>회원/정보관리</option>
							    <option value="2" <% if(category==2) { %> selected="selected" <% } %>>주문/결제</option>
							    <option value="3" <% if(category==3) { %> selected="selected" <% } %>>배송</option>
							    <option value="4" <% if(category==4) { %> selected="selected" <% } %>>반품/환불/교환/AS</option>
							    <option value="5" <% if(category==5) { %> selected="selected" <% } %>>기타</option>
							</select>          	
	                	</form>
        <table border="1" summary="">
<caption>QNA게시판 목록<%=totalBoard %></caption>
        <colgroup class="xans-element- xans-board xans-board-listheader-4 xans-board-listheader xans-board-4 ">
<col style="width:120px;">
<col style="width:120px;">
<col style="width:opx auto;">
<col style="width:120px;">
<col style="width:120px;">
<col style="width:80px;">
</colgroup>
<thead class="xans-element- xans-board xans-board-listheader-4 xans-board-listheader xans-board-4 ">
	<tr style="  border-bottom: 2px solid black;   ">
		<th scope="col"> 번호</th>
		<th scope="col">카테고리</th>
		<th scope="col">제목</th>
		<th scope="col">작성자</th>
		<th scope="col">작성일</th>
		<th scope="col">조회수</th>
	</tr>
<tbody>
<% if(totalBoard==0) { %>
		<tr>
			<td colspan="5">검색된 게시글이 하나도 없습니다.</td>
		</tr>
		<% } else { %>
			<%-- 게시글 목록 출력 - 반복처리 --%>
			<% for(QnaDTO board:boardList) { %>
			<tr>
				<%-- 글번호 --%>
				<td  style="text-align: center;">
					 <%=number%>
				</td>
				<%-- 카테고리 --%>
				
				<td  style="text-align: center;">
										<% if(board.getQnaCode()==1) {  %>회원/정보관리
										<%}else if(board.getQnaCode()==2) { %>주문/결제
										<%}else if(board.getQnaCode()==3) {  %>배송
										<%}else if(board.getQnaCode()==4) { %>반품/환불/교환/AS
										<%}else if(board.getQnaCode()==5) { %>기타
										<%} %>
								
				</td>
			
				<%-- 제목 --%>
				<%-- 게시글 상태에 대한 제목 출력과 하이퍼 링크 설정 --%>
				<td  style="text-align: center;">
				<% if(board.getQnaStatus()==0) {//일반 게시글인 경우 %>
				<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=viewqna&qnaNo=<%=board.getQnaNo()%>&pageNum=<%=pageNum%>&search=<%=search%>&keyword=<%=keyword%>"><%=board.getQnaTitle() %></a>
				<% } else if (board.getQnaStatus()==1) {//답변완료 게시글인 경우 %>
				<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=viewqna&qnaNo=<%=board.getQnaNo()%>&pageNum=<%=pageNum%>&search=<%=search%>&keyword=<%=keyword%>"><%=board.getQnaTitle() %>
				<span style="color: red; ">[답변완료]</span></a>
				<% } else {//삭제 게시글인 경우 %>
					<span class="remove">삭제글</span>
					작성자 또는 관리자에 의해 삭제된 게시글입니다.
				<% } %>
				</td >
				<%-- 아이디 --%>
				<td style="text-align: center;">
					<%=board.getQnaMemId() %>
				</td>
				
				<%-- 작성일 --%>
				<td style="text-align: center;">
				
					<%=board.getQnaDate().substring(0, 19) %>	
				
								<%-- 조회수 --%>
				<td  style="text-align: center;">
				<%=board.getQnaReadcount() %></td>
			</tr>
			<% number--; %>
			<% } %>
		<% } %>
		</tbody>
</table>
<p class="xans-element- xans-board xans-board-empty-4 xans-board-empty xans-board-4 message displaynone "></p>
</div>
<div class="xans-element- xans-board xans-board-buttonlist-4 xans-board-buttonlist xans-board-4  ec-base-button ">
<% if(loginMember!=null) {//로그인 사용자인 경우 %>
<span class="gRight">
<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=qnawrite" class=" allStore-color-btn1">글쓰기</a>
</span>
</div><% } %>
</div>
	<%-- 페이지 번호 출력(페이징 처리)과 하이퍼 링크 설정 --%>
	<%
		//블럭에 출력될 페이지 번호의 갯수 설정
		int blockSize=5;
	
		//블럭에 출력될 시작 페이지 번호를 계산하여 저장
		// => 1 Block : 1, 2 Block : 6, 3 Block : 11, 4 Block : 16,...
		int startPage=(pageNum-1)/blockSize*blockSize+1;
		
		//블럭에 출력될 종료 페이지 번호를 계산하여 저장
		// => 1 Block : 5, 2 Block : 10, 3 Block : 15, 4 Block : 20,...
		int endPage=startPage+blockSize-1;
		
		//마지막 블럭의 종료 페이지 번호 변경
		if(endPage>totalPage) {
			endPage=totalPage;
		}
	%>
	
	<div class="ec-base-paginate">
	<% if(startPage>blockSize) { %>
	<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=qnaboard&pageNum=1&category=<%=category%>&search=<%=search%>&keyword=<%=keyword%>">[처음]</a>
	<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=qnaboard&pageNum=<%=startPage-blockSize%>&category=<%=category%>&search=<%=search%>&keyword=<%=keyword%>">[이전]</a>
	<% } else { %>
	<img src="./images/btn_page_first.gif" alt="처음"/><img src="./images/btn_page_prev.gif" alt="이전"/>
	<% } %>
	<ol>
	<% for(int i=startPage;i<=endPage;i++) { %>
		<% if(pageNum!=i) { %>
		<li><a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=qnaboard&pageNum=<%=i%>&category=<%=category%>&search=<%=search%>&keyword=<%=keyword%>">[<%=i %>]</a></li>
		<% } else { %>
		<li><a href="#" class="this"><%=i%></a></li> 
		<% } %>
	<% } %>
	</ol>
	<% if(endPage!=totalPage) { %>
	<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=qnaboard&pageNum=<%=startPage+blockSize%>&category=<%=category%>&search=<%=search%>&keyword=<%=keyword%>">[다음]</a>
	<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=qnaboard&pageNum=<%=totalPage%>&category=<%=category%>&search=<%=search%>&keyword=<%=keyword%>">[마지막]</a>
	<% } else { %>
	<img src="./images/btn_page_next.gif" alt="다음"/><img src="./images/btn_page_last.gif"alt="마지막"/>
	<% } %>
	</div>  
	<div class="xans-board-search">
	<form action="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=qnaboard" method="post">
	<fieldset class="boardSearch">
		<select id="search_key" name="search">
        	<option value="qna_title"<% if(search.equals("qna_title")) { %> selected="selected" <% } %>>제목</option>
        	<option value="qna_contents"<% if(search.equals("qna_contents")) { %> selected="selected" <% } %>>내용</option>
        	<option value="qna_mem_id"<% if(search.equals("qna_mem_id")) { %> selected="selected" <% } %>>아이디</option>
        </select>
		<input type="text" name="keyword">
		<button type="submit"><img src="<%=request.getContextPath()%>/coffee/images/btn_find.gif" alt="찾기"/></button>
		</fieldset>
	</form>
	</div>
</div>
</div>
</div>


<script type="text/javascript">
$("#category").change(function() {
	$("#categoryForm").submit();
});
</script>