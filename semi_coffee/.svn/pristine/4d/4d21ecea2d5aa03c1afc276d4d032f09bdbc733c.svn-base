<%@page import="ohyes.coffee.dao.boardNoticeDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@include file="/coffee/Mypage/login_check.jspf" %>  
<link rel="stylesheet" type="text/css" href="../css/optimizerf714.css" />
<link rel="stylesheet" type="text/css" href="../css/common.css" />
<!--allStore_contents-->
<div id="allStore_contents">
	<div class="allStore_layout">
		<div>
			<div
				class="xans-element- xans-board xans-board-writepackage-4 xans-board-writepackage xans-board-4 ">
				<!--타이틀, 현재위치-->
				<div
					class="xans-element- xans-board xans-board-title-4 xans-board-title xans-board-4 allStore-board-menupackage ">
					<div class="title">
						<h2>
							<font color="#555555">QNA게시판</font>
						</h2>
					</div>
					<div class="nav-path">
						<ol>
							<li><a href="#">홈</a></li>
							<li title="현재 위치"><strong>QNA게시판</strong></li>
						</ol>
					</div>
				</div>
<form action="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=qnawrite_action" method="post" id="boardForm">
				<div class="ec-base-table typeWrite" style="padding-right: 80px;">
						<table border="1" summary="">

							<caption>글쓰기 폼</caption>

							<tbody>
							<tr class="">
									<th scope="row">ID</th>
									<td><%=loginMember.getMemId()%></td>
								</tr>

								<tr>

									<th scope="row">제목</th>
									<td><input style="width: 300px; height: 25px;"id="subject" name="subject" class="inputTypeText" value="" type="text">
									<span class="error" id="subjectch"></span>
									</td>
								</tr>

								
								<tr>
								<th scope="row">카테고리</th>
								<td><div id="content" class="error"></div><select name="qnaCode">
										<option value="1">회원/정보관리</option>
										<option value="2">주문/결제</option>
										<option value="3">배송</option>
										<option value="4">반품/환불/교환/AS</option>
										<option value="5">기타</option>
								</select></td></tr>
								<tr class="">
									<th scope="row" colspan="2">내용</th>
								</tr>
								<!-- 내용 크기수정해야됨 -->
								<tr class="" >
									<td colspan="2"><textarea  style="width: 1200px;" rows="15"
											cols="100" id="contents" name="contents"></textarea><span class="error" id="contentsch"></span></td>
								</tr>
								
							<tbody>
							
							</tbody>
				


							<tr class="agree ">
							</tr>
							</tbody>
						</table>
				</div>
						<div class="ec-base-button ">
					<button type="submit" style=" float: right; margin-right: 100px; "><img src="./board/images/btn_register.gif"  ></button>
					<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=qnaboard">
		<img src="./board/viewnotice/btn_list.gif" alt="목록" style="margin-left: 40px; float: left;"></a>	
					</div>	
				</form>
				</div>
			</div>

		</div>
	</div>

<!--allStore_contents-->
<script type="text/javascript">
//제목 유효성	
 	$("#subject").focus();
 	
 	$("#subject").blur(function() {
	if  ($("#subject").val()=="") {
		console.log('false');
		$("#subjectch").text("제목을 입력해 주세요.");
		$("#subjectch").css('color', 'red');
		$("#subject").focus();
	}else{
		console.log('true');
		$("#subjectch").text("");
		$("#contents").focus();
	}
});
//내용 유효성
 	$("#contents").blur(function() {
 		if  ($("#contents").val()=="") {
 			console.log('false');
 			$("#contentsch").text("내용을 입력해 주세요.");
 			$("#contentsch").css('color', 'red');
 			$("#contents").focus();
 		}else{
 			console.log('false');
 			$("#contentsch").text("");
 		}
 	});

document.addEventListener('keydown', function(event) {
if (event.keyCode === 13) {
    event.preventDefault();
}
}, true);

$("#boardForm").submit(function() {
	 alert("작성하신 문의글이 등록 되었습니다.")
}); 


</script>