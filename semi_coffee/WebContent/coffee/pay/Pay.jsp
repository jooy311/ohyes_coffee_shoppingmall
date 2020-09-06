<%@page import="ohyes.coffee.dto.MemberDTO"%>
<%@page import="ohyes.coffee.dao.OrderPayDAO"%>
<%@page import="ohyes.coffee.dto.CartDTO"%>
<%@page import="ohyes.coffee.dao.CartDAO"%>
<%@page import="ohyes.coffee.dao.ProductDAO"%>
<%@page import="ohyes.coffee.dto.ProductDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    
    
 <%--상품단일 페이지나, 장바구니 페이지에서 결제를 누르면 나오는 페이지 --%>
 <%--사용자가 고른 상품이 주문결제내역 테이블에 떠야 하는데 고른 상품의 상품번호를 넘겨주면 된다. --%>
 <%
 
 	MemberDTO loginMember=(MemberDTO)session.getAttribute("loginMember");
 
 	ProductDTO product = null;
	String pNo = "";
	String quantityNum = "";
	int cost = 0;
	//세션에 저장된 권한 관련 정보를 반환받아 저장
	if(session.getAttribute("pNo")==null){
		session.setAttribute("pNo", request.getParameter("pNo"));
		session.setAttribute("amount", request.getParameter("quantityNum"));
		//System.out.println(request.getParameter("quantityNum"));
	}
	
	if(loginMember==null) {//비로그인 사용자인 경우
		//request.getRequestURI() : 요청페이지의 URI 주소를 반환하는 메소드
		String requestURI=request.getRequestURI();
		//System.out.println("requestURI = "+requestURI);
		quantityNum = request.getParameter("amount");
 		pNo = request.getParameter("pNo");
		//Object no=request.getParameter("no");
		//Object pNo=request.getParameter("pNo");
		//Object amount=request.getParameter("amount");
		//request.getQueryString() : 요청페이지의 QueryString를 반환하는 메소드
		String queryString=request.getQueryString();
		//System.out.println("queryString = "+queryString);
		
		if(queryString==null || queryString.equals("")) {
			queryString="";
		} else {
			queryString="?"+queryString;
		}
		
		//세션에 요청페이지에 URL 주소 저장
		session.setAttribute("url", requestURI+queryString);
		
		out.println("<script type='text/javascript'>");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=member&work=login';");
		out.println("</script>");
		return;
		
	} else {
		//get 방식일때 에러페이지출력
				if (request.getMethod().equals("get")){
					out.println("<script type='text/javascript'>");
					out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=error&work=error400';");
					out.println("</script>");
					return;
				}
				loginMember=(MemberDTO)session.getAttribute("loginMember");
				String memId=loginMember.getMemId();
 
				pNo = (String)session.getAttribute("pNo");
				//System.out.println("상품번호" + pNo);
				//String pName = (String)session.getAttribute("pname");
				quantityNum = (String)session.getAttribute("amount");
				//System.out.println("수량" + quantityNum);
				//int cost = (int)session.getAttribute("cost");
				product = OrderPayDAO.getOrderPayDAO().selectProductSingle(Integer.parseInt(pNo));
			 	cost = Integer.parseInt(quantityNum) * product.getpCost();
			 	
			 	session.removeAttribute("pNo");
			 	session.removeAttribute("amount");
	}
	
 
	//get 방식일때 에러페이지출력
	//if (request.getMethod().equals("get")){
	//	out.println("<script type='text/javascript'>");
	//	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=error&work=error400';");
	//	out.println("</script>");
	//	return;
	//}
 
	//if(loginMember.getMemId() == null){
	//	out.println("<script type='text/javascript'>");
	//	out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=member&work=login';");
	//	out.println("</script>");
	//	return;
	//}
	
 	//-------상품상세페이지에서 단일상품만 넘어오는 경우 
 	//int quantityNum = Integer.parseInt(request.getParameter("quantityNum"));
 //	int pNo = Integer.parseInt(request.getParameter("pNo"));
 //	System.out.println("quantityNum : " + quantityNum +" / " +"pNo : " + pNo);	
 	
 
 
 %>
