<%@page import="ohyes.coffee.dao.ProductAdminDAO"%>
<%@page import="ohyes.coffee.dto.ProductDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
 <%

 
 	String message = (String)session.getAttribute("message");
	if(message == null){
		message = "";
	}else {
		session.removeAttribute("message");
	}
	
	String productNO = (String)request.getParameter("productNO");
 	ProductDTO product = ProductAdminDAO.getProductAdminDAO().selectProductAdminPno(productNO);
 
 %>
 
<h4><i class="fa fa-angle-right"></i> 상품변경</h4>
<hr>

<div class="container">
<!-- 파일 보내야되니까 multipartform-data사용해야함 -->
	<form id = "productForm" action="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=product&work=edit_action" 
	method = "post" enctype="multipart/form-data">
	
	<%--input type = "hidden" name = "productNoCheck" id = "productNoCheck" value ="0"> --%>
	<%-- 제품이미지를 변경하지 않을 경우 기존 제품이미지 사용을 위해 전달하거나 제품이미지를 변경할 경우 기존 제품이미지 파일을 제거하기 위핸 전달 --%>	
	<input type="hidden" name="currentImage" value="<%=product.getpImage()%>">	
	<input type="hidden" name="currentDetailImage" value="<%=product.getpImageDetail()%>">	
	
		<div class="row">
			<div class="col-25">
				<label for="product_category">상품카테고리</label>
			</div>

			<div class="col-75">
			<%--선택된 값으로 선택이 되어있어야하며, 고를 수 없게한다. --%>
				<select id="product_category" name = "product_category" style ="width : 35%" disabled>
					<option value="goods" <%if(product.getpNo().substring(0,1).equals("1")) {%> selected = "selected" <%}%>>커피용품</option>
					<option value="blend_beans" <%if(product.getpNo().substring(0,1).equals("2")) {%> selected = "selected" <%}%>>블렌드 원두</option>
					<option value="single_beans" <%if(product.getpNo().substring(0,1).equals("3")) {%> selected = "selected" <%}%>>싱글오리진 원두</option>
				</select>
				<%-- div id = "selected_no" name = "selected_no" style = "color : red;">커피용품 카테고리 상품의 시작번호는 1 입니다.</div>--%>
				
				<span id = "beans_radio" name = "beans_radio" >
					<input type = "radio" name = "beansGram" value = "1" <%if(product.getpNo().substring(1,2).equals("1")) {%> checked = "checked" <%}%>>&nbsp;&nbsp;100g
					<input type = "radio" name = "beansGram" value = "2" <%if(product.getpNo().substring(1,2).equals("2")) {%> checked = "checked" <%}%>>&nbsp;&nbsp;200g
					<input type = "radio" name = "beansGram" value = "5" <%if(product.getpNo().substring(1,2).equals("5")) {%> checked = "checked" <%}%>>&nbsp;&nbsp;500g
				</span>
				
			</div>
		</div>
		<div>&nbsp;</div>
		<!--상품번호  : 숫자만 받도록하게 하기-->
		<div class="row">
			<div class="col-25">
				<label for="product_no">상품 번호</label>
			</div>
			
			<div class="col-75">
				<input type = "text" id = "product_no_front" name = "product_no_front" readonly="readonly" style= "width: 10%; float : left; margin-right: 10px;"
					value = "<%=product.getpNo().substring(0, 2)%>">
				<input type="text" id="product_no" name = "product_no" maxlength = "4" readonly="readonly" style="width: 30%; float : left;" 
					value = "<%=product.getpNo().substring(2)%>">
				<%-- div class="double-chekc-btn" id = "chekc-btn" style= "width: 10%; float : left; margin-left: 10px;">중복체크</div>--%>
			</div>
			
			<div id = "check_no" style = "color : red; float : left; padding-left : 40%; "></div>
		</div>
		
		<!--2. 상품 등록일 -->
		<div class="row">
			<div class="col-25">
			<!-- 오늘 날짜를 불러오고. 수정불가능하게 하기 -->
				<label for="product_date">상품 등록일</label>
			</div>
			<div class="col-75">
				<input type="text" id="product_date" name = "product_date" style="width: 35%" readonly="readonly"
					value = "<%=product.getpDate().substring(0, 10)%>">
			</div>
		</div>

		<!--3.. 상품 이름 -->
		<div class="row">
			<div class="col-25">
			<!-- 글자제한을 줘야할 것같음 -->
				<label for="product_name">상품 이름</label>
			</div>
			<div class="col-75">
				<input type="text" id="product_name" name = "product_name" <% if(product!=null) { %> value="<%=product.getpName()%>" <% } %>
					placeholder="상품 이름을 적어주세요">
			</div>
		</div>
		
		<div class="row">
		
			<div class="col-25">
				<label for="product_cost">상품 가격</label>
			</div>
			<div class="col-75">
				<input type="text" id="product_cost" numberOnly name = "product_cost" <% if(product!=null) { %> value="<%=product.getpCost()%>" <% } %>
					placeholder="상품 가격을 설정해주세요">
			</div>
		</div>

		<div class="row">
			<div class="col-25">
				<label for="product_brief">상품 요약설명</label>
			</div>
			<div class="col-75">
				<input type="text" id="product_brief" name = "product_brief" <% if(product!=null) { %> value="<%=product.getpBrief()%>" <% } %>
					placeholder="상품의 요약설명을 적어주세요.." maxlength = "3000">
			</div>
		</div>

		<div class="row">
			<div class="col-25">
				<label for="product_stock">상품 재고현황</label>
			</div>
			<div class="col-75">
				<input type="text" id="product_stock" name = "product_stock" <% if(product!=null) { %> value="<%=product.getpStock()%>" <% } %>
					placeholder="상품의 재고를 적어주세요..">
			</div>
		</div>

		<!---------------------------이미지넣기---------------------------->
		<div class="row">
			<div class="col-25">
				<label for="product_image">상품 이미지</label>
			</div>

			<div class="col-75">
				<img src="<%=request.getContextPath()%>/coffee/admin/product_images/<%=product.getpImage() %>" width="200"
					 style= "float : left; margin-right: 10px;"><br>
				<div style= "float : left; margin-left: 10px;">
					<input type="file" id="product_image" name = "product_image" size= 50>	
					<div id="image_container"></div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-25">
				<label for="product_detail_image">상품 상세 이미지</label>
			</div>

			<div class="col-75">
				<img src="<%=request.getContextPath()%>/coffee/admin/product_images/<%=product.getpImageDetail()%>" width="200"
					 style= "float : left; margin-right: 10px;"><br>
				
				<div style= "float : left; margin-left: 10px;">	
					<div id="image_container_detail"></div>
				</div>

				<div style= "float : left; margin-left: 10px;">
					<input type="file" id="product_detail_image" name = "product_detail_image" size= 100>
				</div>
				
			</div>
		</div>

		<div class="row" >
			<button class = "btn btn-primary" type="submit" style = "margin-left : 90%;" >변경하기</button>
		</div>
				
		
		<div id="message" style="color: red; text-align: center"><%=message%></div>
		
	</form>
	
