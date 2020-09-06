<%@page import="java.text.DecimalFormat"%>
<%@page import="ohyes.coffee.pagination.ProductSearch"%>
<%@page import="ohyes.coffee.pagination.Page"%>
<%@page import="java.util.ArrayList"%>
<%@page import="ohyes.coffee.dao.ProductAdminDAO"%>
<%@page import="ohyes.coffee.dto.ProductDTO"%>
<%@page import="java.util.List"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
	
 	
<%
	String select_classification = request.getParameter("select_classification");
	if(select_classification == null) select_classification = "";
	
	String search_product = request.getParameter("search_product");
	if(search_product == null) search_product = "";
	//search_product = new String(search_product.getBytes("ISO-8859-1"), "UTF-8");
	
	String pcategory_code = request.getParameter("pcategory_code");
	if(pcategory_code == null) pcategory_code = "";
	
	String p_date = request.getParameter("p_date");
	if(p_date == null) p_date = "";
	
	//페이지 인스턴스 생성
	Page pagination = new Page();
	int pageNum = 0;
	if(request.getParameter("pageNum") == null ){
		pageNum = 1;//null이면 일단 1페이지로 이동 할 수 있도록
	}else {
		pageNum = Integer.parseInt(request.getParameter("pageNum"));//null값이 아니라면 해당 페이지 번호로 설정
	}
	System.out.println("페이지번호 : " + pageNum);
	pagination.setNum(pageNum);//현재 페이지를 설정
 		
	//사용자가 선택한 검색의 조건을 담기 위한 인스턴스
	ProductSearch ps = new ProductSearch();
	
	ps.setSelectedNameOrNo(select_classification);//상품이름 or 상품번호 선택 
	ps.setProductKeyword(search_product);//input태그로 받은 text값
	ps.setSelectedCategory(pcategory_code);
	ps.setFordays(p_date);

	pagination.setCount(ProductAdminDAO.getProductAdminDAO().selectCountProduct(select_classification, search_product, pcategory_code, p_date));
	System.out.println("게시물의 갯수 : " + pagination.getCount());

		//System.out.println("키워드" + search_product);
	int startRow = pagination.getDisplayPost();
	int endRow = pagination.getPostNum() * pageNum;

		//수정해야됨
 	List<ProductDTO> productList = ProductAdminDAO.getProductAdminDAO().selectProductAdminAll(pagination.getDisplayPost(), pagination.getPostNum(), select_classification, search_product, pcategory_code, p_date);
	System.out.println(pagination.getDisplayPost()+"   "+ pagination.getPostNum()*pageNum);
 	System.out.println("리스트 사이즈 : "+productList.size());
	System.out.println("=====================================");
	
	
%>
	

