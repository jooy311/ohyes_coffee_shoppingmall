<%@page import="java.util.HashSet"%>
<%@page import="java.util.Set"%>
<%@page import="java.util.ArrayList"%>
<%@page import="ohyes.coffee.dao.MypageDAO"%>
<%@page import="ohyes.coffee.dto.OrderListDTO"%>
<%@page import="java.util.List"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@include file="/coffee/Mypage/login_check.jspf" %>   
<%
	String memId = loginMember.getMemId();

	List<OrderListDTO> orderList = MypageDAO.getDAO().selectOrderAll(memId);
	
	
	//모든 회원의 주문내역을 일단 리스트로 받는다
	Set<String> orderSorting = new HashSet<String>();
	
	for(OrderListDTO order:orderList) { 
		
		orderSorting.add(order.getOrderNo());//일단 주문번호를 다 받아온다. 중복 안됨
	}
	
	
	//이제 이거를 주문내역이 같은것끼리 소팅
	

%>
<link rel="stylesheet" type="text/css" href="./Mypage/css/default_shop.css">

	<!-- 콘텐츠 시작 { -->
	    <div id="allStore_contents">
	    
        <div class="allStore_layout">
            
            <div>

    
    <!--타이틀, 현재위치-->
    <div class="allStore-board-menupackage">
        
        <div class="title">
            <h2>마이페이지</h2>
        </div>
        <div class="nav-path">
            <ol><li><a href="<%=request.getContextPath()%>/coffee/index.jsp">홈</a></li>
            <li title="현재 위치"><strong>마이페이지</strong></li>
            </ol></div>
    </div>
	<div id="container">
		<!-- <div id="wrapper_title">마이페이지</div> -->
		<div id="wrapper_title">회원정보</div>


		<!-- 마이페이지 시작 { -->
		<div id="smb_my">

			<!-- 회원정보 개요 시작 { -->
			<section id="smb_my_ov">
				<h2>회원정보 개요</h2>
				<strong class="my_ov_name"><%=loginMember.getMemName() %></strong>
				
				<div id="smb_my_act">
					<ul>
						<li>
							<a href="index.jsp?workgroup=Mypage&work=editmember" class="btn01">회원정보수정</a>
						</li>
						<li>
							<a href="index.jsp?workgroup=Mypage&work=remove_confirm" onclick="return member_leave();" class="btn01">회원탈퇴</a>
						</li>
					</ul>
				</div>

				<dl class="op_area">
					<dt>휴대폰번호</dt>
					<dd><%=loginMember.getMemPhone() %></dd>
					<dt>E-Mail</dt>
					<dd><%=loginMember.getMemEmail() %></dd>
					<dt>회원가입일시</dt>
					<dd><%=loginMember.getMemJoinDate() %></dd>
					<dt id="smb_my_ovaddt">주소</dt>
					<dd><%=loginMember.getMemZip() %><br><%=loginMember.getMemAddress1() %><br><%=loginMember.getMemAddress2() %></dd>
				</dl>
				<div class="my_ov_btn">
					<button type="button" class="btn_op_area">
						<i class="fa fa-caret-up" aria-hidden="true"></i><span class="sound_only">상세정보 보기</span>
					</button>
				</div>

			</section>
			<script>
    
        $(".btn_op_area").on("click", function() {
            $(".op_area").toggle();
            $(".fa-caret-up").toggleClass("fa-caret-down")
        });

    </script>
			<!-- } 회원정보 개요 끝 -->

			<!-- 최근 주문내역 시작 { -->
			<section id="smb_my_od">
				<h2>주문내역</h2>

				<!-- 주문 내역 목록 시작 { -->
				<div class="tbl_head03 tbl_wrap">
					<table>
						<thead>
							<tr>
								<th scope="col">주문서번호</th>
								<th scope="col">주문일시</th>
								<th scope="col">상품수</th>
								<th scope="col">주문금액</th>
								
								<th scope="col">받으시는 분</th>
								<th scope="col">상태</th>
							</tr>
						</thead>
						<tbody>
						
					
						
						<% for(OrderListDTO order:orderList) { %>
						
						<tr>
						<th><a href = "#none" id = "detailOrder_<%=order.getOrderNo()%>" name = "<%=order.getOrderNo()%>" class = "detailOrder" ><%= order.getOrderNo()%></a></th>
						
						<th><%= order.getOrderDate().substring(0, 10)%></th>
						
						<th><%=MypageDAO.getDAO().selectOrderAll2(order.getOrderNo())%></th>
						
						<th><%= order.getOrderTotalCost()%></th>
						
						<th><%= order.getRecvName()%></th>
						<% if((order.getOrderStatus())==1){ %>
						<th style="color:blue;">주문완료 <!-- 1 :주문완료 ,주문삭제:  0 -->
						</th>
						<%} %>
						<% if((order.getOrderStatus())==0){ %>
						<th style="color:red;">주문취소 <!-- 1 :주문완료 ,주문삭제:  0 -->
						</th>
						<%} %>
						
						</tr>

						<%} %>
						</tbody>
						<tbody>
						</tbody>
					</table>
				</div>
					
					<form id="myPageForm" name="myPageForm" action="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=Mypage&work=order_detail" method="post">
							<input type="hidden" value="" name="orderNo" id="orderNo">
					</form>
					
				<!-- } 주문 내역 목록 끝 -->
			</section>
			<!-- } 최근 주문내역 끝 </div></div>--></div></div></div></div></div>
			
			<script type="text/javascript">
				$(".detailOrder").click(function() {
					var tmp = $(this).attr("name");
					var tmp2 = $("#detailOrder_"+tmp).text();
					//$("#orderNo").attr("value", tmp2);
					
					window.open("<%=request.getContextPath()%>/coffee/Mypage/order_detail.jsp?orderNo="+tmp2,
			           		"order_detail", "width=500,height=300,left=450,top=250");
					//$("#mypageForm").submit();
				});
			
			</script>