</div>

<!----------------------------------------- script/jquery시작 ----------------------------------------------------->
<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script type="text/javascript">

//상품번호에 숫자만 받을 수 있도록 하는 코드
$("input:text[numberOnly]").on("keyup", function() {
    $(this).val($(this).val().replace(/[^0-9]/g,""));
});


	$('#product_image').change(function(e){
		   var reader = new FileReader();
		   reader.readAsDataURL(e.target.files[0]);
		 
		   reader.onload = function  () {
		       var tempImage = new Image();
		       tempImage.src = reader.result;
		       tempImage.onload = function () {
		            var canvas = document.createElement('canvas');
		            var canvasContext = canvas.getContext("2d");
		 
		            canvas.width = 100; 
		            canvas.height = 100;
		 
		            canvasContext.drawImage(this, 0, 0, 100, 100);
		 
		            var dataURI = canvas.toDataURL("image/jpeg");
		 
		            var imgTag = "<img id='product_image' style='width: 80%;' src='"+dataURI+"'/>";
		            
		            $("#image_container").empty();
		            $("#image_container").append(imgTag);
		        };
		    };
		});
	
	$('#product_detail_image').change(function(e){
		   var reader = new FileReader();
		   reader.readAsDataURL(e.target.files[0]);
		 
		   reader.onload = function  () {
		       var tempImage = new Image();
		       tempImage.src = reader.result;
		       tempImage.onload = function () {
		            var canvas = document.createElement('canvas');
		            var canvasContext = canvas.getContext("2d");
		 
		            canvas.width = 100; 
		            canvas.height = 100;
		 
		            canvasContext.drawImage(this, 0, 0, 100, 100);
		 
		            var dataURI = canvas.toDataURL("image/jpeg");
		 
		            var imgTag = "<img id='product_detail_image' style='width: 80%;' src='"+dataURI+"'/>";
		            $("#image_container").empty();
		            $("#image_container_detail").append(imgTag);
		        };
		    };
		});
	
	
	//$("#beans_radio").hide();
	if($("#product_category").val() == "goods") {
		$("#beans_radio").hide();
	}else if($("#product_category").val() == "blend_beans"){
		$("#beans_radio").show();
	}else if($("#product_category").val() == "single_beans"){
		$("#beans_radio").show();
	}

	$("input[name='beansGram']").attr('disabled',true);


	//유효성검사
		//유효성검사
	$("#productEnrollFrom").submit(function() {
		
		//상품이름
		if($("#product_name").val()=="") {
			$("#message").text("상품 이름을 입력해 주세요.");
			$("#product_name").focus();
			return false;
		}
		
		//상품가격
		if($("#product_cost").val()=="") {
			$("#message").text("상품가격을 입력해 주세요.");
			$("#product_cost").focus();
			return false;
		}
		
		//상품요약설명
		if($("#product_brief").val()=="") {
			$("#message").text("상품 요약설명을 입력해 주세요.");
			$("#product_brief").focus();
			return false;
		}
		
	
		//상품재고현황
		if($("#product_stock").val()=="") {
			$("#message").text("제품수량을 입력해 주세요.");
			$("#product_stock").focus();
			return false;
		}

		//상품이미지
		if($("#product_image").val()=="") {
			$("#message").text("상품 이미지를 선택해 주세요.");
			//$("#product_cost").focus();
			return false;
		}
		
		//상품상세이미지
			if($("#product_detail_image").val()=="") {
			$("#message").text("상세이미지를 선택해 주세요.");
			//$("#product_detail_image").focus();
			return false;
		}
		
	});
	
</script>