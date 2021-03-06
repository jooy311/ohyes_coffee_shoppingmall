<%@page import="ohyes.coffee.dao.NoticeAdminDAO"%>
<%@page import="ohyes.coffee.dto.NoticeDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	
	request.setCharacterEncoding("utf-8");

	String change=request.getParameter("change");
	int noticeNo=Integer.parseInt(request.getParameter("noticeNo"));
	
	System.out.println(change+"/"+noticeNo);
	
	NoticeDTO notice=NoticeAdminDAO.getDAO().selectNoticeAdminNo(noticeNo);
	System.out.println("전 : "+notice.getNoticeContents());
%>

<style>
/* Style inputs with type="text", select elements and textareas */
input[type=text], textarea {
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
<h2 style="text-align: center; margin-top:20px;">공지글 수정</h2>
<hr>

<div class="container">
  <form action="<%=request.getContextPath() %>/coffee/admin/notice/notice_update_action.jsp" method="post">
  	<input type="hidden" name="noticeNo" value="<%=noticeNo%>" >


    <label for="title" style="padding:5px;">제목</label>
    <input type="text" id="title" name="title" value="<%=notice.getNoticeTitle()%>">
    
    <textarea id="content" name="content"><%=notice.getNoticeContents() %></textarea> 
    <!-- <input id="content" name="content" value="<%=notice.getNoticeContents() %>" style="min-height:400px;"> -->
    
    <%
    	System.out.println("후 : " + notice.getNoticeContents());	
    
    %>

	<div id="btnSet">
	    <button id="saveBtn" name="saveBtn" value="1" class="btn" type="submit">임시저장</button>
	    <button id="saveBtn" name="saveBtn" value="2" class="btn" type="submit">글올리기</button>
    </div>

  </form>
  
  <!-- !! null값에 대한 유효성검사 필요  -->
  <!-- !! 이 폼으로 변경도 되도록 하자-->
</div>
