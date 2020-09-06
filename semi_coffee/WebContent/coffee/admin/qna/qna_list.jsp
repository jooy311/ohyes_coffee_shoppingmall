<%@page import="ohyes.coffee.dao.QnaAdminDAO"%>
<%@page import="ohyes.coffee.dto.QnaDTO"%>
<%@page import="java.util.List"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    
<%
	request.setCharacterEncoding("utf-8");
	
	String code=request.getParameter("code");
	if(code==null) code="0";
	
	String date=request.getParameter("date");
	if(date==null) date="0";

	String status=request.getParameter("status");
	if(status==null) status="2";

	System.out.println(code+"/"+date+"/"+status);
	

	int pageNum=1;	//페이지 번호
	if(request.getParameter("pageNum")!=null){
		pageNum=Integer.parseInt(request.getParameter("pageNum"));
	}
	
	int pageSize=10; //한페이지에 출력될 게시글 갯수
	int totalQna=QnaAdminDAO.getDAO().searchCountQnaAdmin(code, date, status);	//검색 게시글의 갯수
	
	int totalPage=(int)Math.ceil((double)totalQna/pageSize);	//검색게시글에 대한 페이지의 갯수
	
	int startRow=(pageNum-1)*pageSize+1; //현재페이지의 시작행번호 (3페이지는 21)
	int endRow=pageNum*pageSize;	//현재페이지의 종료행번호(3페이지는 30)=> 마지막페이지는 totalBoard와 동일
	if(endRow>totalQna){
		endRow=totalQna;
	}
	
	List<QnaDTO> qnaList=QnaAdminDAO.getDAO().selectQnaAdminAll();	
	System.out.println("리스트사이즈 : " + qnaList.size());
	if(!(code.equals("0") && date.equals("0") && status.equals("2"))){
		qnaList=QnaAdminDAO.getDAO().selectQnaAdminByKeyword(startRow, endRow, code, date, status);		
	}
	
	int number=totalQna;	//현재페이지에서 시작될 글의 고유번호
	
%>
    
<style>
.radio{
 padding:12px 20px 12px 12px;
}
</style>

<!-- content 영역 -->
<div class="container-fluid">
	<div>&nbsp;</div>
	<h4>게시판관리 >> Q&#38;A</h4>
	<hr>

	<!-- 검색패널 -->
	<div class="container">

		<%-- from태그 --%>
		<form method="post">

			<!-- 카테고리 검색-->
			<div class="row">
				<div class="col-25">
					<label for="code">검색 분류</label>
				</div>
				<div class="col-75">
					<select id="code" name="code">
						<option value="0">전체</option>
						<option value="1">회원, 정보관리</option>
						<option value="2">주문, 결제</option>
						<option value="3">배송</option>
						<option value="4">반품, 환불, 교환, AS</option>
						<option value="5">기타</option>
					</select>
				</div>
			</div>

			<!-- 기간 검색 -->
			<div class="row">
				<div class="col-25">
					<label for="date">기간</label>
				</div>
				<div class="col-75">
					<select id="date" name="date">
						<option value="0">전체</option>
						<option value="1">일주일</option>
						<option value="2">1개월</option>
						<option value="3">3개월</option>
					</select>
				</div>
			</div>

			<!-- 답변여부 -->
			<div class="row">
				<div class="col-25">
					<label for="status">상태</label>
				</div>
				<div class="col-75">
					<select id="status" name="status">
						<option value="2">전체</option>
						<option value="0">답변전</option>
						<option value="1">답변완료</option>
					</select>
				</div>
			</div>

			<!-- 검색버튼 -->
			<div class="row">
				<input type="submit" value="검색">
			</div>
		</form>
	</div>
	<!-- 검색패널 End -->


	<div>&nbsp;</div><div>&nbsp;</div>

	<!-- 결과패널 -->
	<div class="content-panel">
		<div style="display:flex; margin-bottom: 10px;">
			<h4 style="flex:3;">검색 결과</h4>
		    <div style="color:blue; flex:10;">
				- 제목을 클릭하여 문의글 상세페이지를 볼수 있습니다.	
			</div>
			<div id="Msg" style="color:red; flex:6; display: none;"></div>
		</div>	
		
		<!-- form 태그-->
		<form>
			<table class="table table-striped table-advance table-hover">
	
				<!-- 테이블 컬럼명-->
				<thead>
					<tr>
						<th>선택</th>
						<th>번호</th>
						<th>카테고리</th>
						<th>제목</th>
						<th>작성자</th>
						<th>작성날짜</th>
						<th>답변유무</th>
					</tr>
				</thead>
	
				<tbody>
				<% for(QnaDTO list:qnaList){ %>
					<tr>
						<td><input type="checkbox" id="selectedQna" name="selectedQna" value="<%=list.getQnaNo()%>">
						<td><%=list.getQnaNo() %></td>
						<td>
							<%
								String qnaCategory="";
								switch(list.getQnaCode()){
									case 1: 
										qnaCategory="회원, 정보관리";
										break;
									case 2: 
										qnaCategory="주문, 결제";
										break;
									case 3: 
										qnaCategory="배송";
										break;
									case 4: 
										qnaCategory="반품, 환분, 교환, AS";
										break;
									case 5: 
										qnaCategory="기타";
										break;
								}
							%>
							<%=qnaCategory%>
						</td>
						<td><a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=qna&work=detail&qnaNo=<%=list.getQnaNo()%>"><%=list.getQnaTitle() %></a></td>
						<td><%=list.getQnaMemId() %> </td>
						<td><%=list.getQnaDate() %></td>
						<td>
							
							<% if(list.getQnaStatus()==0){%>
								답변전
							<%} else if(list.getQnaStatus()==1) {%>			
								답변완료
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
			<div style="text-align: center;">
			<%if(startPage>blockSize){ %>
				<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=qna&work=list&pageNum=1&code=<%=code%>&date=<%=date%>&status=<%=status%>">[처음]</a>
				<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=qna&work=list&pageNum=<%=startPage-blockSize%>&code=<%=code%>&date=<%=date%>&status=<%=status%>">[이전]</a>
			<%} else{ %>
				[처음][이전]
			<%} %>
			
			<%for(int i=startPage;i<=endPage;i++){ %>
				<%if(pageNum!=i){ %>
					<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=qna&work=list&pageNum=<%=i%>&code=<%=code%>&date=<%=date%>&status=<%=status%>">[<%=i%>]</a>		
				<%} else{ %>
					<span>[<%=i%>]</span>			
				<%} %>				
			<%} %>
			
			<%if(endPage!=totalPage){ %>
				<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=qna&work=list&pageNum=<%=startPage+blockSize%>&code=<%=code%>&date=<%=date%>&status=<%=status%>">[다음]</a> 
				<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=qna&work=list&pageNum=<%=totalPage %>&code=<%=code%>&date=<%=date%>&status=<%=status%>">[마지막]</a>
			<%} else{ %>
				[다음][마지막]
			<%} %>
			</div>
		
	</div> <!-- 결과패널 End -->
	
</div>	<!-- content영역 End -->