<link rel="stylesheet" type="text/css" href="./Mypage/css/default_shop.css">
<link rel="stylesheet" type="text/css" href="./php/optimizer(30).php">
<link rel="stylesheet" type="text/css" href="./php/optimizer(31).php">

<!--allStore_wrap-->
<div id="allStore_wrap">                
    
    <!--allStore_contents-->
    <div id="allStore_contents">
        <div class="allStore_layout">
            
            <div>
    <!--타이틀, 현재위치-->
    <div class="allStore-board-menupackage">
        
        <div class="title">
            <h2>주문서작성</h2>
        </div>
    </div>
 <!--타이틀, 현재위치-->


<div class="xans-element- xans-order xans-order-form xans-record-">
<p class="orderStep"><img src="../coffee/pay/image/img_order_step2.gif" alt="02 주문서작성"></p>

<section id="smb_my_od">
	<!-- 주문 내역 목록 시작 { -->

<div class="tbl_head03 tbl_wrap">

	<table>
		<thead>
			<tr>

				<th scope="col">상품이름</th>
				<th scope="col">상품 이미지</th>
				<th scope="col">상품구매 갯수</th>
				<th scope="col">주문금액</th>
				
			</tr>
		</thead>
		<tbody>
		
		
		<tr>
			<th><%= product.getpName()%></th>
			
			<th><img src = "<%=request.getContextPath()%>/coffee/admin/product_images/<%= product.getpImage()%>" width = "100px"/></th>
			
			<th><%=quantityNum%></th>

			<th><%=cost%></th>
			
			</th>
		</tr>
		</tbody>
		<tbody>
		</tbody>
	</table>
</div>
</section>

<!-- 선택상품 제어 버튼 -->
<%--
<div class="ec-base-button">
   <span class="gLeft ">
   <strong class="text">선택상품을</strong>
   <a href=" # " id="btn_product_delete">
   <img src="../coffee/pay/image/btn_delete2.gif" alt="삭제하기"></a>
   </span>
</div>
 --%>
 
<form id = "PayForm" method = "post" action = "<%=request.getContextPath()%>/coffee/index.jsp?workgroup=MyPage&work=mypage">
	<input type = "hidden" id = "pno" name = "pno" value = "<%=pNo%>">
	<input type = "hidden" id = "pname" name = "pname" value = "<%=product.getpName()%>">	
	<input type = "hidden" id = "quantityNum" name = "quantityNum" value = "<%=quantityNum%>">
	<input type = "hidden" id= "cost" name = "cost" value = "<%=cost%>">
<!-- 배송 정보 -->
<div class="orderArea">
   <div class="title">
   <h3>배송 정보</h3>
   <p class="required"><img src="../coffee/pay/image/ico_required.gif" alt="필수"> 필수입력사항</p>
   </div>
   <div class="ec-base-table typeWrite">
   <table border="1" summary="">
<caption>배송 정보 입력</caption>
   <colgroup>
<col style="width:139px;">
<col style="width:auto;">
</colgroup>


<!-- 배송지 정보 -->
<tbody class="">
<tr class="">
<th scope="row">배송지 선택</th>
   <td>
   <span id = "check"> 
      <input name="sameaddr" class = "inputTag" fw-filter="" fw-label="1" fw-msg="" value="M" type="radio" checked="checked" ><label for="sameaddr0">회원 정보와 동일</label>
      <input name="sameaddr" class = "inputTag" fw-filter="" fw-label="1" fw-msg="" value="F" type="radio" ><label for="sameaddr0">새로운 배송정보</label>
 	</span>
   </td>
</tr>

<!-- 받는분 이름 -->
<tr>
   <th scope="row">받으시는 분 <img src="../coffee/pay/image/ico_required.gif" alt="필수"></th>
   <td>
   <input id="rname" name="rname" class = "inputTag" fw-filter="isFill" fw-label="수취자 성명" fw-msg="" class="inputTypeText" placeholder="" size="15" 
   value="<%=loginMember.getMemName()%>" type="text">
   </td>
</tr>

<!-- 주소 -->
<tr>
   <th scope="row">주소 <img src="../coffee/pay/image/ico_required.gif" alt="필수"></th>
   
   <td>
      <input id="zipcode1" name="zipcode1" class = "inputTag" fw-filter="isFill" fw-label="수취자 우편번호1" fw-msg="" class="inputTypeText" 
      placeholder="" size="10" maxlength="6" readonly="1" value="<%=loginMember.getMemZip()%>" type="text">
      
      <a href=" # " onclick="" id="btn_search_zipcode">
      <img src="../coffee/pay/image/btn_zipcode.gif" alt="우편번호" onclick="execDaumPostcode()"></a>
      <br>
      
      <input id="raddr1" name="raddr1" class = "inputTag" fw-filter="isFill" fw-label="수취자 주소1" fw-msg="" class="inputTypeText" placeholder="" 
      size="40" readonly="1"  type="text"  value= "<%=loginMember.getMemAddress1()%>"> 
      <span class="grid">기본주소</span>
      
      <br>
      <input id="raddr2" name="raddr2" fw-filter="" fw-label="수취자 주소2" fw-msg="" class="inputTypeText" placeholder="" size="40" 
      type="text"  value= "<%=loginMember.getMemAddress2()%>"> 
      <span class="grid">나머지주소</span>
   </td>
         
<!-- 우편번호 zipcode   -->
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
                document.getElementById('zipcode1').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('raddr1').value = fullRoadAddr;
                document.getElementById('raddr2').focus();
            }
        }).open();
    }
   </script>
