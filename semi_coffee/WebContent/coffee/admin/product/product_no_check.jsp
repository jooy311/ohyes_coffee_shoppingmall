<%@page import="ohyes.coffee.dao.ProductAdminDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
    
  <%

  	//입력값을 받아서 저장(product_no받아왔음)
  	String productNo = request.getParameter("productNo");
  	//System.out.println("전달된 상품번호 : " + productNo);
  	
  	//DAO메소드를 이용하여 중복체크
  	int result = ProductAdminDAO.getProductAdminDAO().checkProductNo(productNo);
  
  %>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>상품번호 중복체크</title>
</head>
<body>
	<%if(result == 0){//사용가능 %>
		<div>입력한 <%=productNo%> 는  사용가능한 상품번호 입니다.</div>
		<div><button type = "button" onclick="windowClose();">사용하기</button></div>
		
	<%} else { //이미 중복된 상품번호가 존재%>
		<div>입력한 <%=productNo%> 는  <i style = "color : red;">이미 사용중인</i> 상품번호 입니다. <p>다른 번호를 입력해주세요!!</p></div>
		<div><button type = "button" onclick="windowClose();">확인</button></div>
	<%} %>
	
	<script type="text/javascript">
		function windowClose() {
			opener.productEnrollFrom.id.value="<%=productNo%>";
			opener.productEnrollFrom.productNoCheck.value = "1";//체크 완료했음을 의미
			window.close();
		}
	</script>
</body>
</html>