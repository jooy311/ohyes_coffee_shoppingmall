<%@page import="ohyes.coffee.dao.MemberDAO"%>
<%@page import="ohyes.coffee.dto.ReviewCommentDTO"%>
<%@page import="java.util.List"%>
<%@page import="ohyes.coffee.dao.ReviewCommentDAO"%>
<%@page import="ohyes.coffee.dto.ProductDTO"%>
<%@page import="ohyes.coffee.dao.ProductDAO"%>
<%@page import="ohyes.coffee.dao.ReviewDAO"%>
<%@page import="ohyes.coffee.dto.ReviewDTO"%>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@include file="/coffee/member/login_change.jspf" %>
<%
	//비정상적인 요청에 대한 응답
	if(request.getParameter("num")==null){
		out.println("<script type='text/javascript'>");
		out.println("alert('비정상적인 접근입니다.');");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp';");
		out.println("</script>");
		return;
	}
	
	//게시글번호
	int num=Integer.parseInt(request.getParameter("num"));
	//리뷰리스트에서 페이지번호
	int pageNum=1;
	if(request.getParameter("pageNum")!=null){
		pageNum=Integer.parseInt(request.getParameter("pageNum"));
	}
	//해당 리뷰 제품번호
	
	
	String search=request.getParameter("search");
	if(request.getParameter("search")==null) search="";
	String keyword=request.getParameter("keyword");
	if(request.getParameter("keyword")==null) keyword="";
	
	
	//게시글번호 전달받아 검색하여 반환하는 메소드
	ReviewDTO review=ReviewDAO.getDAO().selectNumReview(num);
	//작성자 아이디 불러와 저장
	String memId=loginMember.getMemId();

	//검색된글이 없거나 삭제글인경우 >> 비정상적인요청
	if (review==null || review.getReviewStatus()==0){
		out.println("<script type='text/javascript'>");
		out.println("alert('비정상적인 접근입니다.');");
		out.println("location.href='"+request.getContextPath()+"/coffee/index.jsp';");
		out.println("</script>");
		return;
	}
	
	//해당 게시글 상품번호 반환받아 저장
	String no=review.getReviewPNo();	
	//게시글번호를 전달받아 게시글의 조회수를 1증가되도록 변경하는 클래스
	ReviewDAO.getDAO().updateReadCount(num);
	
	//상품 번호를 전달받아 상품정보를 표시하기위한 메소드출력
	ProductDTO product=ProductDAO.getProductDAO().selectNoProduct(no);
	
	//현제 댓글 페이지
	int commentPageNum=1;
	if(request.getParameter("commentPageNum")!=null){
		commentPageNum=Integer.parseInt(request.getParameter("commentPageNum"));
	}
	//패이지크기
	int pageSize=5;
	//총 댓글 수 - 게시글번호 전달받아 게시글수 반환
	int totalComment=ReviewCommentDAO.getDAO().countCommentReview(num);
	
	//댓글 페이지 시작
	int startRow=(commentPageNum-1)*pageSize+1;
	//댓글 페이지 댓글 끝
	int endRow=commentPageNum*pageSize;
	if(endRow<=0 && endRow>totalComment){
		endRow=totalComment;
	}
	//댓글 목록 출력하는 메소드
	List<ReviewCommentDTO> commentList=ReviewCommentDAO.getDAO().selectNoComment(num, 1, totalComment);
	
	//같은상품 총 게시글 수
	int totalReview=ReviewDAO.getDAO().selectReviewCount("", "", 0);
	//같은상품 총 페이지 수
	int totalReviewPage=(int)Math.ceil((double)totalReview/pageSize);
	
	int prev=num-1;
	if(prev<=0){
		prev=1;
	}
	ReviewDTO reviewPrev=ReviewDAO.getDAO().selectNumReview(prev);
	int next=num+1;
	if(next>totalReview){
		next=totalReview;
	}
	ReviewDTO reviewNext=ReviewDAO.getDAO().selectNumReview(next);
	
	List<ReviewDTO> reviewList=ReviewDAO.getDAO().selectReview(1, 5, "review_p_no", no, 0);
	int totalProductReview=ReviewDAO.getDAO().selectReviewCount("review_p_no", no, 0);
	
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
						    </p>
							</div>
						</div>
					</div>
	                <form id="reviewDtailForm" name="" action="" method="post">
	                	<input type="hidden" name="num" value="<%=num %>">
	                	<input type="hidden" name="pageNum" value="<%=pageNum %>">
	                	<input type="hidden" name="no" value="<%=no %>">
	                	<input type="hidden" name="search" value="<%=search %>">
	                	<input type="hidden" name="keyword" value="<%=keyword %>">
	                	<input type="hidden" name="memId" value="<%=memId %>">
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
	                                        <td><%=review.getReviewTitle()%></td>
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
	                                            <div class="detail" style="min-height:200px;">
	                                                <%=review.getReviewContent()%>
	                                            </div>
	                                        </td>
	                                    </tr>
	                                </tbody>
	                            </table>
	                        </div>
	                        <div class="ec-base-button ">
	                            <span class="gLeft">
	                                <a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=review_list&pageNum=<%=pageNum%>&search=<%=search%>&keyword=<%=keyword%>">
	                                    <img src="images/btn_list.gif" alt="목록" /></a>
	                            </span>
	                            <span class="gRight" >
	                                <a id="modify_btn" class="allStore-color-btn1 ">
	                                    수정
	                                </a>
	                                <a id="removeBtn"class="allStore-color-btn3">
	                                    삭제
	                                </a>
	                            </span>
	                        </div>
	                    </div>
	                </form>
	            </div>
	            
	            <div id="comment_modify" style="height:50px;"></div>
	            <div class="xans-board xans-board-commentpackage-4 xans-board-commentpackage xans-board-4" style="margin-top:50px;">
	                <!-- 코멘트 리스트 -->
	                <div id="comment" class="xans-board xans-board-commentlist-4 xans-board-commentlist xans-board-4">
			                	<form id="commentModifyForm" name="commentModifyForm" class="removeForm" action="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=comment_modify_action" method="post">
			                		<input type="hidden" id="num" name="num" value="<%=num%>">
			                		<input type="hidden" id="coNo" name="coNo" value="">
			                		<input type="hidden" id="coContent" name="coContent" value="">
			                		<input type="hidden" id="coId" name="coId" value="">
			                	</form>
	                    <ul class="boardComment">
						<% for(ReviewCommentDTO comment:commentList) { %>
						
<!-- =============================댓글 수정=============================== -->
			                <li id="commentForm_<%=comment.getReviewCoNo()%>" class="first displaynone initnone">
			                		<input type="hidden" class="coId_<%=comment.getReviewCoNo()%>" name="coId" value="<%=comment.getReviewCoId()%>">
		                            <div class="commentTop">
		                                <strong class="name coId_<%=comment.getReviewCoNo()%>"> <%=comment.getReviewCoId()%></strong>
		                                <span class="date"><%=comment.getReviewCoDate()%></span>
		                            </div>
		                            <div class="view" style="margin:20px 0 0 20px">
		                                <textarea class="coContent_<%=comment.getReviewCoNo()%>" name="coContent" style="resize:none; min-width: 85%; text-align: left; margin-bottom: 20px;"><%=comment.getReviewCoContent()%></textarea>
										<span class="submit">
		                                    <a>
		                                        <img class="comment_modify_btn1" src="images/btn_comment_modify.gif" name="<%=comment.getReviewCoNo()%>" alt="수정" />
		                                    </a>
		                                    <a>
		                                        <img class="modify_cancle_btn" src="images/btn_comment_cancel.gif" name="<%=comment.getReviewCoNo()%>" alt="취소" />
		                                    </a>
		                                </span>
		                            </div>
	                        </li>
	                        <li id="comment_modify_<%=comment.getReviewCoNo()%>" class="first init">
	                            <div class="commentTop">
	                                <strong class="name"> <%=comment.getReviewCoId()%></strong>
	                                <span class="date"><%=comment.getReviewCoDate()%></span>
	                            </div>
	                            <% if (comment.getReviewCoId().equals(loginMember.getMemId())) { %>
	                            <span class="button">
	                                <a>
	                                    <img class="comment_modify_btn2 anone" src="images/btn_ico_modify.gif" name="<%=comment.getReviewCoNo()%>" alt="수정" />
	                               	</a>
	                                <a>
	                                    <img class="comment_delete_btn" src="images/btn_ico_delete.gif" name="<%=comment.getReviewCoNo()%>" alt="삭제" />
	                                </a>
	                            </span>
	                            <% } %>
	                            <div class="comment">
	                                <span id="comment_contents121"><%=comment.getReviewCoContent()%></span>
	                            </div>
	                        </li>
						<% } %>
	                    </ul>
	                </div>

	                
	                <!-- 댓글 쓰기 -->
	                <form id="commentWriteForm" name="commentWriteForm" action="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=comment_write_action&num=<%=num%>&no=<%=no%>" method="post">
	                	<input type="hidden" name="reviewNo" value="<%=num%>">
	                	<input type="hidden" name="reviewCoId" value="<%=memId%>">
	                    <div class="xans-board xans-board-commentwrite-4 xans-board-commentwrite xans-board-4 ">
	                        <div class="">
	                            <fieldset>
	                                <legend>댓글 입력</legend>
	                                <p>
	                                    <strong>댓글달기</strong>
	                                </p>
	                                <div class="view">
	                                    <textarea id="comment" name="reviewCoContent"></textarea> 
	                                    <a id="commentWriteBtn" class="submit  allStore-color-btn1" style=" line-height: 50px; min-width: 75px; padding:0">
	                                        확인
	                                    </a>
	                                </div>
	                            </fieldset>
	                        </div>
	                    </div>
	                </form>
	            </div>
	
	            
	            <div class="xans-board xans-board-listsgroup-4 xans-board-listsgroup xans-board-4">
	                <h3>관련 글 보기</h3>
	                <div class="ec-base-table typeList gBorder">
	                    <table border="1" summary="">
	                        <caption>관련글 모음</caption>
	                        <colgroup>
	                            <col style="width:70px;" />
	                            <col style="width:134px;" />
	                            <col style="width:auto;" />
	                            <col style="width:84px;" />
	                            <col style="width:77px;" class="" />
	                        </colgroup>
	                        <thead>
	                            <tr>
	                                <th scope="col">번호</th>
	                                <th scope="col">상품명</th>
	                                <th scope="col">제목</th>
	                                <th scope="col">작성자</th>
	                                <th scope="col" class="">작성일</th>
	                            </tr>
	                        </thead>
	                        <tbody class="center">
                       		<% if(totalProductReview==1) { %>
                        		<tr>
                        			<td colspan="5">해당제품과 같은 제품의 게시글이 존재하지 않습니다.</td>
                        		</tr>
                       		<% } else { %>
	                        	<% for(ReviewDTO reviewKey:reviewList) { %>
	                        		<% if(reviewKey.getReviewNo()!=num) { %>
		                            <tr class="">
		                                <td><%=reviewKey.getReviewNo()%></td>
		                                <td><span><%=product.getpName()%></span></td>
		                                <td class="subject left txtBreak">
		                                    <a href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=review_detail&num=<%=reviewKey.getReviewNo()%>&pageNum=<%=pageNum%>&no=<%=no%>&search=<%=search%>&keyword=<%=keyword%>"><%=reviewKey.getReviewTitle()%></a> </td>
		                                <td><%=reviewKey.getReviewMemid() %></td>
		                                <td class=""><span class="txtNum"><%=reviewKey.getReviewDate()%></span></td>
		                            </tr>
		                            <% } %>
                           		<% } %>
                            <% } %>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!--allStore_contents-->
	<!--상단으로-->
	<div class="allStore-goToTop">
	
	    <i class="icon icon-arrow-up"></i><br />TOP
	</div>
	<!--상단으로-->
