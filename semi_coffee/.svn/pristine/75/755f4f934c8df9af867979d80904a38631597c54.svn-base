<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@include file="/coffee/Mypage/login_check.jspf" %>   
	<link rel="stylesheet" type="text/css" href="./member/join/optimizer.php">
	<link rel="stylesheet" type="text/css" href="./member/join/optimizer(1).php">

        <!--allStore_contents-->
    <div id="allStore_contents">
        <div class="allStore_layout">
            
            <div>

    <!--타이틀, 현재위치-->
    <div class="allStore-board-menupackage">
        
        <div class="title">
            <h2>회원 정보 수정</h2>
        </div>
        <div class="nav-path">
            <ol><li><a href="<%=request.getContextPath()%>/coffee/index.jsp">홈</a></li>
            <li title="현재 위치"><strong>회원 정보 수정</strong></li>
            </ol></div>
    </div>
<form id="editmember" name="editmemberForm" action="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=Mypage&work=editmember_action" method="post" onsubmit="return;">
<input type="hidden" name="idCheckResult" id="idCheckResult" value="0">
<div class="xans-element- xans-member xans-member-join">
<div class="ec-base-table typeWrite">
<table border="1" summary="">
<caption>회원가입</caption>
<colgroup>
	<col style="width:150px;">
	<col style="width:auto;">
</colgroup>
</table>
</div>
<div class="ec-base-table typeWrite" >
<table border="1" summary="">
<caption>회원 기본정보</caption>
<colgroup>
	<col style="width:150px;">
	<col style="width:auto;">
</colgroup>
<tbody style="border-bottom: 2px solid gainsboro ;">
<tr>
<th scope="row">아이디</th>
<td>
	<input id="memId" name="memId" value="<%=loginMember.getMemId()  %>" type="text" readonly="readonly">
	 (아이디는 변경하실 수 없습니다.)</td>
	
</tr>
<tr>
<th scope="row">비밀번호</th>
	<td>
		<input id="memPwd" name="memPwd" value="" type="password"> (영문자/숫자/특수문자가 반드시 하나이상 포함된 6~20자로 입력해 주세요.)
		<span class="error" id="pwdch"></span>
		</td>
		
</tr>
<tr>
<th scope="row">비밀번호 확인 </th>
	<td>
		<input id="pwdS" name="pwds"  autocomplete="off" maxlength="16" value="" type="password">
		<span class="error" id="pwsch"></span>
		</td>
</tr>
<tr>
<th scope="row" id="nameTitle">이름 </th>
                <td>
                <input type="text" name="memName" id="memName" value="<%=loginMember.getMemName()  %>" maxlength="20">
                <span class="error" id="namech"></span>
            </tr>
<tr class="">
<th scope="row">주소 </th>
<td>
<input id="memZip" name="memZip" readonly="readonly" maxlength="14" value="<%=loginMember.getMemZip()  %>" type="text">
		<a href="#" onclick="" id="postBtn">
	<img src="./member/join/btn_zipcode.gif" alt="우편번호" onclick="execDaumPostcode()"></a><br>
	<input id="addr1" name="memAddress1" readonly="readonly" value="<%=loginMember.getMemAddress1()  %>" type="text"> 기본주소<span class="error" id="addr1ch"></span><br>	
	<input id="addr2" name="memAddress2" type="text" value="<%=loginMember.getMemAddress2()  %>"> 나머지주소  <span class="error" id="addr2ch"></span></td>
</tr>
<tr class="" >
<th scope="row" >휴대전화 </th>
<td>
<label for="" ></label>
<% String[] mobile=loginMember.getMemPhone().split("-"); %>
	<select id="phone1" name="memPhone1" >
		<option value="010" <% if(mobile[0].equals("010")) { %> selected <% } %>>010</option>
		<option value="011" <% if(mobile[0].equals("011")) { %> selected <% } %>>011</option>
		<option value="016" <% if(mobile[0].equals("012")) { %> selected <% } %>>016</option>
		<option value="017" <% if(mobile[0].equals("013")) { %> selected <% } %>>017</option>
		<option value="018" <% if(mobile[0].equals("014")) { %> selected <% } %>>018</option>
		<option value="019" <% if(mobile[0].equals("015")) { %> selected <% } %>>019</option>
		</select>
