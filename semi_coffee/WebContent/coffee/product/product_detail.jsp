<%@page import="java.util.List"%>
<%@page import="ohyes.coffee.dao.QnaBoardDAO"%>
<%@page import="ohyes.coffee.dto.QnaDTO"%>

<%@page import="ohyes.coffee.dto.ReviewDTO"%>
<%@page import="ohyes.coffee.dao.ReviewDAO"%>
<%@page import="ohyes.coffee.dao.ProductDAO"%>
<%@page import="ohyes.coffee.dto.ProductDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%
	request.setCharacterEncoding("utf-8");
	
	ProductDTO product=null;
	String no="";
	
	if(request.getParameter("no")!=null || request.getParameter("no")!=""){
		no=request.getParameter("no");
		product=ProductDAO.getProductDAO().selectNoProduct(no);
	} else {
		//잘못된 요청페이지
	}
	
	//페이징처리를 위한 변수
	//페이지번호
	int pageNum=1;
	if(request.getParameter("pageNum")!=null){
		pageNum=Integer.parseInt(request.getParameter("pageNum"));
	}
	//페이지사이즈
	int pageSize=5;
	//전체게시글수
	String keyword=product.getpNo()+"";
	int totalReview=ReviewDAO.getDAO().selectReviewCount("review_p_no", product.getpNo(),0);
	
	//전체페이지수
	int totalPage=(int)Math.ceil((double)totalReview/pageSize);
	//전달페이지 검증
	if(pageNum<=0 || pageNum>totalPage) {
		pageNum=1;
	}
	//시작행
	int startRow=(pageNum-1)*pageSize+1;
	//종료행
	int endRow=pageNum*pageSize;
	if(endRow>totalReview){
		endRow=totalReview;
	}
	
	List<ReviewDTO> reviewList=ReviewDAO.getDAO().selectReview(startRow, endRow, "review_p_no", product.getpNo(), 99);
	
	
	/*
	System.out.println("totalReview = "+totalReview);
	System.out.println("product.getpNo() = "+product.getpNo());
	System.out.println("startRow = "+startRow);
	System.out.println("endRow = "+endRow);
	System.out.println("reviewList.size() = "+reviewList.size());
	*/
	
	/*
	for(int i=10;i<=500;i++){
		ReviewDTO review=new ReviewDTO();
		review.setReviewNo(i);
		review.setReviewPNo("1");
		review.setReviewTitle("테스트리뷰");
		review.setReviewMemid("테스트");
		review.setReviewContent("테스트리뷰내용");

		ReviewDAO.getDAO().insertReview(review)
	}
	*/
