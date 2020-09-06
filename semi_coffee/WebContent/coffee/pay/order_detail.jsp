<%@page import="ohyes.coffee.dto.ProductDTO"%>
<%@page import="ohyes.coffee.dao.ProductDAO"%>
<%@page import="ohyes.coffee.dao.ProductAdminDAO"%>
<%@page import="java.util.Set"%>
<%@page import="java.util.HashSet"%>
<%@page import="ohyes.coffee.dao.MypageDAO"%>
<%@page import="ohyes.coffee.dto.OrderListDTO"%>
<%@page import="java.util.List"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    <%@include file="/coffee/Mypage/login_check.jspf" %>   
    
<%
	String memId = loginMember.getMemId();
	//String orderNo = request.getParameter("orderNo");
	String orderNo = (String)session.getAttribute("orderNo");
	List<OrderListDTO> orderList = MypageDAO.getDAO().selectOrderAll3(memId, orderNo);
	session.removeAttribute("orderNo");
	

%>
    
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./Mypage/css/default_shop.css">
<meta charset="UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" type="text/css" href="<%=request.getContextPath()%>/coffee/Mypage/css/default_shop.css">
</head>
<body>

			<section id="smb_my_od" >
				<h2 style="text-align: center; color:blue">주문내역(<%=orderNo%>)</h2>

				<!-- 주문 내역 목록 시작 { -->
				<div class="tbl_head03 tbl_wrap">
					<table>
						<thead>
							<tr>
								<th scope="col">상품 이미지</th>
								<th scope="col">상품</th>														
							
								<th scope="col">상품 주문 수량</th>								
							</tr>
						</thead>
						<tbody>
						
						
						<% for(OrderListDTO order:orderList) { %>
						
						<tr>
						<th><img src="<%=request.getContextPath()%>/coffee/admin/product_images/<%=MypageDAO.getDAO().getProductImage(order.getOrderdetailPNo()).getpImage()%>" width = "70px">
						
						</th>
						<!-- 상품 -->
						<th><%= order.getpName()%></th>
						

						<!-- 해당 상품 주문 수량 -->
						<th><%=order.getOrderPAmount()%></th>						
						
						</tr>

						<%} %>
						</tbody>
						<tbody>
						</tbody>
					</table>
					<h2 style="text-align: center; color:blue"><%=memId%>님, 주문해 주셔서 감사합니다. 주문이 완료되었습니다.</h2>
					<a style="margin-left: 45%;" href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=Mypage&work=mypage">마이페이지로 이동하기</a>
				</div>
				<!-- } 주문 내역 목록 끝 -->
			</section>

</body>
</html>