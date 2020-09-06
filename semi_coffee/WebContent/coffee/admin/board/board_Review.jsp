<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>

	<div class="container-fluid">
	<div>&nbsp;</div>
	  <h4><i class="fa fa-angle-right"></i>게시판관리 >> Review </h4><hr>


		<div class="container">
			<form action = "" method = "post">

				<div class="row">
					<div class="col-25">
						<label for="lname">리뷰글 제목</label>
					</div>
					<div class="col-75">
						<input type="text" id="product" name="search_product"
							placeholder="공지글 제목을 입력해주세요..">
					</div>
				</div>
				
				<div class="row">
					<div class="col-25">
						<label for="lname">작성날짜</label>
					</div>
					<div class="col-75">
						<input type="text" id="product" name="search_product"
							placeholder="2020-08-02" style = "width : 20%">&nbsp;&nbsp;~&nbsp;&nbsp;
						<input type="text" id="product" name="search_product"
							placeholder="2020-08-03" style = "width : 20%">
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
              <h4><i class="fa fa-angle-right"></i> 상품목록 </h4><hr><table class="table table-striped table-advance table-hover">
                
                <!-- class명 바꾸고 아이디 바꾸기 -->
                <thead>
                  <tr>
                  
                    <th><i class="fa fa-bullhorn"></i>번호</th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> 제목</th>
                    <th><i class="fa fa-bookmark"></i> 작성날짜</th>
                    <th><i class=" fa fa-edit"></i> 조회수</th>
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
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
		crossorigin="anonymous"></script>
	<script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
	<script src="../assets/dist/js/bootstrap.bundle.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
	<script src="dashboard.js"></script>
	