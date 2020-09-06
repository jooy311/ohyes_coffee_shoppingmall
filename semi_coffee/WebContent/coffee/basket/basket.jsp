<%@page import="java.util.List"%>
<%@page import="ohyes.coffee.dao.CartDAO"%>
<%@page import="ohyes.coffee.dto.CartDTO"%>
<%@page import="ohyes.coffee.dao.ProductDAO"%>
<%@page import="ohyes.coffee.dto.ProductDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@include file="/coffee/Mypage/login_check.jspf" %>
<%
	//get 방식일때 에러페이지출력
	if (request.getMethod().equals("get")){
		out.println("<script type='text/javascript'>");
		out.println("location.href='"+request.getContextPath()+"/site/index.jsp?workgroup=error&work=error400';");
		out.println("</script>");
	}
	//멤버정보 받아와서 유효성검사
	if(loginMember.getMemId()==null){
		out.println("<script type='text/javascript'>");
		out.println("location.href='"+request.getContextPath()+"/site/index.jsp?workgroup=error&work=error400';");
		out.println("</script>");
	}
	
	
	List<CartDTO> cartList=null;
	if (loginMember.getMemId()!=null) {
		cartList=CartDAO.getDAO().selectAllCart(loginMember.getMemId());
	}
	
	
	
%>
<div id="allStore_wrap">
        <!--allStore_contents-->
    <div id="allStore_contents">
        <div class="allStore_layout">

            <div>
                <!--타이틀, 현재위치-->
                <div class="allStore-board-menupackage">

                    <div class="title">
                        <h2>장바구니</h2>
                    </div>
                    <div class="nav-path">
                        <ol>
                            <li><a href="../index.html">홈</a></li>
                            <li title="현재 위치"><strong>장바구니</strong></li>
                        </ol>
                    </div>
                </div>
                <!--타이틀, 현재위치-->


                <!-- 장바구니 모듈 Package -->
                <div class="xans-element- xans-order xans-order-basketpackage ">
                    <div class="xans-element- xans-order xans-order-tabinfo ec-base-tab typeLight ">
                        <ul class="menu">
                            <li class="selected "><a href="basket.html">국내배송상품 (0)</a></li>
                        </ul>
                        <p class="right ">장바구니에 담긴 상품은 30일 동안 보관됩니다.</p>
                    </div>
                    <!-- 장바구니 비어있을 때 -->
                    <% if(cartList==null) { %>
                    <div class="xans-element- xans-order xans-order-empty ">
                        <p>장바구니가 비어 있습니다.</p>
                    </div>
                    <% } else { %>
                    <!-- 일반상품 -->
                    <div class="orderListArea ec-base-table typeList">
						
                      <form id = "cartForm" name="cartForm" method="post" action = "">
                        <table border="1" summary="" class="xans-order xans-order-normnormal xans-record-">
                            <caption>기본배송</caption>
                            <thead>
                                <tr>
                                    <th style="width:27px"><input type="checkbox" id="allChacked" checked="checked"></th>
                                    <th style="width:92px">이미지</th>
                                    <th style="width:auto">상품정보</th>
                                    <th style="width:98px">판매가</th>
                                    <th style="width:98px">수량</th>
                                    <th style="width:85px">합계</th>
                                    <th style="width:98px">삭제</th>
                                </tr>
                            </thead>
                            <tfoot class="right">
                                <tr>
                                     <td colspan="10">
                                        <span class="gLeft">[기본배송]</span>
										상품구매금액 <strong id="totCost" class="displaynone">0</strong>
                                        <strong class="txtEm gIndent10">
                                        <span id="payCost" class="txt18">0</span> 원
                                        </strong>
                                    </td>
                                </tr>
                            </tfoot>
    
                            <tbody class="xans-order xans-order-list center">
                         
                            
    						<% for(CartDTO cart:cartList) { %>
    							<% ProductDTO product=ProductDAO.getProductDAO().selectNoProduct(cart.getCartPNo()); %>
                                <tr class="xans-record-">
                                	<!-- 체크박스 -->
                                    <td>
                                    <!-- 카트 폼 -->
                                    	<input type="checkbox" id="basket_chk_<%=product.getpNo()%>" name="checkedCart" value="<%=product.getpNo()%>" class="basket_chk_class" checked="checked">
                                    </td>

                                	<!-- 상품이미지 -->
                                    <td class="thumb">
                                    <a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=product&work=product_detail&no=<%=product.getpNo()%>">
                                    <img src="<%=request.getContextPath()%>/coffee/admin/product_images/<%=product.getpImage()%>" alt="<%=product.getpName()%>" style="with:80px; height:90px">
                                    </a>
                                    </td>
                                	<!-- 상품정보 -->
                                    <td class="left">
                                		<input type="hidden" id="cartNo_<%=product.getpNo()%>" value="<%=cart.getCartNo()%>">
                                        <a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=product&work=product_detail&no=<%=product.getpNo()%>">
                                            <strong><%=product.getpName()%></strong> </a>
                                    </td>
                                	<!-- 상품판매가 -->
                                    <td class="right">
                                        <div class="">
                                            <strong id="productCost_<%=product.getpNo()%>"><%=product.getpCost()%></strong><strong>원</strong>
                                        </div>
    
                                    </td>
    
                                	<!-- 수량 -->
                                    <td style="user-select: auto;">
                                        <span class="" style="user-select: auto;">
                                            <span class="ec-base-qty" style="user-select: auto;">
                                                <input id="quantity_<%=product.getpNo()%>" name="quantity_<%=product.getpNo()%>" value="<%=cart.getCartAmount()%>" type="text">
                                                <a href="#none"><img src="images/img/skin/btn_count_up.gif" alt="수량증가" class="QuantityUp up" name="<%=product.getpNo()%>"/></a>
                                                <a href="#none"><img src="images/img/skin/btn_count_down.gif" alt="수량감소" class="QuantityDown down" name="<%=product.getpNo()%>"/></a>
                                            </span>
                                            <a href="#" class="gBlank5" >
                                                <img id="modifyBtn_<%=product.getpNo()%>" src="<%=request.getContextPath()%>/coffee/images/btn_quantity_modify.gif" alt="변경" onclick="modifyBtn()" name="<%=product.getpNo()%>">
                                            </a>
                                        </span>
                                    </td>

                                	<!-- 합계 -->
                                    <td class="right">
                                    	
                                        <strong id="totCost_<%=product.getpNo()%>"><%=cart.getCartAmount()*product.getpCost()%></strong><strong>원</strong>
                                    </td>
                                	<!-- 삭제 -->
                                    <td class="button">
                                        <a id="removeCart_<%=product.getpNo()%>" href="#">
                                        <img class="removeBtn" src="<%=request.getContextPath()%>/coffee/images/btn_delete.gif" name="<%=product.getpNo()%>" ></a>
                                    </td>
                                </tr>
                         
							<% } %>
						
                            </tbody>
                        </table>
                       </form>
                       
						<form id="modifyForm" class="modifyForm" name="modifyForm" method="post" >
                              <input type="hidden" class="totCost">
                              <input type="hidden" class="beforeCost">
                              <input type="hidden" class="no" name="no" value="">
                              <input type="hidden" class="amount" name="amount" value="">
                              <input type="hidden" class="remove_status" name="status" value="">
                              <input type="hidden" class="id" name="memId" value="">	                                        
                         </form>
                    </div>
                    <% } %>
                    <!-- 선택상품 제어 버튼 -->
                    <div class="xans-order xans-order-selectorder ec-base-button ">
                        <span class="gRight">
                            <a href="#">
                                <img src="<%=request.getContextPath()%>/coffee/images/btn_clear.gif" id="allRemove"alt="장바구니비우기" ></a>
                        </span>
                    </div>

                    <!-- 주문 버튼 -->
                    <div class="xans-element- xans-order xans-order-totalorder ec-base-button justify">
                    
                        <a href="#none" id = "selectOrder"  style="line-height: 40px;" class="allStore-color-btn2 ">
                            상품주문
                        </a>
                        <!-- 네이버 체크아웃 구매 버튼  -->
                        <div id="NaverChk_Button"></div>
                    </div>
                </div>
                <!-- //장바구니 모듈 Package -->
                <!-- 이용안내 -->
                <div class="xans-element- xans-order xans-order-basketguide ec-base-help ">
                    <h3>이용안내</h3>
                    <div class="inner">
                        <h4>장바구니 이용안내</h4>
                        <ol>
                            <li class="item1">해외배송 상품과 국내배송 상품은 함께 결제하실 수 없으니 장바구니 별로 따로 결제해 주시기 바랍니다.</li>
                            <li class="item2">해외배송 가능 상품의 경우 국내배송 장바구니에 담았다가 해외배송 장바구니로 이동하여 결제하실 수 있습니다.</li>
                            <li class="item3">선택하신 상품의 수량을 변경하시려면 수량변경 후 [변경] 버튼을 누르시면 됩니다.</li>
                            <li class="item4">[쇼핑계속하기] 버튼을 누르시면 쇼핑을 계속 하실 수 있습니다.</li>
                            <li class="item5">장바구니와 관심상품을 이용하여 원하시는 상품만 주문하거나 관심상품으로 등록하실 수 있습니다.</li>
                            <li class="item6">파일첨부 옵션은 동일상품을 장바구니에 추가할 경우 마지막에 업로드 한 파일로 교체됩니다.</li>
                        </ol>
                        <h4>무이자할부 이용안내</h4>
                        <ol>
                            <li class="item1">상품별 무이자할부 혜택을 받으시려면 무이자할부 상품만 선택하여 [주문하기] 버튼을 눌러 주문/결제 하시면 됩니다.</li>
                            <li class="item2">[전체 상품 주문] 버튼을 누르시면 장바구니의 구분없이 선택된 모든 상품에 대한 주문/결제가 이루어집니다.</li>
                            <li class="item3">단, 전체 상품을 주문/결제하실 경우, 상품별 무이자할부 혜택을 받으실 수 없습니다.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var name;