<div class="container-fluid">
	  <div>&nbsp;</div>
	  <h4><i class="fa fa-angle-right"></i> 상품검색 </h4><hr>
		<div class="container">
			<%--나자신으로 보낸다 --%>
			<form id = "productList" name = "productListForm" action = "<%=request.getContextPath()%>/coffee/admin/index.jsp?part=product&work=list" method = "post">

				<div class="row">
					<div class="col-25">
						<label for="select_classification">검색 분류</label>
					</div>
					<div class="col-75">
						<!--상품명인지 상품코드인지 선택-->
						<select id="select_classification" name="select_classification"
							style="width: 30%">
							<option value="p_name">상품명</option>
							<option value="p_no">상품번호</option>
						</select> <input type="text" id="search_product" name="search_product"
							placeholder="입력.." style="width: 30%">
					</div>
				</div>

				<div class="row">
					<div class="col-25">
						<label for="pcategory_code">상품 카테고리 선택</label>
					</div>
					<div class="col-75">
						<select id="pcategory_code" name="pcategory_code">
							<option value = "all">전체 </option>
							<option value="1" >커피용품</option>
							<option value="2">블렌드 원두</option>
							<option value="3">싱글오리진 원두</option>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="col-25">
						<label for="p_date">상품등록일</label>
					</div>
					<div class="col-75">
						<select id="p_date" name="p_date">
							<option value="all">전체</option>
							<option value="for7days">7일</option>
							<option value="for1month">1개월</option>
							<option value="for3month">3개월</option>
						</select>
					</div>
				</div>
				
				<div class="row">
					<input type="submit" name = "search" value="검색" style = "display:inline-block; margin-right: 5px;">
					<input type="button" class = "btn btn-success btn-xs" name = "search" value="전체보기" style = "float : right; height:50px;margin-top : 10px;"
						onclick="javascript:location=href = '<%=request.getContextPath()%>/coffee/admin/index.jsp?part=product&work=list'"> 
				</div>
			</form>
		</div>
		
		<!-- cript type="text/javascript">
			function mySubmit(index) {
				if(index == 1){
					document.productListForm.action =request.getContextPath()h() %>+"/coffee/admin/index.jsp?part=product&work=list_action";
				}else if(index == 2){
					document.productListForm.action = request.getContextPath()h() %>/coffee/admin/index.jsp?part=product&work=list_action";
				}
				document.productListForm.submit();
			}
		</script-->

		<div class="col-md-12">
		<div>&nbsp;</div><div>&nbsp;</div>
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> 상품목록 </h4>
              <p>
					(검색된 상품 갯수 : <%=pagination.getCount()%>)
			  </p>
              <table class="table table-striped table-advance table-hover">

                <thead>
                  <tr>
                    <th><i class="fa fa-bullhorn"></i>상품번호</th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> 상품명</th>
                    <th><i class="fa fa-bookmark"></i> 상품 옵션</th>
                    <th><i class="fa fa-bookmark"></i> 상품이미지</th>
                    <th><i class=" fa fa-edit"></i> 판매가</th>
                    <th><i class=" fa fa-edit"></i> 남은 수량</th>
                    <th><i class=" fa fa-edit"></i> 판매횟수</th>
                    <th><i class=" fa fa-edit"></i> 상품등록일</th>
                    <th><i class=" fa fa-edit"></i> 수정/삭제</th>
                  </tr>
                </thead>
                <tbody>
                  <%if(pagination.getCount() == 0) { %>
                	<tr>
                		<td colspan = "9" style = "text-align: center">검색된 결과가 없습니다.</td>
                	</tr>
                	
                <%} else {
                
                	for(ProductDTO product : productList){
                  	String productOption = "";//커피용품
                  	if(product.getpNo().subSequence(0, 1).equals("1")){
                  		productOption = "-";
                  	}
                  	else if(product.getpNo().subSequence(0, 1).equals("2") || product.getpNo().subSequence(0, 1).equals("2")){
	                  	if(product.getpNo().substring(1, 2).equals("1")){//
	                  		productOption = "100g";
	                  	}else if(product.getpNo().substring(1, 2).equals("2")){
	                  		productOption = "200g";
	                  	}else if(product.getpNo().substring(1, 2).equals("5")){
	                  		productOption = "500g";
	                  	}
                  	}
                %>
                  <tr>
                    <td id = "productNo"><%=product.getpNo()%></td>
					<td id = "productName"><%=product.getpName()%></td>
					<td id = "productOption"><%=productOption%></td>
					<td id = "productImage"><img src="<%=request.getContextPath()%>/coffee/admin/product_images/<%=product.getpImage()%>" width="160"></td>
					<td id = "productCost"><span><%=DecimalFormat.getCurrencyInstance().format(product.getpCost())%></span></td>
					<td id = "productStock"><%=product.getpStock() - ProductAdminDAO.getProductAdminDAO().countSalesProduct(product.getpNo())%></td>
					<td id = "productSalesCount"><%=ProductAdminDAO.getProductAdminDAO().countSalesProduct(product.getpNo())%></td>
					<td id = "productDate"><%=product.getpDate().substring(0, 10)%></td>
 					<td>
                      <button id = "editBtn" class="btn btn-primary btn-xs"
							onclick="javascript:location.href = '<%=request.getContextPath()%>/coffee/admin/index.jsp?part=product&work=edit&productNO=<%=product.getpNo()%>'">수정</button>
                      <button  id = "deleteBtn" class="btn btn-danger btn-xs"
                      		onclick="javascript:location.href = '<%=request.getContextPath()%>/coffee/admin/index.jsp?part=product&work=delete_action&productNO=<%=product.getpNo()%>'">삭제</button>
                    </td>
                  </tr>
                <%} }%>
                 
                </tbody>
              </table>
            </div>
            <!-- /content-panel -->
          </div>
	</div>
	
	<div style="text-align: center;">
		<% if(pagination.getStartPageNum() > pagination.getPageNumCnt()) { //첫번째 블럭이 아닌경우 %>
		<%--페이지 넘길때에도 검색값을 넘겨 다음페이지에서도 검색값이 나올 수 있도록 한다 --%>
		<%--
		<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=product&work=list&pageNum=1&
			select_classification=<%=select_classification%>&search_product=<%=search_product%>&categoryCode=<%=categoryCode
		%>&productDate=<%=productDate%>">[처음]</a>--%>
		<a href = "<%=request.getContextPath()%>/coffee/admin/index.jsp?part=product&work=list&pageNum=<%=pagination.getStartPageNum()-pagination.getPageNumCnt() %>&
			select_classification=<%=select_classification%>&search_product=<%=search_product%>&categoryCode=<%=pcategory_code
		%>&productDate=<%=p_date%>">[이전]</a>
		<%}else { %>
		[이전]
		<%} %>
	
	<% for(int i=pagination.getStartPageNum(); i<= pagination.getEndPageNum(); i++) { %>
		<% if(pageNum != i){ %>
			<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=product&work=list&pageNum=<%=i%>&
			select_classification=<%=select_classification%>&search_product=<%=search_product%>&categoryCode=<%=pcategory_code
		%>&productDate=<%=p_date%>">[<%=i %>]</a>
		<%}else{ %>
			<span style="font-size: 18px; font-weight: bold;">[<%=i %>]</span>
		<% } %>
	<% } %>
	
	<% if(pagination.getStartPageNum() != pagination.getPageNum()) { //첫번째 블럭이 아닌경우 %>
		<a href = "<%=request.getContextPath()%>/coffee/admin/index.jsp?part=product&work=list&pageNum=<%=pagination.getStartPageNum() + pagination.getPageNumCnt()%>&
			select_classification=<%=select_classification%>&search_product=<%=search_product%>&categoryCode=<%=pcategory_code
		%>&productDate=<%=p_date%>">[다음]</a>
		<%--
		<a href = "<%=request.getContextPath()%>/coffee/admin/index.jsp?part=product&work=list&pageNum=<%=pagination.getPageNum() %>&
			select_classification=<%=select_classification%>&search_product=<%=search_product%>&categoryCode=<%=categoryCode
		%>&productDate=<%=productDate%>">[마지막]</a>--%>
		<%}else { %>
		[마지막]
		<%} %>
	
	
	</div>
	<div><p><p></div>
	
	
	<!--script type="text/javascript">
	function mySubmit(index, pno) {
		if(index == 1){//수정
			document.productListForm.action = "<%=request.getContextPath() %>/coffee/admin/index.jsp?part=product&work=edit_action";
			request.setAttribute("productNo",pno);
			
		}else if(index == 2){//삭제
			var result = confirm("정말 삭제 하시겠습니까?");
			if(result){
				request.setAttribute("productNo",pno);
				document.productListForm.action = "<%=request.getContextPath() %>/coffee/admin/index.jsp?part=product&work=delete_action";
			}
			else{
				//이거 말고 그냥 이 페이지에 남아 있게 할 수 있는 방법은? 아 왠지...회원가입할때 새창만들어서 할때 그 떄 했던거같은데
				document.productListForm.action = "<%=request.getContextPath() %>/coffee/admin/index.jsp?part=product&work=list"
			}
		}
		document.productListForm.submit();
	}
	</script-->