</tr>


<tr class="">
   <th scope="row">휴대전화 <span class=""><img src="../coffee/pay/image/ico_required.gif" alt="필수"></span></th>
   <td>010 -<input id="rphone2_2" name="rphone2" maxlength="4" fw-filter="isNumber&amp;isFill" fw-label="수취자 핸드폰번호" fw-alone="N" 
   fw-msg="" size="4" value="<%=loginMember.getMemPhone().substring(4,8)%>" type="text" numberOnly>
   
   -<input id="rphone2_3" name="rphone3" maxlength="4" fw-filter="isNumber&amp;isFill" fw-label="수취자 핸드폰번호" fw-alone="N" 
   fw-msg="" size="4" value="<%=loginMember.getMemPhone().substring(9,13)%>" type="text" numberOnly>
   </td>
</tr>

<tr class="">
 <th scope="row">배송메세지 <span class=""><img src="../coffee/pay/image/ico_required.gif" alt="필수"></span></th>
 <td>
      <input id = "postMessage" name = "postMessage"  fw-filter="" fw-label="배송메세지" fw-msg="" class="inputTypeText" placeholder="" size="70"
   	   type="text" >
 </td> 
</tr>

</tbody>

</table>
</div>
  </div>
</form>
  
  <div id = "message" style = "color : red; text-align: center; font: bold;"></div>



<!-- 결제수단 -->

<div class="title">
   <h3>결제수단</h3>
</div>

<div class="payArea">
<div class="payment">

<!-- 카드결제 -->
<div class="method"><span class="ec-base-label"><input id="addr_paymethod0" name="addr_paymethod" fw-filter="isFill" fw-label="결제방식"
   fw-msg="" value="card" type="radio" checked="checked"><label for="addr_paymethod0">카드 결제</label></span>
   

   <div id="pg_paymethod_info" class="payHelp" style="display: block;">
      <p id="pg_paymethod_info_shipfee" class="ec-base-help" style="display: none;">최소 결제 가능 금액은 결제금액에서 배송비를 제외한 금액입니다.</p>
      <p id="pg_paymethod_info_pg" class="ec-base-help">소액 결제의 경우 PG사 정책에 따라 결제 금액 제한이 있을 수 있습니다.</p>
   </div>