var count;
var	cost
var totCost;
var payCost;
var nowCost=0;
var payCost;
var btnStatus=0;

//위 버튼 누르면 수량증가
$(".QuantityUp").click(function(){
	name=$(this).attr("name");
	count=document.getElementById("quantity_"+name);
	cost=$("#productCost_"+name).text();
	count.value=Number(count.value)+1;
	totCost=cost*Number(count.value);
	$(".totCost").text(totCost);
	btnStatus=1;
});

//아래 버튼 누르면 수량감소
$(".QuantityDown").click(function(){
	name=$(this).attr("name");
	count=document.getElementById("quantity_"+name);
	cost=$("#productCost_"+name).text();
	count.value=Number(count.value)-1;
	if(count.value<=0){
		count.value=1;
	}
	totCost=cost*Number(count.value);
	$(".totCost").text(totCost);
	btnStatus=1;
});
//============
//변경버튼 누르면 수량변경
function modifyBtn(){
	if(btnStatus==1){
		name=$(this).attr("name");
		var tot=$(".totCost").text()*1;
		var after=$("#totCost_"+name).text()*1;
		$(".beforeCost").text(after);
		$("#totCost_"+name).text(tot);
		btnStatus=0;
		if($("#totCost_"+name).text()*1>$(".beforeCost").text()*1){
			var costPlus=$("#totCost").text()*1+$("#totCost_"+name).text()*1-$(".beforeCost").text()*1;
			var payPlus=$("#payCost").text()*1+$("#totCost_"+name).text()*1-$(".beforeCost").text()*1;
			$("#totCost").text(costPlus);
			$("#payCost").text(payPlus);
		} else if($("#totCost_"+name).text()*1<$(".beforeCost").text()*1){
			var costMinus=$("#totCost").text()*1+$("#totCost_"+name).text()*1-$(".beforeCost").text()*1;
			var payMinus=$("#payCost").text()*1+$("#totCost_"+name).text()*1-$(".beforeCost").text()*1;
			$("#totCost").text(costMinus);
			$("#payCost").text(payMinus);
		} else{
			
		}
		$(".amount").attr("value", document.getElementById("quantity_"+name).value);
		$(".no").attr("value", document.getElementById("cartNo_"+name).value);
		$("#modifyForm").attr("action", "<%=request.getContextPath()%>/coffee/index.jsp?workgroup=basket&work=basket_modify_action");
		$("#modifyForm").submit();
	}
};
//삭제버튼 눌렀을때 삭제
$(".removeBtn").click(function(){
	if(confirm("정말로 삭제 하시겠습니까?")) {
		name=$(this).attr("name");
		$(".no").attr("value", document.getElementById("cartNo_"+name).value);
		$("#modifyForm").attr("action", "<%=request.getContextPath()%>/coffee/index.jsp?workgroup=basket&work=basket_remove_action");
		$("#modifyForm").submit();
	}
});
//장바구니 비우기 버튼 눌렀을때 삭제
$("#allRemove").click(function(){
	if(confirm("정말로 삭제 하시겠습니까?")) {
		$(".remove_status").attr("value", "1");
		$(".modifyForm").attr("action", "<%=request.getContextPath()%>/coffee/index.jsp?workgroup=basket&work=basket_remove_action");
		$(".modifyForm").submit();
	}
});

