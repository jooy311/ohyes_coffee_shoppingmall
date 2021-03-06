<%@page import="ohyes.coffee.dao.QnaCoAdminDAO"%>
<%@page import="ohyes.coffee.dto.QnaCoDTO"%>
<%@page import="ohyes.coffee.dao.QnaAdminDAO"%>
<%@page import="ohyes.coffee.dto.QnaDTO"%>
<%@page import="ohyes.coffee.dao.NoticeAdminDAO"%>
<%@page import="ohyes.coffee.dto.NoticeDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>

<%
	request.setCharacterEncoding("utf-8");	

	int qnaNo=Integer.parseInt(request.getParameter("qnaNo"));

	//부모글 불러오기
	QnaDTO qna=QnaAdminDAO.getDAO().selectQnaAdminNo(qnaNo);
	//답변이 있으면 불러오기
	String qnaCoContent="";
	if(qna.getQnaStatus()==1){
		QnaCoDTO qnaCo=QnaCoAdminDAO.getDAO().selectQnaCoAdmin(qnaNo);
		qnaCoContent=qnaCo.getQnaCoContent(); 
	}
%>

<link rel="stylesheet" href="<%=request.getContextPath() %>/coffee/admin/css/jin_detail.css">
<link rel="stylesheet" href="<%=request.getContextPath() %>/coffee/admin/css/jin_write.css">

<div id="detailHeader" style="text-align: center;margin:20px 0;" >
	<h2 style="display:inline; "><%=qna.getQnaTitle() %></h2>

	<!-- 답변 없으면 => 답변쓰기 / 답변 있으면 => 답변 수정 -->
	<% if(qna.getQnaStatus()==0){ 	//답변이 없는 경우 %> 
	<button id="insertCoBtn" type="button" style="float: right; margin:0 10px;">답변쓰기</button>

	<% } else if(qna.getQnaStatus()==1){	//답변이 있는 경우 %>
	<button id="deleteCoBtn" type="button" style="float: right; margin:0 10px;">답변삭제</button>
	<button id="updateCoBtn" type="button" style="float: right; margin:0 10px;">답변수정</button>
	<% }%>
	
	<button id="deleteQnaBtn" name="" type="button" style="float: right; margin:0 10px;">글삭제</button>
</div>
<hr>

<!-- 문의글 패널 -->
<div class="container">

	<span style="margin:0 10px;">카테고리</span>
	<span class="output" style="width:24%; display:inline-block; margin-right: 10px;">
		<%
			String qnaCategory="";
			switch(qna.getQnaCode()){
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
		<%=qnaCategory %>
	</span>
	
	<span style="margin:0 10px;">작성자</span>
	<span class="output" style="width:24%; display:inline-block; margin-right: 10px;"><%=qna.getQnaMemId() %></span>
	
	<span style="margin:0 10px;">작성날짜</span>
	<span class="output" style="width:24%; display:inline-block;"><%=qna.getQnaDate() %></span>
	
    <span class="output" style="min-height: 150px;"><%=qna.getQnaContents() %></span>


</div>

<hr>

<!-- 답변 패널 -->
<form id="coForm" method="post" action="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=qna&work=action">
	<input type="hidden" id="fromQna" name="fromQna">
	<input type="hidden" id="qnaNo" name="qnaNo" value="<%=qna.getQnaNo()%>">
	
	<div id="coPanel" class="container" style="display:none;">
		
	    <textarea id="content" name="content" placeholder="답을 작성해주세요." style="height: 150px;" disabled="disabled"><%=qnaCoContent %></textarea>
	
		<span id="message" style="display:none; color:red">내용을 입력해주세요</span>
		
		<button id="CoBtn" name="" value="" class="" type="button" style="float: right;">완료</button>
	</div>
</form>


<script>

//답변패널 보이도록 : 답변이 있을때
if(<%=qna.getQnaStatus()%>==1){
	$("#coPanel").css("display", "block");
}
//답변쓰기 버튼
$("#insertCoBtn").click(function(){
	$("#fromQna").val("insertCo");
	$("#content").removeAttr('disabled');
	$("#coPanel").css("display", "block");
})	

//답변수정 버튼
$("#updateCoBtn").click(function(){
	$("#fromQna").val("updateCo");
	$("#content").removeAttr('disabled');
	
})	

//답변삭제 버튼
$("#deleteCoBtn").click(function(){
	
	var result = confirm("복구가 안됩니다. 정말 모두 삭제하겠습니까?");
	 if(!result){
	     return false;
	 }
	
	
	$("#fromQna").val("deleteCo");
	$("#coForm").submit();	
})	

//글삭제 버튼
$("#deleteQnaBtn").click(function(){
	
	var result = confirm("복구가 안됩니다. 정말 모두 삭제하겠습니까?");
	 if(!result){
	     return false;
	 }
	
	$("#fromQna").val("deleteQna");
	$("#coForm").submit();	
})	


//완료버튼 유효성검사
$("#CoBtn").click(function(){
	if($("#content").val()==""){//답변 입력 안하면 submit 막기 
		$("#message").css("display", "block");
		return;
	}
	
	if(!$("#content").change()){
		$("#message").css("display", "block");
		return;
	}
	
	$("#coForm").submit();		
});


</script>