</div>

<div class="agree">
<table border="1" summary="">

<!-- 청약철회방침 -->
<tbody class=""><tr>
<th scope="row">청약철회방침</th>
 <td>
 <div class="textArea">
 	<textarea id="subscription_terms" name="subscription_terms" fw-filter="" fw-label="청약철회방침" fw-msg="" maxlength="250" cols="70" readonly="1">
		①“오예스 커피”와 재화등의 구매에 관한 계약을 체결한 이용자는 수신확인의 통지를 받은 날부터 7일 이내에는 청약의 철회를 할 수 있습니다.
		② 이용자는 재화등을 배송받은 경우 다음 각호의 1에 해당하는 경우에는 반품 및 교환을 할 수 없습니다.
		1. 이용자에게 책임 있는 사유로 재화 등이 멸실 또는 훼손된 경우(다만, 재화 등의 내용을 확인하기 위하여 포장 등을 훼손한 경우에는 청약철회를 
		할 수 있습니다)
		2. 이용자의 사용 또는 일부 소비에 의하여 재화 등의 가치가 현저히 감소한 경우
		3. 시간의 경과에 의하여 재판매가 곤란할 정도로 재화등의 가치가 현저히 감소한 경우
		4. 같은 성능을 지닌 재화등으로 복제가 가능한 경우 그 원본인 재화 등의 포장을 훼손한 경우
		
		③ 제2항제2호 내지 제4호의 경우에 “몰”이 사전에 청약철회 등이 제한되는 사실을 소비자가 쉽게 알 수 있는 곳에 명기하거나 시용상품을 제공하는 
		등의 조치를 하지 않았다면 이용자의 청약철회등이 제한되지 않습니다.
		
		④ 이용자는 제1항 및 제2항의 규정에 불구하고 재화등의 내용이 표시·광고 내용과 다르거나 계약내용과 다르게 이행된 때에는 당해 재화등을 
		공급받은 날부터 3월이내, 그 사실을 안 날 또는 알 수 있었던 날부터 30일 이내에 청약철회 등을 할 수 있습니다.
		
		제16조(청약철회 등의 효과)
		
		① “오예스 커피”는 이용자로부터 재화 등을 반환받은 경우 3영업일 이내에 이미 지급받은 재화등의 대금을 환급합니다. 이 경우 “몰”이 이용자에게 
		재화등의 환급을 지연한 때에는 그 지연기간에 대하여 공정거래위원회가 정하여 고시하는 지연이자율을 곱하여 산정한 지연이자를 지급합니다.
		
		② “오예스 커피”는 위 대금을 환급함에 있어서 이용자가 신용카드 또는 전자화폐 등의 결제수단으로 재화등의 대금을 지급한 때에는 지체없이 당해 
		결제수단을 제공한 사업자로 하여금 재화등의 대금의 청구를 정지 또는 취소하도록 요청합니다.
		
		③ 청약철회등의 경우 공급받은 재화등의 반환에 필요한 비용은 이용자가 부담합니다. “몰”은 이용자에게 청약철회등을 이유로 위약금 또는 손해배상을 
		청구하지 않습니다. 다만 재화등의 내용이 표시·광고 내용과 다르거나 계약내용과 다르게 이행되어 청약철회등을 하는 경우 재화등의 반환에 필요한 
		비용은 “오예스 커피”이 부담합니다.
		
		④ 이용자가 재화등을 제공받을때 발송비를 부담한 경우에 “몰”은 청약 철회시 그 비용을 누가 부담하는지를 이용자가 알기 쉽도록 명확하게 표시합니다.
	</textarea>
</div>
<p><input id="subscription_agreement_chk0" name="subscription_agreement_chk" fw-filter="" fw-label="" fw-msg="" value="T" type="checkbox">
<label for="subscription_agreement_chk0">
<strong>동의함</strong></label></p>
</td>
</tr>
</tbody>

