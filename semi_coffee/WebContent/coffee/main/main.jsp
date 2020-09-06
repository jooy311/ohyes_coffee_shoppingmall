<%@page import="ohyes.coffee.dto.ProductDTO"%>
<%@page import="java.util.List"%>
<%@page import="ohyes.coffee.dao.MainAdminDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
	
	<%
		List<Integer> bestItemList = MainAdminDAO.getOrderPayAdminDAO().selectBestProduct();
	
	%>
	
<!-- 슬라이더 -->
<div id="swiper-blank">
	<div
		class="swiper-container swiper-container-horizontal swiper-container-fade">

		<div class="swiper-wrapper" style="transition-duration: 0ms;">

			<!-- 슬라이드1 -->
			<div class="swiper-slide swiper-slide-duplicate-next"
				style="background: url(images/mo_section1.jpg); width: 2026px; transform: translate3d(-2026px, 0px, 0px); opacity: 1; transition-duration: 0ms;">
				<div class="text-box">
					<h1>
						고소하고 향긋한<br />오예스커피를 느껴보세요
					</h1>
					<a href="">더둘러보기</a>
				</div>
			</div>

			<!-- 슬라이드2 -->
			<div class="swiper-slide swiper-slide-prev"
				style="background: url(images/mo_section2.jpg); width: 2026px; transform: translate3d(-4052px, 0px, 0px); opacity: 1; transition-duration: 0ms;">
				<div class="text-box">
					<h1>
						당신의 미각을<br />책임져 드릴게요
					</h1>
					<a>오에스</a>
				</div>
			</div>

			<!-- 슬라이드3 -->
			<div class="swiper-slide swiper-slide-active"
				style="background: url(images/mo_section3.jpg); width: 2026px; transform: translate3d(-6078px, 0px, 0px); opacity: 1; transition-duration: 0ms;">
				<div class="text-box">
					<h1>
						꽃보다 향기로운<br />오예스 커피입니다
					</h1>
					<a>오에스</a>
				</div>
			</div>

		</div>

		<!-- Add Pagination => 슬라이더 아래 순서 -->
		<div
			class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets">
			<span class="swiper-pagination-bullet"></span> <span
				class="swiper-pagination-bullet"></span> <span
				class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
		</div>

		<!-- Add button => 양쪽으로 슬라이더 움직일 수 있게하는 버튼 -->
		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>
	</div>
</div>


<div id="allStore_contents">

	<!-- 배너 => 상품목록페이지 -->
	<div class="banner3">
		<div>
			<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=product&work=product&category=2"><img
				src="images/main_banner2_1.jpg" /></a>
		</div>
		<div>
			<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=product&work=product&category=3"><img
				src="images/main_banner2_2.jpg" /></a>
		</div>
	</div>
	


<!--메인콘텐츠 시작-->
    
      <div style="clear:both;"></div>
   


    <div style="width:1100px; margin:0 auto;">
    <div style="float:left; width:600px; ">
    <img src="<%=request.getContextPath()%>/coffee/main/main_images/main_banner1.jpg" style="width:600px;"></div>
    <div style="float:right; width:440px; margin-top:10%; ">
        <div style="font-weight:800; font-size:34px; padding-bottom:14px; line-heght:150%;">모두에게 미니원두를 <br/>무료로 드리는 이유</div>
        <div style="font-weight:200; font-size:18px; color:#888; line-height:28px;">Ohyes은 주문 고객 모두에게<br/>미니원두(30g)를 드리는 이벤트를 <br/>매달 진행하고 있습니다.</div>
    </div>
  </div>



<div style="clear:both;"></div>

<div style="width:1100px; margin:80px auto 0;">
    
    
    <div style="float:left; width:400px; margin-top:10%;  padding-left:40px;">
        <div style="font-weight:800; font-size:34px; padding-bottom:14px; line-heght:150%; ">커피향 가득한 <br/>당신의 8월을 응원합니다. </div>
        <div style="font-weight:200; font-size:18px; color:#888; line-height:28px;">Ohyes 커피 배송시에 함께 받게되는<br/>리플렛 마지막 장을 뜯어 달력으로 사용해 보세요.<br/>다음 달 할인커피도 미리 확인해보세요 :)
</div>
    </div>
<div style="float:right; width:600px; "><img src="<%=request.getContextPath()%>/coffee/main/main_images/main_banner2.jpg" style="width:600px;"></div>
 </div>

<!--메인콘텐츠 끝-->



