<%@page import="ohyes.coffee.dao.NoticeAdminDAO"%>
<%@page import="ohyes.coffee.dto.NoticeDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	
	request.setCharacterEncoding("utf-8");
	
	int noticeNo=Integer.parseInt(request.getParameter("noticeNo"));
	System.out.println(noticeNo);
	
	NoticeDTO notice=NoticeAdminDAO.getDAO().selectNoticeAdminNo(noticeNo);
	
%>

<style>
/* Style inputs with type="text", select elements and textareas */
.output {
  min-height: 400px;
  display: block;
  width: 100%;	width:100%;
  padding: 12px; /* Some padding */ 
  border: 1px solid #ccc; /* Gray border */
  border-radius: 4px; /* Rounded borders */
  box-sizing: border-box; /* Make sure that padding and width stays in place */
  margin-top: 6px; /* Add a top margin */
  margin-bottom: 16px; /* Bottom margin */
  resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

/* Style the submit button with a specific background color etc */
.btn[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* When moving the mouse over the submit button, add a darker green color */
.btn[type=submit] :hover {
  background-color: #45a049;
}

/* Add a background color and some padding around the form */
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

#btnSet{
	display:inline-block;
	position: relative;
	left:50%;
	width:220px;
	margin-left: -110px;
}

#title{
	width:85%;
}

#content{
	height:450px; 
	width: 100%
}

#previewBtn{
	padding:12px;
}

</style>
<h2 style="text-align: center; margin-top:20px;"><%=notice.getNoticeTitle()%></h2>
<hr>

<div class="container">
	
    <span class="output"><%=notice.getNoticeContents()%></span>
    
    <form id="form" method="post">
    	<input type="hidden" name="noticeNo" value="<%=noticeNo%>" >
    	<input type="hidden" name="change" id="change">
    	<div id="btnSet">
	    	<button id="updateBtn" name="updateBtn" class="btn">글수정</button>
	    	<button id="deleteBtn" name="deleteBtn" class="btn">글삭제</button>
   		 </div>
    </form>

</div>

<script>
	$("#updateBtn").click(function(){
		$("#form").attr("action", "<%=request.getContextPath()%>/coffee/admin/index.jsp?part=notice&work=update");
		$("#form").submit();
	})
	
	$("#deleteBtn").click(function(){
		
		 var result = confirm("복구가 안됩니다. 정말 모두 삭제하겠습니까?");
		 if(!result){
		     return false;
		 }
		
		 
		$("#change").attr("value", "delete");
		$("#form").attr("action", "<%=request.getContextPath()%>/coffee/admin/index.jsp?part=notice&work=update_action");
		$("#form").submit();
	})
	
	
	
</script>