</table>
</form>

</div>
</div>

		<!-- 최종결제금액 -->
		<div class="total">
		<h4>
		<strong id="current_pay_name">카드 결제</strong>
		<span>최종결제 금액</span>
		</h4>
		<p class="price"><span></span>
		<input id="total_price" name="total_price" fw-filter="isFill" fw-label="결제금액" fw-msg="" class="inputTypeText"
		   placeholder="" style="text-align:right;ime-mode:disabled;clear:none;border:0px;float:none;" size="10" readonly="1" value="<%=cost %>" type="text">
		   <span>원</span></p>
		<p class="paymentAgree" id="chk_purchase_agreement" style="display: none;">
	
		 		
				<!------------------------결제하기 버튼 -------------------->
				<div class="button">
					<!-- <button class = "btn btn-primary" type="submit" value="등록하기" style = "margin-left : 90%;" >결제하기</button>-->
					<input type="button" id="btn_payment" class="allStore-color-btn1" style="width:80%; line-height:45px;" value="결제하기">
				</div>
				
				</div>
		
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 배송지 라디오버튼 관련 스크립트 -->
<script type="text/javascript">
$("input:text[numberOnly]").on("keyup", function() {
    $(this).val($(this).val().replace(/[^0-9]/g,""));
});

	$("#check").change(function() {
		 if($("input[type=radio][name = sameaddr]:checked").val() == "F"){//새로운배송
       	  $("#rname").val("");
	          $("#zipcode1").val("");
	          $("#raddr1").val("");
	          $("#raddr2").val("");
	          $("#rphone2_2").val("");
	          $("#rphone2_3").val("");
	          
		}else if($("input[type=radio][name = sameaddr]:checked").val() == "M"){
			  $("#rname").val("<%=loginMember.getMemName()%>");
	          $("#zipcode1").val("<%=loginMember.getMemZip()%>");
	          $("#raddr1").val("<%=loginMember.getMemAddress1()%>");
	          $("#raddr2").val("<%=loginMember.getMemAddress2()%>");
	          $("#rphone2_2").val("<%=loginMember.getMemPhone().substring(4,8)%>");
	          $("#rphone2_3").val("<%=loginMember.getMemPhone().substring(9,13)%>");
		}
	});
	
	$("#btn_payment").click(function() {
		
		if($("#rname").val() == ""){
			//alert("이름을 입력해줘");
			$("#message").text("이름을 입력해주세요.");
			$("#rname").focus();
			return ;
		}
		
		//3.휴대전화
		 if($("#rphone2_2").val() == "" || $("#rphone2_3").val() == ""){
			$("#message").text("휴대전화 번호를 입력해 주세요.");
			//alert($("#rphone2_2").val());
			$("#rphone2_2").focus();
			return ;
		}
		if($("#zipcode1").val() == ""){
			$("#message").text("주소를 선택해 주세요.");
			//alert($("#rphone2_2").val());
			$("#zipcode1").focus();
			return ;
		}
		
		//4.상세주소
		 if($("#raddr2").val() == ""){
			$("#message").text("상세주소를 입력해 주세요.");
			$("#raddr2").focus();
			return ;
		}
		//5.배송메세지
		 if($("#postMessage").val() == ""){
			//alert("배송메세지를 입력해줘");
			$("#message").text("배송메세지를 입력해 주세요.");
			$("#postMessage").focus();
			return ;
		}
		//6.약관동의
		 if($("#subscription_agreement_chk0").is(":checked") == false){
			$("#message").text("약관에 동의해주세요.");
			$("#chk_purchase_agreement0").focus();
			return ;
		}
		
		$("#PayForm").attr("action", "<%=request.getContextPath()%>/coffee/index.jsp?workgroup=pay&work=pay_add_action");
		PayForm.submit();
		
	});
	

	
	
</script>



