<%@page import="ohyes.coffee.dto.ProductDTO"%>
<%@page import="ohyes.coffee.dao.ProductDAO"%>
<%@page import="ohyes.coffee.dto.ReviewDTO"%>
<%@page import="ohyes.coffee.dao.ReviewDAO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@include file="/coffee/Mypage/login_check.jspf" %>
<%
	//비정상적인 접근 검사
	if(request.getParameter("num")==null){
		out.println("<script type='text/javascript'>");
		out.println("alert('비정상적인 접근입니다.');");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp;");
		out.println("</script>");
		return;
	}
	
	int num=0;
	int pageNum=0;
	if(request.getParameter("num")!=null && request.getParameter("pageNum")!=null){
	num=Integer.parseInt(request.getParameter("num"));
	pageNum=Integer.parseInt(request.getParameter("pageNum"));
	}
	String no=request.getParameter("no");
	String search=request.getParameter("search");
	String keyword=request.getParameter("keyword");
	
	ReviewDTO review=ReviewDAO.getDAO().selectNumReview(num);
	ProductDTO product = ProductDAO.getProductDAO().selectNoProduct(no);

	//게시글이 비정상적일경우 에러-삭제 또는 미존재
	if(review==null || review.getReviewStatus()==0){
		out.println("<script type='text/javascript'>");
		out.println("alert('비정상적인 접근입니다.');");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp;");
		out.println("</script>");
		return;
	}
	//로그인 사용자가 작성자가 아닐경우 에러
	if(!review.getReviewMemid().equals(loginMember.getMemId())){
		out.println("<script type='text/javascript'>");		
		out.println("alert('작성자만 수정가능합니다.');");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp?workgroup=board&work=review_list';");
		out.println("</script>");
		return;
	}
%>

<div id="allStore_wrap" class="">
	<!--allStore_contents-->
	<div id="allStore_contents">
	    <div class="allStore_layout">
	
	        <div>
	            <div class="xans-board-listpackage">
	                <!--타이틀, 현재위치-->
                    <div class="allStore-board-menupackage">
                        <div class="title">
                            <h2>
                                <font color="#555555">상품후기</font>
                            </h2>
                        </div>
                        <div class="nav-path">
                            <ol>
                                <li><a href="<%=request.getContextPath()%>/coffee/index.jsp">홈</a></li>
                                <li title="현재 위치"><strong>상품후기</strong></li>
                            </ol>
                        </div>
                    </div>
                    <!--타이틀, 현재위치-->
	                <div class="xans-board xans-board-write-4 xans-board-write xans-board-4">
                            <!-- 상품정보선택 -->
						<div class="ec-base-box typeProduct">
							<p class="thumbnail">
							<a class="productLink" href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=product&work=product_detail&no=<%=product.getpNo()%>">
								<img id="iPrdImg" src="<%=request.getContextPath()%>/coffee/admin/product_images/<%=product.getpImage()%>">
							</a>
							</p>
							<div class="information">
								<span id="sPrdCommonImg"></span> 
								<h3>
								<a class="productLink">
						        <span id="sPrdName">
						        	<%=product.getpName() %>
						        </span>
						        </a>
						    </h3>
						    <p class="price">
						        <span id="sPrdPrice">
						        	<%=product.getpCost() %>
						        </span>
						    </p>
						    <p class="button">
						        <span id="iPrdView">
						            <a class="productLink" href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=product&work=product_detail&no=<%=product.getpNo()%>">
						                <img src="images/btn_prd_detail.gif" alt="상품상세보기">
						            </a>
						        </span>
						        <span class="">
                                    <a id="search_board">
                                        <img id="search_board" src="images/btn_prd_select.gif" alt="상품정보선택">
                                    </a>
                                </span>
						    </p>
							</div>
						</div>
					</div>
	                <form id="reviewDtailForm" name="" action="<%=request.getContextPath() %>/coffee/index.jsp?workgroup=board&work=review_modify_action" method="post">
	                	<input type="hidden" name="num" value="<%=num %>">
	                	<input type="hidden" name="pageNum" value="<%=pageNum %>">
	                	<input type="hidden" name="no" value="<%=no %>">
	                	<input type="hidden" name="search" value="<%=search %>">
	                	<input type="hidden" name="keyword" value="<%=keyword %>">
	                	
	                    <div class="xans-board xans-board-read-4 xans-board-read xans-board-4">
	                        <div class="ec-base-table typeWrite ">
	                            <table border="1" summary="">
	                                <caption>상품 게시판 상세</caption>
	                                <colgroup>
	                                    <col style="width:130px;" />
	                                    <col style="width:auto;" />
	                                </colgroup>
	                                <tbody>
	                                    <tr>
	                                        <th scope="row">제목</th>
	                                        <td>
	                						<input type="text" name="reviewTitle" value="<%=review.getReviewTitle() %>" style="min-width: 96%"/>
	                                        </td>
	                                    </tr>
	                                    <tr>
	                                        <th scope="row">작성자</th>
	                                        <td><%=review.getReviewMemid()%></td>
	                                    </tr>
	                                    <tr>
	                                        <td colspan="2" >
	                                            <ul class="etcArea">
	                                                <li class="">
	                                                    <strong>작성일</strong> <span class="txtNum"><%=review.getReviewDate()%></span>
	                                                </li>
	                                                
	                                                <li >
	                                                    <strong>조회수</strong> <span class="txtNum"><%=review.getReviewReadcount()%></span>
	                                                </li>
	                                            </ul>
	                                            <textarea class="detail" style="min-height:200px; min-width: 96%;resize:none;" name="reviewContent"><%=review.getReviewContent()%></textarea>
	                                        </td>
	                                    </tr>
	                                </tbody>
	                            </table>
	                        </div>
	                        <div class="ec-base-button ">
	                            <span class="gLeft">
	                            </span>
	                            <span class="gRight" >
	                                <a id="modify_btn" class=" allStore-color-btn1">
	                                    수정
	                                </a>
	                                <a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=review_detail&num=<%=num%>&pageNum=<%=pageNum%>&no=<%=no%>&search=<%=search%>&keyword=<%=keyword%>"class=" allStore-color-btn3">
	                                    취소
	                                </a>
	                            </span>
	                        </div>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
</div>
<script type="text/javascript">
$("#search_board").click(function() {
	window.open("<%=request.getContextPath()%>/coffee/board/search_board_list.jsp"
		,"postSearch","width=600,height=580,left=350,top=30");
});
$("#modify_btn").click(function(){
	$("#reviewDtailForm").submit();
});
</script>