-<input id="phone2" name="memPhone2" type="text" size="4" maxlength="4"  value="<%=mobile[1]%>">
<span class="error" id="phone2ch"></span>
-<input id="phone3" name="memPhone3" type="text" size="4" maxlength="4" value="<%=mobile[2]%>">
<span class="error" id="phone3ch"></span>
</td>
</tr>
<tr>
<th scope="row" style="padding-bottom: 1px solid gray;">이메일 </th>
<td>
<input id="memEmail" name="memEmail" type="text" value="<%=loginMember.getMemEmail()  %>"> 
<span class="error" id="emailch"></span>
</td>
</tbody>
</table>
</div>
</div>

<div class="ec-base-button">
	<button type="submit"><img src="./Mypage/editmember/btn_comment_modify.gif"></button>
	<button type="button" onclick="location.href='<%=request.getContextPath()%>/coffee/index.jsp?workgroup=Mypage&work=mypage' "><img src="./Mypage/editmember/btn_comment_cancel.gif"></button>
</div>
</form>
</div>
</div>
</div>

<!-- 우편번호 zipcode -->
<SCRIPT src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></SCRIPT>
<script>
    function execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
 
                // 도로명 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 도로명 조합형 주소 변수
 
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                   extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }
                // 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
                if(fullRoadAddr !== ''){
                    fullRoadAddr += extraRoadAddr;
                }
 
                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('memZip').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('addr1').value = fullRoadAddr;
                document.getElementById('addr2').focus();
            }
        }).open();
    }
