<%@page import="java.util.ArrayList"%>
<%@page import="ohyes.coffee.dto.MemberDTO"%>
<%@page import="java.util.List"%>
<%@page import="ohyes.coffee.dao.MemberAdminDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
   
<%
	request.setCharacterEncoding("utf-8");
	
	String phone=request.getParameter("phone");
	if(phone==null) phone="";
	
	String name=request.getParameter("name");
	if(name==null) name="";

	String MemStatus=request.getParameter("MemStatus");
	if(MemStatus==null) MemStatus="All";

	System.out.println("list에서 전달값 확인 : "+phone +"/"+name +"/"+MemStatus);
	
	int s=0;
	if(MemStatus.equals("All")){
		s=MemberAdminDAO.ALL;
	} else if(MemStatus.equals("Mem")){
		s=MemberAdminDAO.MEM;
	} else if(MemStatus.equals("Admin")){
		s=MemberAdminDAO.ADMIN;
	}

	System.out.println("list에서 매개변수 : "+phone +"/"+name +"/"+s);
	
	int pageNum=1;	//페이지 번호
	if(request.getParameter("pageNum")!=null){
		pageNum=Integer.parseInt(request.getParameter("pageNum"));
	}
	
	int pageSize=10; //한페이지에 출력될 게시글 갯수
	int totalMem=MemberAdminDAO.getDAO().searchCountMemAdmin(phone, name, s);	//검색 게시글의 갯수
	int totalPage=(int)Math.ceil((double)totalMem/pageSize);	//검색게시글에 대한 페이지의 갯수
	
	int startRow=(pageNum-1)*pageSize+1; //현재페이지의 시작행번호 (3페이지는 21)
	int endRow=pageNum*pageSize;	//현재페이지의 종료행번호(3페이지는 30)=> 마지막페이지는 totalBoard와 동일
	if(endRow>totalMem){
		endRow=totalMem;
	}
	
	//List<MemberDTO> memberList=MemberAdminDAO.getDAO().selectMemAdminAll();		
	//if(!(phone.equals("") && name.equals("") && MemStatus.equals("All"))){
		List<MemberDTO>  memberList=MemberAdminDAO.getDAO().searchMemAdmin(startRow, endRow, phone, name, s);
	//}
	System.out.println("list에서 검색결과 사이즈 : "+memberList.size());
	
	int number=totalMem;	//현재페이지에서 시작될 글의 고유번호
	
%>

<style>
#deleteBtn{
	margin:0 7px;
	float: right;
}

.changeAddress1, .changeAddress2{
	width: 270px;
    display: block;
}

</style> 


