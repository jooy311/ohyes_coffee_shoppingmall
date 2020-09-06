<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>

<!------------ contents 시작------------->
<div class="container-fluid">
	<div>&nbsp;</div>
	  <h4><i class="fa fa-angle-right"></i>게시판관리 >> Q&A </h4><hr>


	<div class="container">
		<form action = "" method = "post">
			<!-- 문의사항 카테고리별로 검색 -->
			<div class="row">
				<div class="col-25">
					<label for="fname">검색 분류</label>
				</div>
				<div class="col-75">
					<!--상품명인지 상품코드인지 선택-->
					<select id="select_classification" name="classification"
						style="width: 30%">
						<option value="order_status">주문/취소 문의</option>
						<option value="order_status">배송문의</option>
						<option value="order_status">상품문의</option>
					</select> 
				</div>
			</div>
			
			
			<!--1.게시글 제목으로 검색 -->
			<div class="row">
				<div class="col-25">
				<!-- 오늘 날짜를 불러오고. 수정불가능하게 하기 -->
					<label for="product_date">게시글 제목</label>
				</div>
				<div class="col-75">
					<input type="text" id="product_date"
						placeholder="제목을 적어주세요..">
				</div>
			</div>
			
			<!--2. 게시물 올린 기간으로 검색 -->
			<div class="row">
				<div class="col-25">
					<label for="country">기간</label>
				</div>
				<div class="col-75">
					<select id="country" name="country">
						<option value="australia">전체</option>
						<option value="australia">7일</option>
						<option value="canada">1개월</option>
						<option value="usa">3개월</option>
						<option value="usa">전체</option>
					</select>
				</div>
			</div>
			
			<div class="row checkList">
				<div class="col-25">
					<label for="lname">답변여부</label>
				</div>
				<div style = "border:1px #eee; padding-top :15px;">
					<input type="checkbox" name="order_status" value="주문완료">&nbsp;&nbsp;답변완료&nbsp;&nbsp;
					<input type="checkbox" name="order_status" value="주문취소">&nbsp;&nbsp;답변 전&nbsp;&nbsp;
				</div>
			</div>

			
			<div class="row">
				<input type="submit" value="검색">
			</div>
		</form>
	</div>


   
       
       <div class="col-md-12">
       <div>&nbsp;</div><div>&nbsp;</div>
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Q&A 목록 </h4><hr><table class="table table-striped table-advance table-hover">
                
                <!-- class명 바꾸고 아이디 바꾸기 -->
                <thead>
                  <tr>
                    <th><i class="fa fa-bullhorn"></i>번호</th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> 카테고리</th>
                    <th><i class="fa fa-bookmark"></i> 제목</th>
                    <th><i class=" fa fa-edit"></i> 작성자</th>
                    <th><i class=" fa fa-edit"></i> 작성날짜</th>
                    <th><i class=" fa fa-edit"></i> 답변유무</th>
                    <th><i class=" fa fa-edit"></i> 수정/삭제</th>
                  
                  </tr>
                </thead>
                
                
                <tbody>
                  <tr>
                    <td>
                      <a href="basic_table.html#">Company Ltd</a>
                    </td>
                    <td class="hidden-phone">Lorem Ipsum dolor</td>
                    <td>12000.00$ </td>
                    <td><span class="label label-info label-mini">Due</span></td>
                    <td>12000.00$ </td>
                    <td>12000.00$ </td>
                    
                    <td>
                      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>수정</button>
                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i>삭제</button>
                    </td>
                  </tr>
                  
                  
                 <tr>
                    <td>
                      <a href="basic_table.html#">Company Ltd</a>
                    </td>
                    <td class="hidden-phone">Lorem Ipsum dolor</td>
                    <td>12000.00$ </td>
                    <td><span class="label label-info label-mini">Due</span></td>
                     <td>12000.00$ </td>
                    <td>12000.00$ </td>
                    <td>
                      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>수정</button>
                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i>삭제</button>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="basic_table.html#">Company Ltd</a>
                    </td>
                    <td class="hidden-phone">Lorem Ipsum dolor</td>
                    <td>12000.00$ </td>
                    <td><span class="label label-info label-mini">Due</span></td>
                     <td>12000.00$ </td>
                    <td>12000.00$ </td>
                    <td>
                      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>수정</button>
                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i>삭제</button>
                    </td>
                  </tr>
                 
              
                </tbody>
              </table>
            </div>
            <!-- /content-panel -->
          </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script>
        