</script>
<script type="text/javascript">
	$("#memPwd").focus();

	var checkID = /^(?=.*[a-zA-Z])(?=.*[0-9]).{4,16}$/g; //ID 유효성 검사 정규식
	var checkName=/^[가-힣]{2,10}$/;
	var checkPWD=/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[~!@#$%^&*_-]).{6,20}$/g;// PASSWORD 유효성 검사 정규식
	var checkEmail = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;//Email 유효성 검사 정규식
	var checkPhonept = /\d{4}$/;
	
	
	//비밀번호 유효성
	  	$("#memPwd").blur(function() {
	  		if ($("#memPwd").val()!="") {
	  			if (checkPWD.test($("#memPwd").val())!=true) {
	  				console.log('false');
  					$("#pwdch").text("영문자/숫자/특수문자가 반드시 하나이상 포함된 6~20자리로 입력해 주세요.");
					$("#pwdch").css('color', 'red');
					$("#memPwd").focus();
	  			}else{
	  				console.log('true');
	  		   		$("#pwdch").text("");
	  				$("#pwdS").focus();	
	  			}
	  		}
	
	  	});
	//비밀번호 확인 유효성
	  	$("#pwdS").blur(function() {
	  		if ($("#memPwd").val()!="") {
	  			if ($("#pwdS").val()=="") {
	  				console.log('false');
  					$("#pwsch").text("비밀번호 확인을 입력해 주세요.");
					$("#pwsch").css('color', 'red');
					$("#pwdS").focus();
	  			}else if ($("#memPwd").val()!=$("#pwdS").val()) {
	  				console.log('false');
	  	  			$("#pwsch").text("비밀번호가 일치하지 않습니다.다시 입력해 주세요.");
	  				$("#pwsch").css('color', 'red');
	  				$("#pwdS").focus();	
	  				
				}else{
					console.log('true');
	  		   		$("#pwsch").text("");
	  				$("#memName").focus();	
	  			}	
	  	}
		});
	
 	  	//이름 확인 유효성
	   	$("#memName").blur(function() {
	   		if (checkName.test($("#memName").val())) {
				console.log('true');
		   		$("#namech").text("");
				$("#memZip").focus();
	   		}else if ($("#memName").val()=="") {
	   			console.log('false');
	   			$("#namech").text("이름을 입력해 주세요.");
	   			$("#namech").css('color', 'red');   		
				$("#memName").focus();
			}else if (checkName.test($("#memName").val())!=true) {
				console.log('false');
				$("#namech").text("잘못된 문자가 입력되었습니다. 다시 입력해 주세요.");
				$("#namech").css('color', 'red');
				$("#memName").focus();
			}
	   	})
		
		   	  	//우편번호 확인 유효성
	   	$("#addr1").blur(function() {
	   		if ($("#addr1").val()!="") {
				console.log('true');
		   		$("#addr1").text("");
				$("#addr2").focus();
	   		}else if ($("#addr1").val()=="") {
	   			console.log('false');
	   			$("#addr1ch").text("기본주소를 입력해 주세요.");
	   			$("#addr1ch").css('color', 'red');
				$("#addr1").focus();
			}
	   	})
	   	
				//상세주소 확인 유효성   	
	   	  	$("#addr2").blur(function() {
	   		if ($("#addr2").val()!="") {
				console.log('true');
		   		$("#addr2ch").text("");
				$("#phone2").focus();
	   		}else if ($("#addr2").val()=="") {
	   			console.log('false');
	   			$("#addr2ch").text("나머지주소를 입력해 주세요.");
	   			$("#addr2ch").css('color', 'red');
				$("#addr2").focus();
			}
	   	})
	   	
	   				//전화번호 확인 유효성   	
	   	  	$("#phone2").blur(function() {
	   		if (checkPhonept.test($("#phone2").val())) {
				console.log('true');
		   		$("#phone2ch").text("");
				$("#phone3").focus();
	   		}else if ($("#phone2").val()=="") {
	   			console.log('false');
	   			$("#phone2ch").text("전화번호 두번째 자리를 입력해 주세요.");
	   			$("#phone2ch").css('color', 'red');
				$("#phone2").focus();
			}
	   		else if (checkPhonept.test($("#phone2").val())!=true) {
	   			console.log('false');
	   			$("#phone2ch").text("4자리 숫자로 입력해 주세요.");
	   			$("#phone2ch").css('color', 'red');
				$("#phone2").focus();
			}
	   	})
	   	
	   		$("#phone3").blur(function() {
	   		if (checkPhonept.test($("#phone3").val())) {
				console.log('true');
		   		$("#phone3ch").text("");
				$("#memEmail").focus();
	   		}else if ($("#phone2").val()=="") {
	   			console.log('false');
	   			$("#phone3ch").text("전화번호 세번째 자리를 입력해 주세요.");
	   			$("#phone3ch").css('color', 'red');
				$("#phone3").focus();
			}
	   		else if (checkPhonept.test($("#phone3").val())!=true) {
	   			console.log('false');
	   			$("#phone3ch").text("4자리 숫자로 입력해 주세요.");
	   			$("#phone3ch").css('color', 'red');
				$("#phone3").focus();
			}
	   	})
			
	   				//이메일  확인 유효성   	
	   	  	$("#memEmail").blur(function() {
	   		if (checkEmail.test($("#memEmail").val())) {
				console.log('true');
		   		$("#emailch").text("");
	   		}else if ($("#memEmail").val()=="") {
	   			console.log('false');
	   			$("#emailch").text("이메일을 입력해 주세요.");
	   			$("#emailch").css('color', 'red');
				$("#addr2").focus();
			}else if (checkEmail.test($("#memEmail").val())!=true) {
	   			console.log('false');
	   			$("#emailch").text("올바른 이메일 형식을 입력해 주세요.");
	   			$("#emailch").css('color', 'red');
				$("#memEmail").focus();
			}
	   	 });
		
		document.addEventListener('keydown', function(event) {
		    if (event.keyCode === 13) {
		        event.preventDefault();
		    }
		}, true);
		
		 $("#editmember").submit(function() {
			 alert("정보가 변경 되었습니다.")
		 });   
	
</script>