//처음페이지 출력했을 때 전체가격 계산
$(document).ready(function(){
	if($("#allChacked").is(":checked")) {
		var checkClassLeng=document.getElementsByClassName("basket_chk_class").length;
		if(checkClassLeng!=0){
			for (i=0; i < checkClassLeng; i++) {
				name=$(".basket_chk_class").eq(i).attr("value");				
		        if ($("#basket_chk_"+name).attr("checked")=="checked") {
					count=document.getElementById("quantity_"+name);
					cost=$("#productCost_"+name).text();
					ptotCost=cost*Number(count.value);
					$("#totCost_"+name).text(ptotCost);
					nowCost=$("#totCost").text()*1;
					totCost=nowCost+(cost*Number(count.value));
					$("#totCost").text(totCost);
		        }
			}
			payCost=totCost;
			$("#payCost").text(payCost);
		} else {
		$("#payCost").text(0);				
		}
	}
});

//전체선택 체크박스누르면 아래 체크박스 선택/취소
$("#allChacked").change(function(){
	if($(this).is(":checked")) {
		$(".basket_chk_class").prop("checked", true);
		$("#totCost").text(0);
		$("#payCost").text(0);
		var checkClass=new Array();
		checkClass=document.getElementsByClassName("basket_chk_class");
		var checkClassLeng=checkClass.length;
		for (i=0; i < checkClassLeng; i++) {
			name=$(".basket_chk_class").eq(i).attr("value");
	        if ($("#basket_chk_"+name).attr("checked")=="checked") {
				name=$("#basket_chk_"+name).attr("value");
				count=document.getElementById("quantity_"+name);
				cost=$("#productCost_"+name).text();
				nowCost=$("#totCost").text()*1;
				totCost=nowCost+(cost*Number(count.value));
				$("#totCost").text(totCost);
	        }
		}
		payCost=totCost;
		$("#payCost").text(payCost);
	} else {
		$(".basket_chk_class").prop("checked", false);
		$("#totCost").text(0);
		$("#payCost").text(0);
	}
});

