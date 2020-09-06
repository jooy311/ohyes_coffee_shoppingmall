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
		
		ProductDTO product = (ProductDTO)session.getAttribute("product");
		if(product != null){
			session.removeAttribute("product");
		}
		
		//어떨때 변경모드가 되어야할까?...
		//변경모드라면 얘의값이 있을거고
		//등록모드라면 얘의 값은 null값일 것임
		String productNO = (String)request.getParameter("productNO");
		
		String productNoCheck = (String)request.getParameter("productNoCheck");
	
	%>
	
	<!------------ contents 시작------------->
	<div class="container-fluid">
	<div>&nbsp;</div>
	<%if(productNO != null){//변경모드라면 %>
		
	<%} else{//등록모드라면 %>
	
		<h4><i class="fa fa-angle-right"></i> 상품등록 </h4>
		<hr>
	
		<div class="container">
		<!-- 파일 보내야되니까 multipartform-data사용해야함 -->
			<form id = "productEnrollFrom" action="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=product&work=enroll_action" 
			method = "post" enctype="multipart/form-data">
			
			<%--상품번호 중복체크를 등록action으로 보내기 위한 히든값--%>
			<input type = "hidden" name = "productNoCheck" id = "productNoCheck" value ="0">
			
				<!--상품카테고리  : 관리자가 이중 하나 고르면 상품번호 앞자리 자동설정될 수 있도록 하기-->
				<div class="row">
					<div class="col-25">
						<label for="product_category">상품카테고리</label>
					</div>
	
					<div class="col-75">
						<select id="product_category" name = "product_category" style ="width : 35%">
							<!-- option태그를 사용할 때 보통 value태그를 같이 사용하는데, vlaue속성은 서버에 전송 될 값임. -->
							<option value="goods" >커피용품</option>
							<option value="blend_beans">블렌드 원두</option>
							<option value="single_beans">싱글오리진 원두</option>
						</select>
						<div id = "selected_no" name = "selected_no" style = "color : red;">커피용품 카테고리 상품의 시작번호는 1 입니다.</div>
						
						<span id = "beans_radio" name = "beans_radio">
							<input type = "radio" name = "beansGram" value = "1" checked>&nbsp;&nbsp;100g
							<input type = "radio" name = "beansGram" value = "2">&nbsp;&nbsp;200g
							<input type = "radio" name = "beansGram" value = "5">&nbsp;&nbsp;500g
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
						<input type = "text" id = "product_no_front" name = "product_no_front" readonly="readonly" style= "width: 10%; float : left; margin-right: 10px;">
						<input type="text" id="product_no" name = "product_no" maxlength = "4" numberOnly
							placeholder="상품번호를 적어주세요.." style="width: 30%; float : left;">
						<div class="double-chekc-btn" id = "chekc-btn" style= "width: 10%; float : left; margin-left: 10px;">중복체크</div>
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
						<input type="text" id="product_date" name = "product_date"
							 style="width: 35%" readonly="readonly">
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
							placeholder="상품의 요약설명을 적어주세요.."  maxlength = "3000">
					</div>
				</div>
	
				<div class="row">
					<div class="col-25">
						<label for="product_stock">상품 재고현황</label>
					</div>
					<div class="col-75">
						<input type="text" id="product_stock" name = "product_stock" <% if(product!=null) { %> value="<%=product.getpStock()%>" <% } %>
							placeholder="상품의 재고를 적어주세요.." numberOnly>
					</div>
				</div>
	<%-- 
				<div class="row">
					<div class="col-25">
						<label for="product_detail">상품 상세설명</label>
					</div>
	
					<div class="col-75">
						<textarea id="product_detail" name = "product_detail" <% if(product!=null) { %> value="<%=product.getp()()%>" <% } %>
							placeholder="Write something.." style="height: 100px"></textarea>
					</div>
				</div>
	--%>
	
				<!---------------------------이미지넣기---------------------------->
				<div class="row">
					<div class="col-25">
						<label for="product_image">상품 이미지</label>
					</div>
	
					<div class="col-75">
						<input type="file" id="product_image" name = "product_image" size= 40>	
						<div id="image_container"></div>	
					</div>
				</div>
				
				<div class="row">
					<div class="col-25">
						<label for="product_detail_image">상품 상세 이미지</label>
					</div>
	
					<div class="col-75">
						<input type="file" id="product_detail_image" name = "product_detail_image" size= 40>
						<div id="image_container_detail"></div>
					</div>
				</div>
	
				<div class="row" >
					<button class = "btn btn-primary" type="submit" value="등록하기" style = "margin-left : 90%;" >등록하기</button>
				</div>
				
			</form>
			<div id="message" style="color: red; text-align: center"><%=message%></div>
		</div>
	<%}//등록모드 끝 %>
	<!--------- content끝 ----------->
		
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
		 
		            var imgTag = "<img id='product_image' style='width: 35%;' src='"+dataURI+"'/>";
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
		 
		            var imgTag = "<img id='product_detail_image' style='width: 35%;' src='"+dataURI+"'/>";
		            $("#image_container_detail").empty();
		            $("#image_container_detail").append(imgTag);
		        };
		    };
		});

	
	var selectedOption = "1";//카테고리 선택한거 받아오는 변수
	var selectedOption2 = "0";

	//관리자에게 카테고리를 선택했을때  상품번호가 어떤 번호로 시작하는지 알려주기 위한 코드
	$("#product_category").change(function() {
		if($("#product_category option:selected").val() == "goods"){
			$("#selected_no").text("커피용품 카테고리 상품의 시작번호는 1 입니다.");
			selectedOption = "1";
		}else if($("#product_category option:selected").val() == "blend_beans"){
			$("#selected_no").text("블랜드 원두 카테고리 상품의 시작번호는 2 입니다.");
			selectedOption = "2";
			selectedOption2 = "1";
		}else if($("#product_category option:selected").val() == "single_beans"){
			$("#selected_no").text("싱글오리진 원두 카테고리 상품의 시작번호는 3 입니다.");
			selectedOption = "3";
			selectedOption2 = "1";
		}
		
		$("#product_no_front").val(selectedOption + selectedOption2);
	});
	
	
	//오늘날짜 받아오기
	$("#product_date").val(function (){
	    var now = new Date();
	    var year = now.getFullYear();
	    var month = now.getMonth() + 1;    //1월이 0으로 되기때문에 +1을 함.
	    var date = now.getDate();  
	
	    if((month + "").length < 2){        //2자리가 아니면 0을 붙여줌.
	        month = "0" + month;
	    }else{
	         // ""을 빼면 year + month (숫자+숫자) 됨.. ex) 2018 + 12 = 2030이 리턴됨.
	        month = "" + month;   
	    }
	    
	    if((date + "").length <2){
	    	date = "0"+date;
	    }
	    return today = year + "-" + month + "-" + date; 
	});
	
	$("#beans_radio").hide();
	$("#product_category").change(function() {
		if($("#product_category option:selected").val() == "goods"){//원두를 선택했다면
			$("#beans_radio").hide();
		}else if($("#product_category option:selected").val() == "blend_beans"){
			$("#beans_radio").show();
		}else if($("#product_category option:selected").val() == "single_beans"){
			$("#beans_radio").show();
		}

	});
	
	
	$("#product_no_front").val(selectedOption + selectedOption2);
	$("#beans_radio").change(function() {
		if($("input[type=radio][name=beansGram]:checked").val() == "1"){//원두를 선택했다면
			selectedOption2 = "1";
		}else if($("input[type=radio][name=beansGram]:checked").val() == "2"){
			selectedOption2 = "2";
		}else if($("input[type=radio][name=beansGram]:checked").val() == "5"){
			selectedOption2 = "5";
		}
		$("#product_no_front").val(selectedOption + selectedOption2);
			//alert(selectedOption2);
	});
	
	//중복체크
        $("#chekc-btn").click(function() {
        	if( $("#product_no").val().length == 0){
        		alert("상품번호를 입력해 주세요~");
        	}else if($("#product_no").val().length < 4){
        		alert("상품번호 4자리를 입력해주세요~");
        	}else{
		       	 var productNo = selectedOption + selectedOption2 + $("#product_no").val();
		           window.open("<%=request.getContextPath()%>/coffee/admin/product/product_no_check.jsp?productNo=" + productNo,
		           		"product_no_check", "width=450,height=300,left=450,top=250");
        	}
           
        });
	
        $("product_no").keyup(function() {//중복검사하고나서 사용자가 또 입력하면 중복검사 안한걸로 reset
    		if($("#idCheckResult").val() == "1"){
    			$("#idCheckResult").val("0");
    		}
    	});


	//유효성검사
	$("#productEnrollFrom").submit(function() {
		
		//중복체크검사
		if($("#productNoCheck").value=="0") {
			$("#message").text("상품번호 중복검사를 해주세요");
			//$("#beans_radio").focus();
			return false;
		}
		
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
