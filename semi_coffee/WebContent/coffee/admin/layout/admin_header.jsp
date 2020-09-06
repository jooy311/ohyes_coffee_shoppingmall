<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>


	<!-- Sidebar -->
	<div class="bg-light border-right" id="sidebar-wrapper">
		<div class="sidebar-heading" style="text-align: center">
			<br>OHYES COFFEE
			<p>Admin Mode</p>
		</div>
		
		<div class="list-group list-group-flush">
			<a class="list-group-item list-group-item-action bg-light accordion"
				style="color: black">상품관리</a> <span
				class="menua list-group-item list-group-item-action bg-light">
				<p>
					<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=product&work=enroll" style="text-decoration: none">상품등록</a>
				</p>
				<p>
					<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=product&work=list" style="text-decoration: none">상품 목록</a>
				</p>
			</span> <a
				class="list-group-item list-group-item-action bg-light accordion"
				style="color: black">주문관리</a> <span
				class="menua list-group-item list-group-item-action bg-light">
				<p>
					<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=order&work=list"  style="text-decoration: none">전체 주문 목록</a>
				</p>
			</span> 
			

			<a class="list-group-item list-group-item-action bg-light accordion"
				href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=member&work=list"  style="color: black">고객관리</a> <span
				class="menua list-group-item list-group-item-action bg-light"></span>

			<a class="list-group-item list-group-item-action bg-light accordion"
				style="color: black">게시글관리</a> <span
				class="menua list-group-item list-group-item-action bg-light">
				<p>
					<a href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=qna&work=list" style="text-decoration: none">Q&A</a>
				</p>
				<p>
					<a  href="<%=request.getContextPath()%>/coffee/admin/index.jsp?part=notice&work=list" style="text-decoration: none">공지</a>
				</p>
			</span> <span class="menua list-group-item list-group-item-action bg-light"></span>

			<!--a href="#" class="list-group-item list-group-item-action bg-light">Status</a-->
		</div>
	</div>
	<!-- /#sidebar-wrapper -->
	
	

<!-- Page Content -->


