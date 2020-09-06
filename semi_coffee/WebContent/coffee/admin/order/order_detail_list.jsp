<%@page import="java.text.DecimalFormat"%>
<%@page import="java.util.List"%>
<%@page import="ohyes.coffee.dto.OrderListDTO"%>
<%@page import="ohyes.coffee.dao.OrderPayAdminDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    
    <%
    	//주문번호를 order_list페이지에서 받아온다
    	String orderNo = request.getParameter("orderNo");
    
    	//dao메소드를 가지고 해당 orderNo를 가지고 있는 주문된 상품의 이름, 주문된 상품의 가격, 주문된 상품의 수량, orderNo의 총 가격을 가져온다.
		List<OrderListDTO> orderDetail = OrderPayAdminDAO.getOrderPayAdminDAO().selectOrderDetail(orderNo);    	
    %>
    
    
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" type="text/css" href="<%=request.getContextPath()%>/coffee/Mypage/css/default_shop.css">
</head>
<body>
		
       <section id="smb_my_od">
		<h2>[ <%=orderNo%> ] 주문 상세 목록</h2>
           <div class="tbl_head03 tbl_wrap">
              <table>
 				
                <thead>
                  <tr>
                    <th><i class="fa fa-bookmark"></i>상품코드</th>
                    <th><i class="fa fa-bookmark"></i>상품이름</th>
                    <th><i class=" fa fa-edit"></i>상품의 가격</th>
                    <th><i class=" fa fa-edit"></i>주문된 상품 수량</th>
                    <th><i class=" fa fa-edit"></i>주문 가격</th><%--위아래 의 곱 --%>
                   
                
                  </tr>
                </thead>
                <tbody>
                <%
                	
                	for(OrderListDTO order : orderDetail){
                      
                %>
                  <tr>
					<td id = "orderProduct"><%=order.getOrderdetailPNo()%> </td>
					<td id = "orderProductName"><%=order.getpName()%> </td>
					<td id = "orderProductCost"><span><%=DecimalFormat.getCurrencyInstance().format(order.getpCost())%></span></td>
					<td id = "orderProductAmount"><%=order.getOrderPAmount()%> </td>
					<td id = "orderTotal"><%=DecimalFormat.getCurrencyInstance().format(order.getpCost() * order.getOrderPAmount())%> </td>
					
								
                  </tr>
                <%} %>
                 
                </tbody>
              </table>
            </div>
            </section>
         

</body>
</html>