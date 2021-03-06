<%@page import="java.util.Date"%>
<%@page import="ohyes.coffee.dto.NoticeDTO"%>
<%@page import="java.util.List"%>
<%@page import="java.text.SimpleDateFormat"%>
<%@page import="ohyes.coffee.dto.MemberDTO"%>
<%@page import="ohyes.coffee.dao.boardNoticeDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    
    <%

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
	int totalBoard=boardNoticeDAO.getDAO().selectNoticeCount(search, keyword);
	      
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
	List<NoticeDTO> boardList=boardNoticeDAO.getDAO().selectNoticeBoard(startRow, endRow, search, keyword);
	System.out.println(boardList.size());
	
	//현재 페이지의 게시글 목록에 출력될 시작 글번호를 계산하여 저장
	int number=totalBoard-(pageNum-1)*pageSize;
	int countnum=startRow=(pageNum-1)*pageSize;
	
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
<link rel="stylesheet" type="text/css" href="./boardNotis/optimizer.php">
<link rel="stylesheet" type="text/css" href="./boardNotis/optimizer(1).php">
    <!--allStore_contents-->
    <div id="allStore_contents">
        <div class="allStore_layout">
            
            <div>
<div class="xans-element- xans-board xans-board-listpackage-1002 xans-board-listpackage xans-board-1002 "><!--타이틀, 현재위치-->
<div class="xans-element- xans-board xans-board-title-1002 xans-board-title xans-board-1002 allStore-board-menupackage "><div class="title">
            <h2><font color="#555555">공지사항</font></h2>
        </div>
<div class="nav-path">
            <ol>
<li><a href="<%=request.getContextPath()%>/coffee/index.jsp">홈</a></li>
            <li title="현재 위치"><strong>공지사항</strong></li>
            </ol>
</div>
</div>
<!--타이틀, 현재위치-->
<!--이미지-->
<div class="xans-element- xans-board xans-board-title-1002 xans-board-title xans-board-1002 top-title-img "></div>
<!--이미지-->
<div class="boardSort">
<span class="xans-element- xans-board xans-board-replysort-1002 xans-board-replysort xans-board-1002 "></span>
</div>
<div class="ec-base-table typeList gBorder">
<table border="1" summary="">
<caption>게시판 목록</caption>
<colgroup class="xans-element- xans-board xans-board-listheader-1002 xans-board-listheader xans-board-1002 "  >
<col style="width:150px;">
<col style="width:auto;">
<col style="width:150px;">
<col style="width:150px;">
</colgroup>
<thead class="xans-element- xans-board xans-board-listheader-1002 xans-board-listheader xans-board-1002 " ><tr>
<tr style="  border-bottom: 2px solid black;   ">
	<th scope="col">번호</th>
	<th scope="col">제목</th>
	<th scope="col">작성일</th>
	<th scope="col">조회수</th>
</thead>
<tbody>
<% if(totalBoard==0) { %>
		<tr>
			<td colspan="5">검색된 게시글이 하나도 없습니다.</td>
		</tr>
		<% } else { %>
			<%-- 게시글 목록 출력 - 반복처리 --%>
			<% for(NoticeDTO board:boardList) { %>
			<tr>
				<%-- 글번호 --%>
				<td style="text-align: center;">
					 <% int count=(++countnum);%>
					 <%=count%>
				</td>
				<%-- 제목 --%>
				<%-- 게시글 상태에 대한 제목 출력과 하이퍼 링크 설정 --%>
				<td  style="text-align: center;">
				<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=viewnotice&noticeNo=<%=board.getNoticeNo()%>&pageNum=<%=pageNum%>&search=<%=search%>&keyword=<%=keyword%>"><%=board.getNoticeTitle() %></a>
				
				</td>
				
				
				<%-- 작성일 --%>
				<td  style="text-align: center;">
				
					<%=board.getNoticeDate().substring(0, 19) %>	
				
								<%-- 조회수 --%>
				<td  style="text-align: center;">
				<%=board.getNoticeReadcount() %></td>
			</tr>
			<% number--; %>
			<% } %>
		<% } %>
		</tbody>
	</table>

</div>
</div>
</div>
</div>
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
	<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=boardNotice.jsp&pageNum=1&search=<%=search%>&keyword=<%=keyword%>">[처음]</a>
	<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=boardNotice.jsp&pageNum=<%=startPage-blockSize%>&search=<%=search%>&keyword=<%=keyword%>">[이전]</a>
	<% } else { %>
	<img src="./images/btn_page_first.gif" alt="처음"/><img src="./images/btn_page_prev.gif" alt="이전"/>
	<% } %>
	<ol>
	<% for(int i=startPage;i<=endPage;i++) { %>
		<% if(pageNum!=i) { %>
		<li><a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=boardNotice&pageNum=<%=i%>&search=<%=search%>&keyword=<%=keyword%>">[<%=i %>]</a></li>
		<% } else { %>
		<li><a href="#" class="this"><%=i%></a></li> 
		<% } %>
	<% } %>
	</ol>
	<% if(endPage!=totalPage) { %>
	<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=boardNotice&pageNum=<%=startPage+blockSize%>&search=<%=search%>&keyword=<%=keyword%>">[다음]</a>
	<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=boardNotice&pageNum=<%=totalPage%>&search=<%=search%>&keyword=<%=keyword%>">[마지막]</a>
	<% } else { %>
	<img src="./images/btn_page_next.gif" alt="다음"/><img src="./images/btn_page_last.gif"alt="마지막"/>
	<% } %>
	</div>
	<br>