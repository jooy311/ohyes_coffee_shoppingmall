<%@page import="ohyes.coffee.dao.NoticeAdminDAO"%>
<%@page import="java.util.ArrayList"%>
<%@page import="ohyes.coffee.dto.NoticeDTO"%>
<%@page import="java.util.List"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
	
<%
	request.setCharacterEncoding("utf-8");
	
	String keyword=request.getParameter("keyword");
	//keyword=new String(keyword.getBytes("ISO-8859-1"), "UTF-8");
	if(keyword==null) keyword="";

	String status=request.getParameter("status");
	if(status==null) status="all";

	System.out.println(keyword +"/"+status);
	
	int s=0;
	if(status.equals("all")){
		s=NoticeAdminDAO.ALL;
	} else if(status.equals("temp")){
		s=NoticeAdminDAO.TEMP;
	} else if(status.equals("submit")){
		s=NoticeAdminDAO.SUBMIT;
	}

	//System.out.println(keyword +"/"+status);

	
	
	int pageNum=1;	//페이지 번호
	if(request.getParameter("pageNum")!=null){
		pageNum=Integer.parseInt(request.getParameter("pageNum"));
	}
	
	int pageSize=10; //한페이지에 출력될 게시글 갯수
	int totalNotice=NoticeAdminDAO.getDAO().selectNoticeAdminCount(keyword, s);	//검색 게시글의 갯수
	int totalPage=(int)Math.ceil((double)totalNotice/pageSize);	//검색게시글에 대한 페이지의 갯수
	
	int startRow=(pageNum-1)*pageSize+1; //현재페이지의 시작행번호 (3페이지는 21)
	int endRow=pageNum*pageSize;	//현재페이지의 종료행번호(3페이지는 30)=> 마지막페이지는 totalBoard와 동일
	if(endRow>totalNotice){
		endRow=totalNotice;
	}
	
	List<NoticeDTO> noticeList=NoticeAdminDAO.getDAO().selectNoticeAdminByKeyword(startRow, endRow, keyword, s);
	
	int number=totalNotice;	//현재페이지에서 시작될 글의 고유번호
	
%>

<style>
#writeBtn, #deleteBtn{
	margin:0 7px;
	float: right;
}


	
</style>