<div style="clear:both; height : 100px;"></div>

	<!--대표상품 => 제품상세페이지 -->
	<div
		class="xans-element- xans-product xans-product-listmain-2 xans-product-listmain xans-product-2 allStore-new new1">
		<div class="allStore_layout">
			<div class="title">대표 상품</div>
			<div>
				<ul class="new-items grid3">
					<!-- 대표상품1 -->
					<li id="anchorBoxId_31" class="prdItem xans-record-">
						<div class="itemLay">

							<!-- 이미지 -->
							<div class="thumbnail">
								<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=product&work=product_detail&no=220001">
									<img src="<%=request.getContextPath()%>/coffee/main/main_images/yehgachep.jpg" id="eListPrdImage31_3" />
								</a> 
								<span class="xans-element- xans-product xans-product-imagestyle-2 xans-product-imagestyle xans-product-2 xans-record-">
									<span class="prdIcon ec-product-bgLT" style="background-image: url(&amp;#39;//img.echosting.cafe24.com/skin/admin_ko_KR/product/ico_thumb_recommend1.png&amp;#39;);"></span>
								</span>
							</div>

							<!-- 설명 -->
							<div class="description">
								<strong class="name"> 
									<a href="#">
										<span style="font-size: 13px; color: #000000; font-weight: bold;">Ohyes블렌드 200g</span>
									</a>
								</strong>
								<ul class="xans-element- xans-product xans-product-listitem-2 xans-product-listitem xans-product-2 spec">
									<li class=" xans-record-">
										<span style="font-size: 15px; color: #000000; font-weight: bold;">10,000원</span>
									</li>
								</ul>
								<div class="icon">
									<img src="images/icon_global_03.gif" alt="" />
								</div>
							</div>

						</div>
					</li>

					<!-- 대표상품2 -->
					<li id="anchorBoxId_37" class="prdItem xans-record-">
						<div class="itemLay">
							<!-- 이미지 -->
							<div class="thumbnail">
								<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=product&work=product_detail&no=220002">
									<img src="<%=request.getContextPath()%>/coffee/main/main_images/choco.jpg" id="eListPrdImage37_3" alt="초코 블렌드 200g" />
								</a> 
								<span class="xans-element- xans-product xans-product-imagestyle-2 xans-product-imagestyle xans-product-2 xans-record-">
									<span class="prdIcon ec-product-bgLT" style="background-image: url(&amp;#39;//img.echosting.cafe24.com/skin/admin_ko_KR/product/ico_thumb_recommend1.png&amp;#39;);"></span>
								</span>
							</div>

							<!-- 설명 -->
							<div class="description">
								<strong class="name"> 
									<a href="#">
										<span style="font-size: 13px; color: #000000; font-weight: bold;">Ohyes싱글오리진 200g</span>
									</a>
								</strong>
								<ul class="xans-element- xans-product xans-product-listitem-2 xans-product-listitem xans-product-2 spec">
									<li class=" xans-record-">
										<span style="font-size: 15px; color: #000000; font-weight: bold;">10,000원</span>
									</li>
								</ul>
								<div class="icon">
									<img src="images/icon_global_03.gif" alt="" />
								</div>
							</div>

						</div>
					</li>

				</ul>
			</div>
		</div>
	</div>
	<!-- 대표상품 END -->
	
	<div
		class="xans-element- xans-product xans-product-listmain-2 xans-product-listmain xans-product-2 allStore-new new1">
		<div class="allStore_layout">
			<div class="title">OHYES's PICK</div>
			<div>
				<ul class="new-items grid3">
					<!-- 추천상품1 -->
				<%for(int productNo : bestItemList){ %>
					<%ProductDTO product = MainAdminDAO.getOrderPayAdminDAO().selectBestProductInfo(productNo); %>
					<li id="anchorBoxId_31" class="prdItem xans-record-">
						<div class="itemLay">

				
							<!-- 이미지 -->
							<div class="thumbnail">
								<a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=product&work=product_detail&no=<%=productNo%>">
									<img src="<%=request.getContextPath()%>/coffee/admin/product_images/<%=product.getpImage()%>" id="eListPrdImage31_3" />
								</a> 
								<span class="xans-element- xans-product xans-product-imagestyle-2 xans-product-imagestyle xans-product-2 xans-record-">
									<span class="prdIcon ec-product-bgLT" style="background-image: url(&amp;#39;//img.echosting.cafe24.com/skin/admin_ko_KR/product/ico_thumb_recommend1.png&amp;#39;);"></span>
								</span>
							</div>

							<!-- 설명 -->
							<div class="description">
								<strong class="name"> 
									<a href="#">
										<span style="font-size: 13px; color: #000000; font-weight: bold;"><%=product.getpName()%></span>
									</a>
								</strong>
								<ul class="xans-element- xans-product xans-product-listitem-2 xans-product-listitem xans-product-2 spec">
									<li class=" xans-record-">
										<span style="font-size: 15px; color: #000000; font-weight: bold;"><%=product.getpCost()%>원</span>
									</li>
								</ul>
								<div class="icon">
									<img src="images/icon_global_03.gif" alt="" />
								</div>
							</div>

						</div>
					</li>
				<%} %>

				</ul>
			</div>
		</div>
	</div>
	<!-- 추천상품 END -->

	<!-- 슬라이더 상단 JS -->
	<script>
		var swiper = new Swiper('.swiper-container', {
			initialSlide : 0,
			pagination : '.swiper-pagination',
			paginationClickable : true,
			autoplay : 4000,
			speed : 800,
			calculateHeight : true,
			nextButton : '.swiper-button-next',
			prevButton : '.swiper-button-prev',
			loop : true,
			effect : 'fade',
		});
	</script>
</div>