//체크박스 하나씩 누를때 가격 추가/감소
$(".basket_chk_class").change(function(){
	var checkClass=new Array();
		checkClass=document.getElementsByClassName("basket_chk_class");
	var checkClassLeng=checkClass.length;
	var checked=0;
	if($(this).is(":checked")) {
		name=$(this).attr("value");
		count=document.getElementById("quantity_"+name);
		cost=$("#productCost_"+name).text();
		nowCost=$("#totCost").text()*1;
		totCost=nowCost+(cost*Number(count.value));
		for (i=0; i < checkClassLeng; i++) {
	        if (checkClass[i].checked==true) {
	            checked += 1;
	        }
		}
	} else {
		name=$(this).attr("value");
		count=document.getElementById("quantity_"+name);
		cost=$("#productCost_"+name).text();
		nowCost=$("#totCost").text()*1;
		totCost=nowCost-(cost*Number(count.value));
		for (i=0; i < checkClassLeng; i++) {
	        if (checkClass[i].checked==true) {
	            checked -= 1;
	        }
		}
	}
	payCost=totCost;
	if(checked==0){
		payCost=0;
		$("#allChacked").prop("checked", false);
	}
	if(checked==checkClassLeng){
		$("#allChacked").prop("checked", true);
	}
	$("#totCost").text(totCost);
	$("#payCost").text(payCost);
});

//-------------------------------------------
	
	$("#selectOrder").click(function(){
		$("#cartForm").attr("action", "<%=request.getContextPath()%>/coffee/index.jsp?workgroup=pay&work=Pay_cart");
		cartForm.submit();
	});
</script>