<!-- content 영역 -->
<div class="container-fluid">
	<div>&nbsp;</div>
	<h4><i class="fa fa-angle-right"></i>게시판관리 >> 공지 </h4>
	<hr>
		
	<!-- 검색패널 -->
	<div class="container">
		
		<%-- form태그 --%>
		<form id="searchForm" method = "post">
				
			<!-- 키워드 검색 -->
			<div class="row">
				<div class="col-25">
					<label for="keyword">공지글 키워드</label>
				</div>
				<div class="col-75">
					<input type="text" id="keyword" name="keyword" placeholder="키워드를 입력해주세요." >
				</div>
			</div>
			
			<!-- 글상태유무 : 임시저장 / 글올린거 -->
			<div class="row">
				<div class="col-25">
					<label for="status">상태</label>
				</div>
				<div class="col-75">
				    <select id="status" name="status">
				      <option value="all" selected="selected">전체보기</option>
				      <option value="temp" >임시저장</option>
				      <option value="submit">게시중</option>
				    </select>
				</div>
			</div>
				
			<!-- 검색버튼 -->
			<div class="row">
				<input type="submit" value="검색">
			</div>
		</form>
		
	</div>	<!-- 검색패널 End -->

	<div>&nbsp;</div><div>&nbsp;</div>
	
	<!-- 결과패널 -->
    <div class="content-panel">
    	<div style="display:flex; margin-bottom: 10px;">
	    	<h4 style="flex:3;">검색 결과</h4>
	    	<div style="color:blue; flex:10;">
				- 제목을 클릭하여 공지글 상세페이지를 볼수 있습니다.	
			</div>
			<div id="Msg" style="color:red; flex:6; display: none;"></div>
	    		<button class="btn btn-danger btn-xs" id="deleteBtn" type="button" style="flex:1;float:right;">글삭제</button> <!-- !!체크박스 선택한게 없으면 메세지 뜨도록 -->
	    		<button class="btn btn-primary btn-xs" id="writeBtn" type="button" style="flex:1;float:right;">글작성</button>
	    	<hr>
        </div>    
          
	    <form id="form" name="form" method="post">
	        <input type="hidden" name="change" id="change" value="deleteAll">
		    	<table class="table table-striped table-advance table-hover">
		                
		        	<!-- 테이블 컬럼명 -->
					<thead>
						<tr>
			            	<th>선택</th>
			                <th>번호</th>
			                <th>제목</th>  	<!-- !! 상페페이지로 이동하기 -->
			                <th>작성날짜</th>	<!-- !! 순서버튼넣을까? -->
			                <th>조회수</th>	<!-- !! 순서버튼넣을까? -->
			                <th>글상태</th>
						</tr>
					</thead>
			                
			        <!-- 테이블 행출력 -->
			        <tbody>
			        	<% for(NoticeDTO list:noticeList){ %>
			        	<tr>
			            	<td>
			            		<input type="checkbox" class="check" name="check" value="<%=list.getNoticeNo()%>">
			            	</td>
			                <td><%=list.getNoticeNo() %></td>
			                <td style="text-decoration: none;">
			                	<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=notice&work=detail&noticeNo=<%=list.getNoticeNo()%>">
			                		<%=list.getNoticeTitle()%>
			                	</a>
			                </td>
			                <td><%=list.getNoticeDate() %></td>	<!-- !! 형식 맞추기  -->
			                <td><%=list.getNoticeReadcount() %></td>
			                <td>
			                	<%if(list.getNoticeStatus()==1){%>
								임시저장
								<%}else{ %>
								게시중
								<%} %>	                
			                </td>	
						</tr>
						<%} %>
					</tbody>
		                
				</table>
			</form>
			
			<!-- 페이징처리 -->
			<%
				int blockSize=5;	//출력될 페이지번호의 갯수 설정
				int startPage=(pageNum-1)/blockSize*blockSize+1;//??출력될 첫번째 페이지번호
				int endPage=startPage+blockSize-1;	//출력될 마지막 페이지번호
				if(endPage>totalPage){
					endPage=totalPage;
				}
			%>
			<div style="text-align: center;margin:30px;">
			<%if(startPage>blockSize){ %>
				<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=notice&work=list&pageNum=1&keyword=<%=keyword%>&status=<%=status%>">[처음]</a>
				<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=notice&work=list&pageNum=<%=startPage-blockSize%>&keyword=<%=keyword%>&status=<%=status%>">[이전]</a>
			<%} else{ %>
				[처음][이전]
			<%} %>
			
			<%for(int i=startPage;i<=endPage;i++){ %>
				<%if(pageNum!=i){ %>
					<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=notice&work=list&pageNum=<%=i%>&keyword=<%=keyword%>&status=<%=status%>">[<%=i%>]</a>		
				<%} else{ %>
					<span>[<%=i%>]</span>			
				<%} %>				
			<%} %>
			
			<%if(endPage!=totalPage){ %>
				<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=notice&work=list&pageNum=<%=startPage+blockSize%>&keyword=<%=keyword%>&status=<%=status%>">[다음]</a> 
				<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=notice&work=list&pageNum=<%=totalPage %>&keyword=<%=keyword%>&status=<%=status%>">[마지막]</a>
			<%} else{ %>
				[다음][마지막]
			<%} %>
			</div>
			
			
			
             
	</div> <!-- 결과패널 End -->

</div>	<!-- content영역 End -->

	<!-- !!체크박스 선택 후 삭제처리 -->
	<!-- !!검색기능 -->
	<!-- !!페이징처리 -->


<script>
	
	$("#writeBtn").click(function() {
		location.href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=notice&work=write";
	})
	
	$("#deleteBtn").click(function() {	
		c
		//선택된 행이 없으면 메시지 보이도록
		 if (!$('.check').is(':checked')) {
			 $("#Msg").text("하나 이상을 선택해야 삭제할 수 있습니다.");
			 $('#Msg').css("display", "block");
	         return false;
	     }
		
		$("#form").attr("action",  "<%=request.getContextPath()%>/coffee/admin/index.jsp?part=notice&work=update_action");
		$("#form").submit();
	})
	
	
		
</script>

	