</div>

<script type="text/javascript">
	var name;
	
	//리뷰 수정하는 버튼
	$("#modify_btn").click(function(){
		$("#reviewDtailForm").attr("action","<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=review_modify");
		$("#reviewDtailForm").submit();
	});

	//리뷰 삭제하는 버튼
	$("#removeBtn").click(function() {
		if(confirm("정말로 삭제 하시겠습니까?")) {
			location.href="<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=review_remove_action&num=<%=num%>";
			
		}
	});
	
	//댓글 수정창 띄우는 버튼
	$(".comment_modify_btn2").click(function(){
		$(".init").removeClass("displaynone");
		$(".initnone").addClass("displaynone");
		name=$(this).attr("name");
		$("#commentForm_"+name).removeClass("displaynone");
		$("#comment_modify_"+name).addClass("displaynone");
	});
	//댓글 수정창 취소하는 버튼
	$(".modify_cancle_btn").click(function(){
		$(".init").removeClass("displaynone");
		$(".initnone").addClass("displaynone");
	});
	
	//<!--댓글 수정하는 버튼-->
	$(".comment_modify_btn1").click(function(){
		name=$(this).attr("name");
		$("#coNo").attr("value",name);
		$("#coContent").attr("value",$(".coContent_"+name).attr("value"));
		$("#coId").attr("value",$(".coId_"+name).attr("value"));
		$("#commentModifyForm").submit();
	});
	//<!--댓글 삭제하는 버튼-->
	$(".comment_delete_btn").click(function(){
		if(confirm("정말고 삭제 하시겠습니까?")){
			name=$(this).attr("name");
			$("#coNo").attr("value",name);
			$("#coContent").attr("value",$(".coContent_"+name).attr("value"));
			$("#coId").attr("value",$(".coId_"+name).attr("value"));
			$("#commentModifyForm").attr("action","<%=request.getContextPath()%>/coffee/index.jsp?workgroup=board&work=comment_remove_action");
			$("#commentModifyForm").submit();			
		}
	});
	//<!--댓글 입력하는 버튼-->
	$("#commentWriteBtn").click(function(){
		$("#commentWriteForm").submit();
	});
</script>