<!-- content 영역  -->
<div class="container-fluid">
	<div>&nbsp;</div>
	<h4>고객관리 </h4>
	<hr>

	<!-- 검색패널 -->
	<div class="container">
	
		<!-- form태그-->
		<form method = "post">
		
			<!-- 핸드폰번호 검색 -->	
			<div class="row">
				<div class="col-25">
					<label for="phone">핸드폰번호 (뒷자리)</label>
				</div>
				<div class="col-75">
					<input type="text" id="phone" name="phone" placeholder="마지막 핸드폰번호  4자리를 모두 입력해주세요.">
				</div>
			</div>	
				
			<!--이름 검색-->
			<div class="row">
				<div class="col-25">
					<label for="name">이름</label>
				</div>
				<div class="col-75">
					<input type="text" id="name" name="name" placeholder="이름을 정확하게 입력해주세요">
				</div>
			</div>
			

			
			<!-- 회원상태유무 : 임시저장 / 글올린거 -->
			<div class="row">
				<div class="col-25">
					<label for="MemStatus">등급</label>
				</div>
				<div class="col-75">
				    <select id="MemStatus" name="MemStatus">
				    	<option value="All">전체</option>
				      	<option value="Mem">회원</option>
				      	<option value="Admin">관리자</option>
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
				- 핸드폰번호와 주소는 더블클릭하면 수정칸이 나타납니다.</br>
				- 등급은 클릭하고 선택하면 바로 변경할 수 있습니다.			
			</div>
			<div id="Msg" style="color:red; flex:6; display: none;"></div>
	    	<button class="btn btn-danger btn-xs" id="deleteAllBtn" type="button" style="flex:2;float:right;">회원정보삭제</button>
	    	<hr>
	    </div>
	    
	    <form id="MemListForm" name="MemListForm" method = "post"> 
	    	<!-- 처리목적 보내기 -->
			<input id="fromMem" name="fromMem" type="hidden">
			
			
	    		
		    <table class="table table-striped table-advance table-hover">
	                
	            <!-- 테이블 컬럼명-->
				<thead>
					<tr>
						<th style="width:5%;overflow: hidden;">선택</th>
	                    <th style="width:7%;overflow: hidden;">이름</th>
	                    <th style="width:10%;overflow: hidden;">아이디</th>
	                    <th style="width:13%;overflow: hidden;">핸드폰번호</th>
	                    <th style="width:28%;overflow: hidden;">주소</th>
	                    <th style="width:15%;overflow: hidden;">이메일</th>
	                    <th style="width:13%;overflow: hidden;">등급</th>
	                    <th style="width:10%;overflow: hidden;">삭제여부</th>
					</tr>
				</thead>
	                
	            <!-- 테이블 행출력 -->    
	            <tbody>
	            	<% for(MemberDTO list:memberList){ %>
	            	
	            	<tr>
	                	<td><input type="checkbox" class="selectedMems" name="selectedMems" value="<%=list.getMemId()%>"></td>
	                    <td><%=list.getMemName()%></td>
	                    <td><%=list.getMemId()%></td>
	                    <td class="click">
	                    	<span class="updatePhone" style="color:blue"><%=list.getMemPhone()%>
	                    		<input type="hidden" class="changePhone" name="<%=list.getMemId() %>" value="<%=list.getMemPhone()%>">
	                    	</span>
	                    </td>
	                    <td class="click">
	                    	<span class="updateAddress" style="color:blue">
	                    		<span style="display:block;"><%=list.getMemZip()%>/<%=list.getMemAddress1()%>/<%=list.getMemAddress2()%></span>
	                    		<input type="hidden" readonly="readonly" class="changeZip"  value="<%=list.getMemZip()%>" style="width:150px;">
	                    		<input type="hidden" class="searchPost" onclick="execDaumPostcode()" value="검색">
	                    		<input type="hidden" readonly="readonly" class="changeAddress1" value="<%=list.getMemAddress1()%>" >
	                    		<input type="hidden" class="changeAddress2" value="<%=list.getMemAddress2()%>" name="<%=list.getMemId() %>">
	                    	</span>
	                    	
	                    </td>
	                    <td><%=list.getMemEmail()%></td>
	                    <td>
	                    	<select class="updateStatus" name="<%=list.getMemId() %>" style="color:blue;">
								<option value="1" <% if(list.getMemStatus()==1) { %> selected="selected" <% } %>>&nbsp;일반회원&nbsp;</option>
								<option value="9" <% if(list.getMemStatus()==9) { %> selected="selected" <% } %>>&nbsp;관리자&nbsp;</option>
							</select>
	                    </td>
					    <td>
					    	<button type="submit"  class="deleteOneBtn" name="selectedMem" value="<%=list.getMemId() %>">삭제</button>
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
				<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=member&work=list&pageNum=1&phone=<%=phone%>&name=<%=name%>&MemStatus=<%=MemStatus%>">[처음]</a>
				<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=member&work=list&pageNum=<%=startPage-blockSize%>&phone=<%=phone%>&name=<%=name%>&MemStatus=<%=MemStatus%>">[이전]</a>
			<%} else{ %>
				[처음][이전]
			<%} %>
			
			<%for(int i=startPage;i<=endPage;i++){ %>
				<%if(pageNum!=i){ %>
					<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=member&work=list&pageNum=<%=i%>&phone=<%=phone%>&name=<%=name%>&MemStatus=<%=MemStatus%>">[<%=i%>]</a>		
				<%} else{ %>
					<span>[<%=i%>]</span>			
				<%} %>				
			<%} %>
			
			<%if(endPage!=totalPage){ %>
				<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=member&work=list&pageNum=<%=startPage+blockSize%>&phone=<%=phone%>&name=<%=name%>&MemStatus=<%=MemStatus%>">[다음]</a> 
				<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=member&work=list&pageNum=<%=totalPage %>&phone=<%=phone%>&name=<%=name%>&MemStatus=<%=MemStatus%>">[마지막]</a>
			<%} else{ %>
				[다음][마지막]
			<%} %>
			</div>
		
	</div> <!-- 결과패널 End -->

</div> <!-- content영역 End -->

<!-- 우편번호 검색 -->
<SCRIPT src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></SCRIPT>

<script>
//단일행 삭제
$(".deleteOneBtn").click(function(){
	
	 var result = confirm("복구가 안됩니다. 정말 모두 삭제하겠습니까?");
	 if(!result){
	     return false;
	 }
	

	$("#fromMem").attr("value","deleteOne");
	$("#MemListForm").attr("action", "<%=request.getContextPath()%>/coffee/admin/member/member_action.jsp"); 
	$("#MemListForm").submit();
});