%>
<!--allStore_wrap-->
<div id="allStore_wrap">
    <!--allStore_contents-->
    <div id="allStore_contents">
        <div class="allStore_layout">
            <div>
                <!-- 상단 제품 정보  -->
                <div class="xans-product xans-product-detail">
                    <div class="detailArea ">

                        <!-- 이미지 영역 -->
                        <div class="xans-product xans-product-image imgArea ">
                            <!-- //참고 -->
                            <div class="keyImg">
                                <div class="thumbnail">
                                    <a>
                                        <img src="<%=request.getContextPath()%>/coffee/admin/product_images/<%=product.getpImage()%>" alt="'<%=product.getpImage() %>'" class="bigimg BigImage"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- //이미지 영역 -->

                        <!-- 상세정보 내역 -->
                        <div class="infoArea">
                            <div class="product_name">
                                <%=product.getpName() %>
                            </div>
                            <div class="infoAreaLay">
                                <!--left-->
                                <div class="info-left">
                                    <div class="xans-product xans-product-detaildesign">
                                        <table border="1" >
                                            <caption> 기본 정보</caption>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">
                                                        <span style="font-size:15px;color:#000000;font-weight:bold;">판매가</span>
                                                    </th>
                                                    <td>
                                                        <span style="font-size:15px;color:#000000;font-weight:bold;">
                                                            <strong id="span_product_price_text"><%=product.getpCost() %></strong>
                                                            <input id="product_price" name="product_price" value="" type="hidden" />
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <span style="font-size:12px;color:#555555;">요약설명</span>
                                                    </th>
                                                    <td>
                                                        <span style="font-size:12px;color:#555555;">
                                                            <span id="span_mileage_text"><%=product.getpBrief() %></span>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <span style="font-size:12px;color:#555555;">배송방법</span>
                                                    </th>
                                                    <td>
                                                        <span style="font-size:12px;color:#555555;">택배</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <span style="font-size:12px;color:#555555;">배송비</span>
                                                    </th>
                                                    <td>
                                                        <span style="font-size:12px;color:#555555;">
                                                            <span class="delv_price_B">
                                                                무료배송
                                                            </span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                  
                                    <div id="totalProducts" >
                                        <table border="1" >
                                            <colgroup>
                                                <col style="width:284px;" />
                                                <col style="width:80px;" />
                                                <col style="width:110px;" />
                                            </colgroup>
                                            <tbody class="">
                                                <tr>
                                                    <td>수량</td>
                                                    <td>
                                                    <form id="pInfo" name="pInfo" method="post">
                                                        <span class="quantity">
                                                            <input id="quantity_name" name="quantity_name" value="1" type="text"/>
                                                            <input id="quantityNum" name="quantityNum" value="1" type="hidden"/>
                                                            <input id="pNo" name="pNo" value="<%=no%>" type="hidden"/>                                                            
                                                            <a href="#none"><img src="images/img//skin/btn_count_up.gif" alt="수량증가" class="QuantityUp up" /></a>
                                                            <a href="#none"><img src="images/img//skin/btn_count_down.gif" alt="수량감소" class="QuantityDown down" /></a>
                                                        </span>
													</form>
                                                    </td>
                                                    <td class="right">
                                                        <span id="quantity_price" class="quantity_price"><%=product.getpCost()%></span><span>원</span>
                                                    </td>
                                                </tr>
                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <td colspan="3">
                                                        <strong>총 상품금액</strong>(수량) : 
                                                        <span class="total">
                                                        	<strong>
                                                        		<em id="total_cost"><%=product.getpCost() %></em>
                                                        	</strong>
                                                        	<span id="total_count">(1개)</span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            

				<!-- =================구매정보 넘겨주는 부분================= -->
                            <div class="xans-product xans-product-action ">
                                <div class="ec-base-button btns">
                                    <div style="font-size:0;">
                                  
                                        <a href="#none" id="actionBuy" class=" allStore-border-btn1"
                                            style="display:inline-block;width:calc(49%) !important; margin-right:1%; font-size:14px; line-height:50px;height:50px;min-width:148px;padding:0;">
                                            구매하기
                                        </a>
                                        <a href="#none" id="actionCart" class=" allStore-border-btn1" 
                                        style="display:inline-block; width:49% !important;font-size:14px;line-height:50px;height:50px;min-width:148px;padding:0;">
                                            장바구니
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- //참고 -->

                        </div>
                    </div>
                </div>
                <!-- //////상단 제품 정보 -->
				
                <div class="xans-product xans-product-additional xans-product-detail" id="prdDetail">
			
                    <!-- 상품상세정보 -->
                    <div id="productDetail" class="ec-base-tab grid4" style="padding-top:20px;">
                        <ul class="menu">
                            <li class="selected"><a href="#prdDetail">상세정보</a></li>
                            <li><a href="#prdReview">상품후기</a></li>
                        </ul>
                        <div class="cont" style="text-align:center;">
                            <p align="center">
                            	<img src="<%=request.getContextPath()%>/coffee/admin/product_images/<%=product.getpImageDetail()%>" alt="'<%=product.getpImageDetail()%>'">
                            </p>
                        </div>
                    </div>
                    <!-- //상품상세정보 -->

					<%-- 후기 게시판 --%>
                    <div id="prdReview" class="ec-base-tab grid4" style="padding-top:20px;">
                        <ul class="menu">
                            <li><a href="#prdDetail">상세정보</a></li>
                            <li class="selected"><a href="#prdReview">상품후기</a></li>
                        </ul>
                        <div class="board">
                            <div class="xans-product xans-product-review">
                                <div class="ec-base-table typeList">
                                    <table border="1">
                                        <caption>상품사용후기</caption>
                                        <colgroup>
                                            <col style="width:70px;"/>
                                            <col style="width:auto"/>
                                            <col style="width:100px;"/>
                                            <col style="width:100px;"/>
                                            <col style="width:80px;"/>
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th scope="col">번호</th>
                                                <th scope="col">제목</th>
                                                <th scope="col">작성자</th>
                                                <th scope="col">작성일</th>
                                                <th scope="col">조회</th>
                                            </tr>
                                        </thead>
                                        <tbody class="center">
                                        	<% if (totalReview==0) { %>
                                        	<tr >
                                                <td colspan="5" class="nodata">해당 제품의 후기가 존재하지 않습니다.</td>
                                            </tr>
                                        	<% } else { %>
                                        		<% for(ReviewDTO review:reviewList) { %>
	                                            <tr >
	                                                <td><%=review.getReviewNo()%></td>
	                                                <td class="subject left txtBreak">
	                                                    <a href="#"><%=review.getReviewTitle()%></a> 
	                                                </td>
	                                                <td><%=review.getReviewMemid() %></td>
	                                                <td class="txtInfo txt11"><%=review.getReviewDate()%></td>
	                                                <td class="txtInfo txt11"><%=review.getReviewReadcount()%></td>
	                                            </tr>
	                                            <% } %>
                                            <% } %>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <p class="ec-base-button">
                                <span class="gRight">
                                    <a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=review_write"
                                        class="allStore-color-btn1">글쓰기</a>
                                    <a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=review_list"
                                        class="allStore-color-btn2">더보기</a>
                                </span>
                            </p>
							<%-- 페이징 처리 --%>
							<% 
								int blockSize=5;
								int startPage=(pageNum-1)/blockSize*blockSize+1;
								int endPage=startPage+blockSize-1;
								if(endPage>totalPage) {
									endPage=totalPage;
								}
							%>
							
			                <div class="ec-base-paginate">
			                	<% if(startPage>blockSize) { %>
			                    <a href="<%=request.getContextPath() %>/coffee/index.jsp?workgroup=product&work=product_detail&pageNum=1&no=<%=product.getpNo()%>#prdReview" class="btn">
			                    <img src="images/btn_page_first.gif" alt="처음"/>
			                    </a>
			                    <a href="<%=request.getContextPath() %>/coffee/index.jsp?workgroup=product&work=product_detail&pageNum=<%=startPage-blockSize%>&no=<%=product.getpNo()%>#prdReview" class="btn">
								<img src="images/btn_page_prev.gif" alt="이전"/>
								</a>
			                	<% } else { %>
			                	<img src="images/btn_page_first.gif" alt="처음"/>
			                	<img src="images/btn_page_prev.gif" alt="이전"/>
			                	<% } %>
			                    <ol>
			                    <% for(int i=startPage;i<=endPage;i++) { %>
			                    	<% if(pageNum!=i) { %>
			                        <li><a href="<%=request.getContextPath() %>/coffee/index.jsp?workgroup=product&work=product_detail&pageNum=<%=i%>&no=<%=product.getpNo()%>#prdReview" class="other"><%=i%></a></li>
			                        <% } else { %>
			                        <li><a href="#" class="this"><%=i%></a></li>                        
			                        <% } %>
			                    <% } %>
			                    </ol>
			                    <% if(endPage!=totalPage) { %>
			                    <a href="<%=request.getContextPath() %>/coffee/index.jsp?workgroup=product&work=product_detail&pageNum=<%=startPage+blockSize%>&no=<%=product.getpNo()%>#prdReview" >
			                    <img src="images/btn_page_next.gif" alt="다음"/>
			                    </a>
			                    <a href="<%=request.getContextPath() %>/coffee/index.jsp?workgroup=product&work=product_detail&pageNum=<%=totalPage %>&no=<%=product.getpNo()%>#prdReview" class="btn">
			                    <img src="images/btn_page_last.gif"alt="마지막"/>
			                    </a>
			                	<% } else { %>
			                	<img src="images/btn_page_next.gif" alt="다음"/>
			                	<img src="images/btn_page_last.gif"alt="마지막"/>
			                	<% } %>
			                </div>
                        </div>
                    </div>
                    <!-- /////////상품사용후기 -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	var count=document.getElementById("quantity_name");
	var price=document.getElementById("quantity_price");
	var	cost;
	var num=$("#quantityNum");

	$("#quantity_name").change(function(){
		count.value=Number(count.value);
		cost=Number(count.value)*<%=product.getpCost()%>;
		$("#quantity_price").text(cost);
		$("#total_count").text(" ("+count.value+"개) ");
		$("#total_cost").text(cost);
		$("#quantityNum").attr("value", count.value);
	});
	
	$(".QuantityUp").click(function(){
		count.value=Number(count.value)+1;
		cost=Number(count.value)*<%=product.getpCost()%>;
		$("#quantity_price").text(cost);
		$("#total_count").text(" ("+count.value+"개) ");
		$("#total_cost").text(cost);
		$("#quantityNum").attr("value", count.value);
	});
	
	$(".QuantityDown").click(function(){
		count.value=Number(count.value)-1;
		if(count.value<=0){
			count.value=1;
		}
		cost=Number(count.value)*<%=product.getpCost()%>;
		$("#quantity_price").text(cost);
		$("#total_count").text(" ("+count.value+"개) ");
		$("#total_cost").text(cost);
		$("#quantityNum").attr("value", count.value);
	});
	$("#actionCart").click(function(){
		$("#pInfo").attr("action", "<%=request.getContextPath()%>/coffee/index.jsp?workgroup=basket&work=basket_insert_action");
		
		pInfo.submit();
	});
	$("#actionBuy").click(function(){
		$("#pInfo").attr("action", "<%=request.getContextPath()%>/coffee/index.jsp?workgroup=pay&work=Pay");
		//alert(num.val());
		
		pInfo.submit();
	});
	
</script>