<%@page import="ohyes.coffee.dto.QnaCoDTO"%>
<%@page import="ohyes.coffee.dao.QnaCoAdminDAO"%>
<%@page import="ohyes.coffee.dto.MemberDTO"%>
<%@page import="ohyes.coffee.dao.QnaBoardDAO"%>
<%@page import="ohyes.coffee.dto.QnaDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	int qnaNo=Integer.parseInt(request.getParameter("qnaNo"));
	String pageNum=request.getParameter("pageNum");
	String search=request.getParameter("search");
	String keyword=request.getParameter("keyword");
	
	QnaDTO board=QnaBoardDAO.getDAO().selectNumBoard(qnaNo);
	QnaBoardDAO.getDAO().updateReadCount(qnaNo);
	QnaCoDTO board1=QnaCoAdminDAO.getDAO().selectQnaCoAdmin(qnaNo);
	
	MemberDTO loginMember=(MemberDTO)session.getAttribute("loginMember");
	
%>
<link rel="stylesheet" type="text/css" href="./viewnotice/optimizer.php">
<link rel="stylesheet" type="text/css" href="./viewnotice/optimizer(1).php">
    <!--allStore_contents-->
<div id="allStore_contents">
<div class="allStore_layout">
            
<div>
<div class="xans-element- xans-board xans-board-readpackage-1002 xans-board-readpackage xans-board-1002 "><!--타이틀, 현재위치-->
<div class="xans-element- xans-board xans-board-title-1002 xans-board-title xans-board-1002 allStore-board-menupackage "><div class="title">
<h2><font color="#555555">공지사항</font></h2>
        </div>
<div class="nav-path">
            <ol>
<li><a href="http://coffeechoi.co.kr/">홈</a></li>
            <li title="현재 위치"><strong>공지사항</strong></li>
            </ol>
</div>
</div>
<!--타이틀, 현재위치-->
<div class="ec-base-table typeWrite " >
            <table border="1" summary="" >
<caption>게시판 상세<%=board.getQnaReadcount()+1 %></caption>
            <colgroup>
<col style="width:130px;">
<col style="width:auto;">
</colgroup>
<tbody >
<tr>
<th scope="row">제목 
</th>
<td><%=board.getQnaTitle() %></td>
                    
 </tr>
<tr>
<th scope="row" >작성자
</th>
<td><%=board.getQnaMemId() %></td>
                    
 </tr>

 <tr class="">
<td  colspan="2" >
<textarea style="width: 1200px;" rows="15" cols="200" name="contents" readonly="readonly"><%=board.getQnaContents() %> </textarea>
</td>
</tr>
<tr>
<% if(board.getQnaStatus()==1){%>
<td  colspan="2" ><!-- 코멘트 리스트 -->
<ul class="boardComment">
<li class="first  xans-record-">
                <div class="commentTop">
                    <strong class="name">ohyes coffee</strong>
                    <span class="date"><%=board1.getQnaCoDate() %> </span>
                </div>
                <div class="comment">
                    <textarea style="width: 1200px;" rows="5" cols="200" name="contents" readonly="readonly"><%=board1.getQnaCoContent() %> </textarea>               
                </div>
            </li>
            </ul>
</td>
</tr>
	<%}%>
</tbody>
</table>


</div>
	<div id="board_menu">
		<%-- 로그인 사용자가 작성자이거나 관리자인 경우 --%>
		<% if(loginMember!=null && loginMember.getMemId().equals
				(board.getQnaMemId())) { %>
		<button type="button" id="modifyBtn" style=" float: right; margin-right: 80px; margin-left: 5px; "><img src="./board/images/btn_modify.gif" "></button>
		<button type="button" id="removeBtn" style=" float: right;  "><img src="./board/images/btn_delete.gif" ></button>
		<% } %>
		<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=qnaboard">
		<img src="./board/viewnotice/btn_list.gif" alt="목록" style="margin-left: 40px; "></a>
	</div>
</div>
</div>

<form id="boardForm" method="post">
	<%-- 게시글 변경 입력페이지와 삭제 처리 페이지를 요청하여 전달하기 위한 값 --%>
	<input type="hidden" name="qnaNo" value="<%=board.getQnaNo()%>">
	<%-- 게시글 목록 출력페이지를 요청하여 전달하기 위한 값 --%>
	<input type="hidden" name="pageNum" value="<%=pageNum%>">
	<input type="hidden" name="search" value="<%=search%>">
	<input type="hidden" name="keyword" value="<%=keyword%>">
</form>
</div></div>
</div>
<script type="text/javascript">
$("#modifyBtn").click(function() {
	$("#boardForm").attr("action","<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=qnamodify");
	$("#boardForm").submit();
});
$("#removeBtn").click(function() {
	if(confirm("정말로 삭제 하시겠습니까?")) {
		$("#boardForm").attr("action","<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=removeqna_action");
		$("#boardForm").submit();
	}
});
</script>