//다중행 삭제
$("#deleteAllBtn").click(function(){

	
	//선택된 행이 없으면 메시지 보이도록
	 if (!$('.selectedMems').is(':checked')) {
		 $("#Msg").text("하나 이상을 선택해야 삭제할 수 있습니다.");
		 $('#Msg').css("display", "block");
         return false;
     }
	
	 var result = confirm("복구가 안됩니다. 정말 모두 삭제하겠습니까?");
	 if(!result){
	     return false;
	 }
	
	
	$("#fromMem").attr("value","deleteAll");
	$("#MemListForm").attr("action", "<%=request.getContextPath()%>/coffee/admin/member/member_action.jsp"); 
	$("#MemListForm").submit();
});

//초기화
function hiddenAll() { 
	//메세지 숨기기
	$("#Msg").css("display", "none");
	//모든 번호 수정칸 지우기
	$(".changePhone").attr("type", "hidden");
	//모든 주소 수정칸 지우기
	$(".changeZip").attr("type", "hidden");
	$(".searchPost").attr("type", "hidden");
	$(".changeAddress1").attr("type", "hidden");
	$(".changeAddress2").attr("type", "hidden");
}

//번호변경
$(".updatePhone").dblclick(function(){

	//삭제버튼 막기
	$(".deleteOneBtn").attr("type", "button");
	
	//모든 번호 지우기
	hiddenAll();
	
	//선택한 번호 수정칸만 보이기
	$(this).children(".changePhone").attr("type", "text");
	

})

//번호 변경 : 처리
$(".changePhone").change(function(){
	
	//입력값 유효성검사 
	var phoneReg=/^\d{3}-\d{3,4}-\d{4}$/;
	if(!phoneReg.test($(this).val())){
		//$('#Msg').text("올바른 핸드폰 번호를 입력해주세요.")
		//$('#Msg').css("display", "block");
		alert("올바른 핸드폰 번호를 입력해주세요.");
		return false;
	}
		
	var selectedMem=$(this).attr("name");
	var changedPhone=$(this).val();
	location.href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=member&work=action&fromMem=updatePhone&selectedMem="+selectedMem+"&changedPhone="+changedPhone;
});


//주소변경 : 더블클릭시
$(".updateAddress").dblclick(function(){

	//삭제버튼 막기
	$(".deleteOneBtn").attr("type", "button");
	
	//모든 수정칸 지우기
	hiddenAll();
	
	//선택한 주소 수정칸만 보이기
	$(this).children(".changeZip").attr("type", "text");
	$(this).children(".searchPost").attr("type", "button");
	$(this).children(".changeAddress1").attr("type", "text");
	$(this).children(".changeAddress2").attr("type", "text");
	
})

//다른 화면 클릭하면 수정칸 지우기
$('html').click(function(e){
	if(!$(e.target).parent().parent().hasClass("click")) { 
		hiddenAll();
	}
});


//우편번호 검색
function execDaumPostcode() {
	new daum.Postcode({
		oncomplete : function(data) {
			// 도로명 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
			var extraRoadAddr = ''; // 도로명 조합형 주소 변수

			// 법정동명이 있을 경우 추가한다. (법정리는 제외)
			// 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
			if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
				extraRoadAddr += data.bname;
			}
			// 건물명이 있고, 공동주택일 경우 추가한다.
			if (data.buildingName !== '' && data.apartment === 'Y') {
				extraRoadAddr += (extraRoadAddr !== '' ? ', '
						+ data.buildingName : data.buildingName);
			}
			// 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
			if (extraRoadAddr !== '') {
				extraRoadAddr = ' (' + extraRoadAddr + ')';
			}
			// 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
			if (fullRoadAddr !== '') {
				fullRoadAddr += extraRoadAddr;
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			$(".changeZip").attr("value",data.zonecode ); //5자리 새우편번호 사용
			$(".changeAddress1").attr("value",fullRoadAddr ); 
			$(".changeAddress2").focus();
		}
	}).open();
}

//주소변경 : 처리
$(".changeAddress2").change(function(){
	var selectedMem=$(this).attr("name");
	var changeZip=$(".changeZip").val(); //5자리 새우편번호 사용
	var changeAddress1=$(".changeAddress1").val(); 
	var changeAddress2=$(".changeAddress2").val();
	location.href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=member&work=action&fromMem=updateAddress&selectedMem="+selectedMem+"&changeZip="+changeZip+"&changeAddress1="+changeAddress1+"&changeAddress2="+changeAddress2;
})

//등급변경
$(".updateStatus").change(function(){
	var selectedMem=$(this).attr("name");
	var changedStatus=$(this).val();
	location.href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=member&work=action&fromMem=updateStatus&selectedMem="+selectedMem+"&changedStatus="+changedStatus;
})





</script>

